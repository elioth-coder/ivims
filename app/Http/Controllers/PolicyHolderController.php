<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDO;

class PolicyHolderController extends Controller
{
    public function index()
    {
        return view('policy_holder.index');
    }

    public function insurance()
    {
        $pdo = DB::connection()->getPdo();
        $sql =
        "SELECT
            policy_details.*,
            CONCAT(vehicle_details.make, ' ', vehicle_details.model, ' (', vehicle_details.color, ')') AS vehicle,
            CONCAT(users.first_name, ' ', users.last_name) AS agent_name,
            companies.code AS company_code,
            branches.code AS branch_code
        FROM policy_details
        INNER JOIN vehicle_details
        ON policy_details.vehicle_detail_id=vehicle_details.id
        INNER JOIN users
        ON policy_details.user_id=users.id
        INNER JOIN companies
        ON policy_details.company_id=companies.id
        INNER JOIN branches
        ON policy_details.branch_id=branches.id
        INNER JOIN policy_holders
        ON policy_details.policy_holder_id = policy_holders.id
        WHERE policy_holders.email=:email
        ORDER BY policy_details.created_at DESC
        ";

        $query = $pdo->prepare($sql);
        $query->execute([
            'email' => Auth::user()->email
        ]);
        $authentications = $query->fetchAll(PDO::FETCH_CLASS, 'stdClass');

        return view('policy_holder.insurance', [
            'authentications' => $authentications,
        ]);
    }
}
