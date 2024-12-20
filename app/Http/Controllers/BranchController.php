<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BranchController extends Controller
{
    public function index()
    {
        $company_id = Auth::user()->company_id;
        $branches = Branch::where('company_id', $company_id)->get();

        if($branches->count() > 0) {
            $branches = $branches->map(function($branch) {
                $branch->company = Company::findOrFail($branch->company_id);

                return $branch;
            });
        }

        return view('branch.index', [
            'branches' => $branches,
        ]);
    }

    public function create()
    {
        return view('branch.create');
    }

    public function edit($id)
    {
        $selected  = Branch::findOrFail($id);
        $companies = Company::all();

        return view('branch.edit', [
            'selected'  => $selected,
            'companies' => $companies,
        ]);
    }
    public function store(Request $request)
    {
        $branchAttributes = $request->validate([
            'code'       => ['required'],
            'name'       => ['required'],
            'email'      => ['required', 'email'],
            'phone'      => ['required'],
            'address'    => ['required'],
        ]);

        $branchAttributes['company_id'] = Auth::user()->company_id;

        $branch = Branch::create($branchAttributes);

        return redirect('/branch/create')->with([
            'message' => "Successfully added a branch"
        ]);
    }

    public function update(Request $request, $id)
    {
        $branch = Branch::findOrFail($id);

        $rules = [
            'code'       => ['required'],
            'name'       => ['required'],
            'email'      => ['required', 'email'],
            'phone'      => ['required'],
            'address'    => ['required'],
        ];

        $branchAttributes = $request->validate($rules);
        $branchAttributes['company_id'] = Auth::user()->company_id;

        $branch->update($branchAttributes);

        return redirect("/branch")->with([
            'message' => "Successfully updated the branch"
        ]);
    }

    public function destroy($id)
    {
        $branch = Branch::findOrFail($id);
        $branch->delete();

        return redirect("/branch")
            ->with([
                'message' => 'Successfully deleted the branch',
            ]);
    }
}
