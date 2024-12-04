<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\PolicyDetail;
use App\Models\PolicyHolder;
use App\Models\User;
use App\Models\VehicleDetail;
use App\Models\VehiclePremium;
use Illuminate\Http\Request;

class AuthenticatedController extends Controller
{
    public function policy($id)
    {
        $policy  = PolicyDetail::findOrFail($id);
        $premium = VehiclePremium::where('code', $policy->premium_code)->first();
        $policy->type    = $premium->type;
        $policy_holder   = PolicyHolder::findOrFail($policy->policy_holder_id);
        $policy->holder  = $policy_holder;
        $vehicle_details = VehicleDetail::findOrFail($policy->vehicle_detail_id);
        $policy->vehicle = $vehicle_details;
        $insurance_company = Company::findOrFail($policy->company_id);
        $policy->company = $insurance_company;
        $user = User::findOrFail($policy->user_id);
        $policy->processed_by = $user;

        return view('authenticated.policy', [
            'policy' => $policy,
        ]);
    }
}
