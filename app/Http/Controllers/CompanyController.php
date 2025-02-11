<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\License;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::latest()->get();

        return view('company.index', [
            'companies' => $companies,
        ]);
    }

    public function create()
    {
        return view('company.create');
    }

    public function edit($id)
    {
        $company = Company::findOrFail($id);

        return view('company.edit', [
            'company' => $company
        ]);
    }

    public function store(Request $request)
    {
        $companyAttributes = $request->validate([
            'code'    => ['required', 'unique:companies,code'],
            'name'    => ['required', 'unique:companies,name'],
            'origin'  => ['nullable'],
            'email'   => ['required', 'email'],
            'phone'   => ['required'],
            'address' => ['required'],
            'license_duration' => ['required'],
            'start_date'  => ['required', 'date'],
            'expiry_date' => ['required', 'date'],
        ]);
        $companyAttributes['status'] = 'new';

        $company = Company::create($companyAttributes);

        return redirect('/company/create')->with([
            'message' => "Successfully added the company"
        ]);
    }

    public function update(Request $request, $id)
    {
        $company = Company::findOrFail($id);

        $rules = [
            'code'    => ['required', 'unique:companies,code'],
            'name'    => ['required', 'unique:companies,name'],
            'origin'  => ['nullable'],
            'email'   => ['required', 'email'],
            'phone'   => ['required'],
            'address' => ['required'],
        ];

        if($company->code==$request->input('code')) {
            unset($rules['code']);
        }
        if($company->name==$request->input('name')) {
            unset($rules['name']);
        }

        $companyAttributes = $request->validate($rules);
        $company->update($companyAttributes);

        return redirect("/company")->with([
            'message' => "Successfully updated the company"
        ]);
    }

    public function destroy($id)
    {
        $company = Company::findOrFail($id);
        $company->delete();

        return redirect("/company")
            ->with([
                'message' => 'Successfully deleted the company',
            ]);
    }
}
