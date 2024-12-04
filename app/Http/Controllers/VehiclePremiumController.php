<?php

namespace App\Http\Controllers;

use App\Models\VehiclePremium;
use Illuminate\Http\Request;

class VehiclePremiumController extends Controller
{
    public function index()
    {
        $vehicle_premiums = VehiclePremium::all();

        return view('vehicle_premium.index', [
            'vehicle_premiums' => $vehicle_premiums,
        ]);
    }

    public function create()
    {
        return view('vehicle_premium.create');
    }

    public function edit($id)
    {
        $vehicle_premium = VehiclePremium::findOrFail($id);

        return view('vehicle_premium.edit', [
            'vehicle_premium' => $vehicle_premium
        ]);
    }
    public function store(Request $request)
    {
        $vehiclePremiumAttributes = $request->validate([
            'code'        => ['required', 'unique:vehicle_premiums,code'],
            'type'        => ['required', 'unique:vehicle_premiums,type'],
            'one_year'    => ['required', 'numeric'],
            'three_years' => ['required', 'numeric'],
        ]);

        $vehicle_premium = VehiclePremium::create($vehiclePremiumAttributes);

        return redirect('/setting/vehicle_premium/create')->with([
            'message' => "Successfully added a vehicle premium"
        ]);
    }

    public function update(Request $request, $id)
    {
        $vehicle_premium = VehiclePremium::findOrFail($id);

        $rules = [
            'code'        => ['required', 'unique:vehicle_premiums,code'],
            'type'        => ['required', 'unique:vehicle_premiums,type'],
            'one_year'    => ['required', 'numeric'],
            'three_years' => ['required', 'numeric'],
        ];

        if($vehicle_premium->code==$request->input('code')) {
            unset($rules['code']);
        }
        if($vehicle_premium->type==$request->input('type')) {
            unset($rules['type']);
        }

        $vehiclePremiumAttributes = $request->validate($rules);

        $vehicle_premium->update($vehiclePremiumAttributes);

        return redirect("/setting/vehicle_premium")->with([
            'message' => "Successfully updated the vehicle premium"
        ]);
    }

    public function destroy($id)
    {
        $vehicle_premium = VehiclePremium::findOrFail($id);
        $vehicle_premium->delete();

        return redirect("/setting/vehicle_premium")
            ->with([
                'message' => 'Successfully deleted the vehicle premium',
            ]);
    }
}
