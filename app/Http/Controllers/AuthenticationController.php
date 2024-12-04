<?php

namespace App\Http\Controllers;

use App\Mail\ApplicationSuccessfulMail;
use App\Models\Company;
use App\Models\PolicyDetail;
use App\Models\PolicyHolder;
use App\Models\ValidId;
use App\Models\VehicleDetail;
use App\Models\VehiclePremium;
use Illuminate\Support\Facades\Mail;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use PDO;

class AuthenticationController extends Controller
{
    public function index()
    {
        $pdo = DB::connection()->getPdo();
        $sql =
            "SELECT
            policy_details.*,
            vehicle_details.color, vehicle_details.make, vehicle_details.model,
            policy_holders.first_name, policy_holders.last_name, policy_holders.suffix
        FROM policy_details
        INNER JOIN vehicle_details
        ON policy_details.vehicle_detail_id=vehicle_details.id
        INNER JOIN policy_holders
        ON policy_details.policy_holder_id=policy_holders.id
        WHERE policy_details.user_id=:user_id
        ";

        $query = $pdo->prepare($sql);
        $query->execute([
            'user_id' => Auth::user()->id,
        ]);
        $authentications = $query->fetchAll(PDO::FETCH_CLASS, 'stdClass');

        return view('authentication.index', [
            'authentications' => $authentications,
        ]);
    }

    public function create()
    {
        $premiums  = VehiclePremium::all();
        $valid_ids = ValidId::all();

        return view('authentication.create', [
            'premiums'  => $premiums,
            'valid_ids' => $valid_ids
        ]);
    }

    private function getAuthentication($id)
    {
        $pdo = DB::connection()->getPdo();
        $sql =
            "SELECT
            policy_details.*,
            vehicle_details.mv_file_no, vehicle_details.plate_no, vehicle_details.serial_no, vehicle_details.color, vehicle_details.make, vehicle_details.model,
            policy_holders.business, policy_holders.address, policy_holders.first_name, policy_holders.last_name, policy_holders.suffix
        FROM policy_details
        INNER JOIN vehicle_details
        ON policy_details.vehicle_detail_id=vehicle_details.id
        INNER JOIN policy_holders
        ON policy_details.policy_holder_id=policy_holders.id
        WHERE policy_details.id=:id
        ";

        $query = $pdo->prepare($sql);
        $query->execute([
            'id' => $id,
        ]);
        $authentication = $query->fetchObject('stdClass');

        return $authentication;
    }

    public function preview($id)
    {
        $authentication = $this->getAuthentication($id);
        $pdf = FacadePdf::loadView('authentication.pdf', ['authentication' => $authentication]);

        return $pdf->stream();
    }

    public function print($id)
    {
        $authentication = $this->getAuthentication($id);

        return view('authentication.print', [
            'authentication' => $authentication,
        ]);
    }

    public function store(Request $request)
    {
        try {
            $policy_holder_data = $request->validate([
                'id_number'   => ['required'],
                'id_type'     => ['required'],
                'business'    => ['required'],
                'first_name'  => ['required'],
                'middle_name' => ['nullable'],
                'last_name'   => ['required'],
                'suffix'      => ['nullable'],
                'gender'      => ['required'],
                'birthday'    => ['required'],
                'contact_no'  => ['required'],
                'address'     => ['required'],
                'email'       => ['required', 'email'],
            ]);

            $vehicle_detail_data = $request->validate([
                'mv_file_no'     => ['nullable'],
                'plate_no'       => ['nullable'],
                'serial_no'      => ['required'],
                'motor_no'       => ['required'],
                'make'           => ['required'],
                'model'          => ['required'],
                'color'          => ['required'],
                'body_type'      => ['required'],
                'authorized_cap' => ['required'],
                'unladen_weight' => ['required'],
            ]);

            $policy_detail_data = $request->validate([
                'date_issued'    => ['required'],
                'validity'       => ['required'],
                'premium_code'   => ['required'],
                'inception_date' => ['required'],
                'expiry_date'    => ['required'],
            ]);

            $policy_detail_data['coc_no']    = mt_rand(1000000000000, 9999999999999);
            $policy_detail_data['policy_no'] = mt_rand(1000000000000, 9999999999999);
            $policy_detail_data['or_no']     = mt_rand(1000000000000, 9999999999999);
            $user = Auth::user();
            $company = Company::where('id', $user->company_id)->first();

            $policy_detail_data['company_id'] = $user->company_id;
            $policy_detail_data['user_id']    = $user->id;

            $vehicle_premium = VehiclePremium::where('code', $policy_detail_data['premium_code'])->first();
            $policy_detail_data['premium'] =
                ($policy_detail_data['validity'] == '1')
                ? $vehicle_premium->one_year
                : $vehicle_premium->three_years;

            $policy = $this->store_authentication($policy_holder_data, $vehicle_detail_data, $policy_detail_data);

            $authentication = $this->getAuthentication($policy->id);
            $pdf = FacadePdf::loadView('authentication.pdf', ['authentication' => $authentication]);
            $pdfContent = $pdf->output();

            Mail::to($policy_holder_data['email'])->send(
                new ApplicationSuccessfulMail(
                    [
                        'customer'   => $policy_holder_data['first_name'] . " " . $policy_holder_data['last_name'],
                        'gender'     => $policy_holder_data['gender'],
                        'agent_name' => $user->name,
                        'email'      => $user->email,
                        'contact_no' => $user->contact_no,
                        'company'    => $company->name,
                        'coc_no'     => $policy_detail_data['coc_no'],
                    ], $pdfContent
                )
            );

            return response()->json([
                'status'  => 'success',
                'message' => 'Successfully authenticated the policy',
                'policy'  => $policy,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status'  => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    private function store_authentication($policy_holder_data, $vehicle_detail_data, $policy_detail_data)
    {
        try {
            DB::beginTransaction();

            $policy_holder  = PolicyHolder::create($policy_holder_data);
            $vehicle_detail = VehicleDetail::create($vehicle_detail_data);
            $policy_detail_data['policy_holder_id']  = $policy_holder->id;
            $policy_detail_data['vehicle_detail_id'] = $vehicle_detail->id;

            $policy_detail  = PolicyDetail::create($policy_detail_data);
            DB::commit();

            return $policy_detail;
        } catch (Exception $e) {
            DB::rollBack();

            throw $e;
        }
    }

    public function integrate(Request $request)
    {
        $data = $request->json()->all();

        return response()->json([
            'status' => 'success',
            'data'   => $data,
        ], 200);
    }

    public function verify_qr(Request $request, $coc_no)
    {
        $pdo = DB::connection()->getPdo();
        $sql =
        "SELECT
            policy_details.*,
            vehicle_details.mv_file_no, vehicle_details.plate_no, vehicle_details.serial_no, vehicle_details.motor_no, vehicle_details.color, vehicle_details.make, vehicle_details.model,
            policy_holders.business, policy_holders.address, policy_holders.first_name, policy_holders.last_name, policy_holders.suffix
        FROM policy_details
        INNER JOIN vehicle_details
        ON policy_details.vehicle_detail_id=vehicle_details.id
        INNER JOIN policy_holders
        ON policy_details.policy_holder_id=policy_holders.id
        WHERE policy_details.coc_no=:coc_no
        ";

        $query = $pdo->prepare($sql);
        $query->execute([
            'coc_no' => $coc_no,
        ]);
        $authentication = $query->fetchObject('stdClass');

        return view('verify_qr', [
            'authentication' => $authentication,
        ]);

    }
}
