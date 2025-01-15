<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Traits\UploadCountTrait;
use Illuminate\Support\Facades\DB;
use PDO;

class DashboardController extends Controller
{
    use UploadCountTrait;

    private function getTotalUploads()
    {
        $pdo = DB::connection()->getPdo();
        $pdo->exec("SET SESSION sql_mode = (SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''))");
        $sql =
        "SELECT COUNT(*) AS `count` FROM policy_details";
        $query = $pdo->prepare($sql);
        $query->execute();
        $item = $query->fetchObject('stdClass');

        return $item->count;
    }

    private function getTodaysUploads()
    {
        $pdo = DB::connection()->getPdo();
        $pdo->exec("SET SESSION sql_mode = (SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''))");
        $sql =
        "SELECT COUNT(*) AS `count` FROM policy_details WHERE DATE(date_issued)=:today";
        $query = $pdo->prepare($sql);
        $query->execute([
            'today' => date('Y-m-d')
        ]);
        $item = $query->fetchObject('stdClass');

        return $item->count;
    }

    private function getRecentUploads()
    {
        $pdo = DB::connection()->getPdo();
        $pdo->exec("SET SESSION sql_mode = (SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''))");

        $sql =
        "SELECT
            policy_details.*,
            vehicle_details.color, vehicle_details.make, vehicle_details.model,
            users.first_name, users.last_name,
            companies.code, companies.name
        FROM policy_details
        INNER JOIN vehicle_details
        ON policy_details.vehicle_detail_id=vehicle_details.id
        INNER JOIN users
        ON policy_details.user_id=users.id
        INNER JOIN companies
        ON policy_details.company_id=companies.id
        ORDER BY created_at DESC
        LIMIT 15
        ";

        $query = $pdo->prepare($sql);
        $query->execute();
        $items = $query->fetchAll(PDO::FETCH_CLASS, 'stdClass');

        return $items;
    }

    public function index()
    {
        $announcements = Announcement::where('status','visible')->get();
        $uploads_per_company  = $this->getUploadsPerCompany();
        $uploads_per_month    = $this->getUploadsPerMonth();
        $uploads_per_province = $this->getUploadsPerProvince();
        $recent_uploads  = $this->getRecentUploads();
        $total_uploads   = $this->getTotalUploads();
        $todays_uploads  = $this->getTodaysUploads();
        $top_companies   = $this->getTop15Companies();

        return view('dashboard.index', [
            'uploads_per_province' => $uploads_per_province ?? [],
            'uploads_per_company'  => $uploads_per_company ?? [],
            'uploads_per_month'    => $uploads_per_month ?? [],
            'recent_uploads'       => $recent_uploads ?? [],
            'announcements'        => $announcements ?? [],
            'total_uploads'        => $total_uploads ?? 0,
            'todays_uploads'       => $todays_uploads ?? 0,
            'top_companies'        => $top_companies ?? [],
        ]);
    }

    public function upload_count_per_company()
    {
        $uploads_per_company = $this->getUploadsPerCompany();

        return view('dashboard.upload_count_per_company', [
            'uploads_per_company' => $uploads_per_company ?? [],
        ]);
    }

    public function upload_count_per_month()
    {
        $uploads_per_month = $this->getUploadsPerMonth();

        return view('dashboard.upload_count_per_month', [
            'uploads_per_month' => $uploads_per_month ?? [],
        ]);
    }

    public function upload_count_per_province()
    {
        $uploads_per_province = $this->getUploadsPerProvince();

        return view('dashboard.upload_count_per_province', [
            'uploads_per_province' => $uploads_per_province ?? [],
        ]);
    }

}
