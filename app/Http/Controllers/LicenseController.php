<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Company;
use App\Models\License;
use App\Models\User;
use Illuminate\Http\Request;

class LicenseController extends Controller
{
    public function index()
    {
        return view('license.index');
    }

    public function company()
    {
        $companies = Company::latest()->get();

        return view('license.company', [
            'companies' => $companies,
        ]);
    }

    public function company_revoke($id)
    {
        $company = Company::findOrFail($id);

        return view('license.company_revoke', [
            'company' => $company
        ]);
    }

    public function company_revokal(Request $request, $id)
    {
        $company = Company::findOrFail($id);

        $licenseAttributes = $request->validate([
            'remarks' => ['required'],
        ]);
        $licenseAttributes['license_duration'] = null;
        $licenseAttributes['start_date'] = date('Y-m-d');
        $licenseAttributes['expiry_date'] = null;
        $licenseAttributes['status'] = 'revoked';

        License::create([
            'license_duration' => $company->license_duration,
            'start_date'  => $company->start_date,
            'expiry_date' => $company->expiry_date,
            'remarks'     => $company->remarks ?? '',
            'status'      => $company->status,
            'entity_id'   => $company->id,
            'type'        => 'COMPANY',
        ]);
        $company->update($licenseAttributes);

        return redirect("/license/company")->with([
            'message' => "Successfully revoked the license of the company"
        ]);
    }

    public function company_renew($id)
    {
        $company = Company::findOrFail($id);

        return view('license.company_renew', [
            'company' => $company
        ]);
    }

    public function company_renewal(Request $request, $id)
    {
        $company = Company::findOrFail($id);

        $licenseAttributes = $request->validate([
            'license_duration' => ['required'],
            'start_date'  => ['required', 'date'],
            'expiry_date' => ['required', 'date'],
        ]);
        $licenseAttributes['status'] = 'renewed';

        License::create([
            'license_duration' => $company->license_duration,
            'start_date'  => $company->start_date,
            'expiry_date' => $company->expiry_date,
            'remarks'     => $company->remarks ?? '',
            'status'      => $company->status,
            'entity_id'   => $company->id,
            'type'        => 'COMPANY',
        ]);
        $company->update($licenseAttributes);

        return redirect("/license/company")->with([
            'message' => "Successfully renewed the license of the company"
        ]);
    }

    public function branch()
    {
        $branches = Branch::latest()->get();

        if($branches->count() > 0) {
            $branches = $branches->map(function($branch) {
                $branch->company = Company::findOrFail($branch->company_id);

                return $branch;
            });
        }

        return view('license.branch', [
            'branches' => $branches,
        ]);
    }

    public function branch_revoke($id)
    {
        $branch = Branch::findOrFail($id);
        $branch->company = Company::findOrFail($branch->company_id);

        return view('license.branch_revoke', [
            'branch' => $branch
        ]);
    }

    public function branch_revokal(Request $request, $id)
    {
        $branch = Branch::findOrFail($id);

        $licenseAttributes = $request->validate([
            'remarks' => ['required'],
        ]);
        $licenseAttributes['license_duration'] = null;
        $licenseAttributes['start_date'] = date('Y-m-d');
        $licenseAttributes['expiry_date'] = null;
        $licenseAttributes['status'] = 'revoked';

        License::create([
            'license_duration' => $branch->license_duration,
            'start_date'  => $branch->start_date,
            'expiry_date' => $branch->expiry_date,
            'remarks'     => $branch->remarks ?? '',
            'status'      => $branch->status,
            'entity_id'   => $branch->id,
            'type'        => 'BRANCH',
        ]);
        $branch->update($licenseAttributes);

        return redirect("/license/branch")->with([
            'message' => "Successfully revoked the license of the branch"
        ]);
    }

    public function branch_renew($id)
    {
        $branch = Branch::findOrFail($id);
        $branch->company = Company::findOrFail($branch->company_id);

        return view('license.branch_renew', [
            'branch' => $branch
        ]);
    }

    public function branch_renewal(Request $request, $id)
    {
        $branch = Branch::findOrFail($id);

        $licenseAttributes = $request->validate([
            'license_duration' => ['required'],
            'start_date'  => ['required', 'date'],
            'expiry_date' => ['required', 'date'],
        ]);
        $licenseAttributes['status'] = 'renewed';

        License::create([
            'license_duration' => $branch->license_duration,
            'start_date'  => $branch->start_date,
            'expiry_date' => $branch->expiry_date,
            'remarks'     => $branch->remarks ?? '',
            'status'      => $branch->status,
            'entity_id'   => $branch->id,
            'type'        => 'BRANCH',
        ]);
        $branch->update($licenseAttributes);

        return redirect("/license/branch")->with([
            'message' => "Successfully renewed the license of the branch"
        ]);
    }

    public function agent()
    {
        $agents = User::latest()->whereIn('role', ['AGENT','SUBAGENT'])->get();

        $agents = $agents->map(function (Object $agent) {
            $agent->company = Company::findOrFail($agent->company_id);

            if($agent->branch_id) {
                $agent->branch = Branch::findOrFail($agent->branch_id);
            }

            return $agent;
        });

        return view('license.agent', [
            'agents' => $agents,
        ]);
    }


    public function agent_revoke($id)
    {
        $agent = User::findOrFail($id);
        $agent->company = Company::findOrFail($agent->company_id);

        if($agent->branch_id) {
            $agent->branch = Branch::findOrFail($agent->branch_id);
        }

        return view('license.agent_revoke', [
            'agent' => $agent
        ]);
    }


    public function agent_revokal(Request $request, $id)
    {
        $agent = User::findOrFail($id);

        $licenseAttributes = $request->validate([
            'remarks' => ['required'],
        ]);
        $licenseAttributes['license_duration'] = null;
        $licenseAttributes['start_date'] = date('Y-m-d');
        $licenseAttributes['expiry_date'] = null;
        $licenseAttributes['status'] = 'revoked';

        License::create([
            'license_duration' => $agent->license_duration,
            'start_date'  => $agent->start_date,
            'expiry_date' => $agent->expiry_date,
            'remarks'     => $agent->remarks ?? '',
            'status'      => $agent->status,
            'entity_id'   => $agent->id,
            'type'        => 'AGENT',
        ]);
        $agent->update($licenseAttributes);

        return redirect("/license/agent")->with([
            'message' => "Successfully revoked the license of the agent"
        ]);
    }

    public function agent_renew($id)
    {
        $agent = User::findOrFail($id);
        $agent->company = Company::findOrFail($agent->company_id);

        if($agent->branch_id) {
            $agent->branch = Branch::findOrFail($agent->branch_id);
        }

        return view('license.agent_renew', [
            'agent' => $agent
        ]);
    }

    public function agent_renewal(Request $request, $id)
    {
        $agent = User::findOrFail($id);

        $licenseAttributes = $request->validate([
            'license_duration' => ['required'],
            'start_date'  => ['required', 'date'],
            'expiry_date' => ['required', 'date'],
        ]);
        $licenseAttributes['status'] = 'renewed';

        License::create([
            'license_duration' => $agent->license_duration,
            'start_date'  => $agent->start_date,
            'expiry_date' => $agent->expiry_date,
            'remarks'     => $agent->remarks ?? '',
            'status'      => $agent->status,
            'entity_id'   => $agent->id,
            'type'        => 'AGENT',
        ]);
        $agent->update($licenseAttributes);

        return redirect("/license/agent")->with([
            'message' => "Successfully renewed the license of the agent"
        ]);
    }
}
