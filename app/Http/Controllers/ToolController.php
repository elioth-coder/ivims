<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\PolicyDetail;
use App\Models\PolicyHolder;
use App\Models\VehicleDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ToolController extends Controller
{
    public function process_import(Request $request, $target)
    {
        try {
            $data = $request->all();

            if($target == 'companies') {
                Company::create($data);
            }
            if($target == 'vehicle_details') {
                VehicleDetail::create($data);
            }
            if($target == 'policy_holders') {
                $data['birthday'] = Carbon::parse($data['birthday']);
                PolicyHolder::create($data);
            }
            if($target == 'policy_details') {
                $data['coc_no']    = substr((floor(microtime(true) * 1000) . ''), 0, 13) . mt_rand(100,999);;
                $data['policy_no'] = substr((floor(microtime(true) * 1000) . ''), 0, 13) . mt_rand(100,999);;
                $data['or_no']     = substr((floor(microtime(true) * 1000) . ''), 0, 13) . mt_rand(100,999);;
                $data['date_issued']    = Carbon::parse($data['date_issued']);
                $data['inception_date'] = Carbon::parse($data['inception_date']);
                $data['expiry_date']    = Carbon::parse($data['expiry_date']);

                PolicyDetail::create($data);
            }

            return response()->json([
                'status'  => 'success',
                'message' => 'Data inserted successfully!',
                'data'    => $data,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error: ' . $e->getMessage(),
                'status'  => 'error',
            ], 200);
        }
    }

    public function data_import()
    {
        return view('tools.data_import');
    }

    public function raw_data(Request $request)
    {
        if($request->input('data_target') == 'companies') {
            $items =
            Company::paginate($request->input('data_limit'))
                ->withQueryString();;
        }
        if($request->input('data_target') == 'vehicle_details') {
            $items =
            VehicleDetail::paginate($request->input('data_limit'))
                ->withQueryString();;
        }
        if($request->input('data_target') == 'policy_holders') {
            $items =
            PolicyHolder::paginate($request->input('data_limit'))
                ->withQueryString();;
        }
        if($request->input('data_target') == 'policy_details') {
            $items =
            PolicyDetail::paginate($request->input('data_limit'))
                ->withQueryString();;
        }

        return view('tools.raw_data', [
            'items' => $items ?? [],
        ]);
    }
}
