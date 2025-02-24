<?php

namespace App\Http\Controllers;

use App\Models\VehicleBodyType;
use Illuminate\Http\Request;

class VehicleBodyTypeController extends Controller
{
    public function index()
    {
        $vehicle_body_types = VehicleBodyType::latest()->get();

        return view('vehicle_body_type.index', [
            'vehicle_body_types' => $vehicle_body_types,
        ]);
    }

    public function create()
    {
        return view('vehicle_body_type.create');
    }

    public function edit($id)
    {
        $vehicle_body_type = VehicleBodyType::findOrFail($id);

        return view('vehicle_body_type.edit', [
            'vehicle_body_type' => $vehicle_body_type
        ]);
    }
    public function store(Request $request)
    {
        $vehicleBodyTypeAttributes = $request->validate([
            'type' => ['required', 'unique:vehicle_body_types,type'],
        ]);

        $vehicle_body_type = VehicleBodyType::create($vehicleBodyTypeAttributes);

        return redirect('/setting/vehicle_type/create')->with([
            'message' => "Successfully added a vehicle type"
        ]);
    }

    public function update(Request $request, $id)
    {
        $vehicle_body_type = VehicleBodyType::findOrFail($id);

        $rules = [
            'type' => ['required', 'unique:vehicle_body_types,type'],
        ];

        if($vehicle_body_type->code==$request->input('code')) {
            unset($rules['code']);
        }
        if($vehicle_body_type->type==$request->input('type')) {
            unset($rules['type']);
        }

        $vehicleBodyTypeAttributes = $request->validate($rules);

        $vehicle_body_type->update($vehicleBodyTypeAttributes);

        return redirect("/setting/vehicle_type")->with([
            'message' => "Successfully updated the vehicle type"
        ]);
    }

    public function destroy($id)
    {
        $vehicle_body_type = VehicleBodyType::findOrFail($id);
        $vehicle_body_type->delete();

        return redirect("/setting/vehicle_type")
            ->with([
                'message' => 'Successfully deleted the vehicle type',
            ]);
    }
}
