<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDO;

class DashboardController extends Controller
{
    public function index()
    {
        $announcements = Announcement::where('status','visible')->get();
        $pdo = DB::connection()->getPdo();
        $pdo->exec("SET SESSION sql_mode = (SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''))");
        $sql =
        "SELECT COUNT(`policy_details`.`id`) AS `count`, `companies`.`code`, `companies`.`name`
        FROM `policy_details`
        INNER JOIN companies
        ON policy_details.company_id=companies.id
        GROUP BY policy_details.company_id;";

        $query = $pdo->prepare($sql);
        $query->execute();
        $uploads = $query->fetchAll(PDO::FETCH_CLASS, 'stdClass');

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
        $recent_uploads = $query->fetchAll(PDO::FETCH_CLASS, 'stdClass');

        $sql =
        "SELECT COUNT(*) AS `count` FROM policy_details WHERE DATE(created_at)=:today";
        $query = $pdo->prepare($sql);
        $query->execute([
            'today' => date('Y-m-d'),
        ]);
        $todays_upload = $query->fetchObject('stdClass');

        return view('dashboard.index', [
            'uploads' => $uploads ?? [],
            'recent_uploads' => $recent_uploads ?? [],
            'announcements' => $announcements ?? [],
            'todays_upload' => $todays_upload->count ?? 0,
        ]);
    }
}
