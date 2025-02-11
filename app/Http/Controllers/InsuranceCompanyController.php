<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;

class InsuranceCompanyController extends Controller
{
    public function index()
    {
        $companies  = Company::latest()->get();

        return view('insurance_companies.index', [
            'companies'  => $companies,
        ]);
    }

    public function branches()
    {
        $branches = Branch::latest()->get();

        if($branches->count() > 0) {
            $branches = $branches->map(function($branch) {
                $branch->company = Company::findOrFail($branch->company_id);

                return $branch;
            });
        }

        return view('insurance_companies.branches', [
            'branches'  => $branches,
        ]);
    }

    public function agents()
    {
        $agents = User::latest()->whereIn('role', ['AGENT','SUBAGENT'])->get();

        $agents = $agents->map(function (Object $agent) {
            $agent->company = Company::findOrFail($agent->company_id);

            if($agent->branch_id) {
                $agent->branch = Branch::findOrFail($agent->branch_id);
            }

            return $agent;
        });

        return view('insurance_companies.agents', [
            'agents'  => $agents,
        ]);
    }
}
