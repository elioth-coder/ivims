<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Traits\UploadCountTrait;
use Illuminate\Support\Facades\DB;
use PDO;

class ReportController extends Controller
{
    use UploadCountTrait;

    public function index()
    {
        return view('report.index');
    }

    public function upload_count_per_company()
    {
        $uploads_per_company = $this->getUploadsPerCompany();

        return view('report.upload_count_per_company', [
            'uploads_per_company' => $uploads_per_company ?? [],
        ]);
    }

    public function upload_count_per_month()
    {
        $uploads_per_month = $this->getUploadsPerMonth();

        return view('report.upload_count_per_month', [
            'uploads_per_month' => $uploads_per_month ?? [],
        ]);
    }

    public function upload_count_per_province()
    {
        $uploads_per_province = $this->getUploadsPerProvince();

        return view('report.upload_count_per_province', [
            'uploads_per_province' => $uploads_per_province ?? [],
        ]);
    }

}
