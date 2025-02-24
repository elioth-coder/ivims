<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;

class AgentController extends Controller
{
    public function index()
    {
        $users = User::latest()->whereIn('role', ['AGENT','SUBAGENT','SUPPORT'])->get();

        $users = $users->map(function (Object $user) {
            if($user->company_id) {
                $user->company = Company::findOrFail($user->company_id);
            }

            if($user->branch_id) {
                $user->branch = Branch::findOrFail($user->branch_id);
            }

            return $user;
        });

        return view('agent.index', [
            'users' => $users,
        ]);
    }

    public function create()
    {
        $companies = Company::all();
        $branches  = Branch::all();

        return view('agent.create', [
            'companies' => $companies,
            'branches'  => $branches,
        ]);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $user->company = Company::findOrFail($user->company_id);
        $companies = Company::all();
        $branches  = Branch::all();

        return view('agent.edit', [
            'user'      => $user,
            'companies' => $companies,
            'branches'  => $branches,
        ]);
    }

    public function store(Request $request)
    {
        $userAttributes = $request->validate([
            'first_name' => ['required'],
            'last_name'  => ['required'],
            'gender'     => ['required'],
            'birthday'   => ['required'],
            'contact_no' => ['required'],
            'company_id' => ['nullable', 'exists:companies,id'],
            'branch_id'  => ['nullable', 'exists:branches,id'],
            'email'      => ['required', 'email', 'unique:users,email'],
            'license_duration' => ['nullable'],
            'start_date'  => ['nullable', 'date'],
            'expiry_date' => ['nullable', 'date'],
            'role'        => ['required'],
        ]);

        $userAttributes['status'] = 'new';
        $userAttributes['name'] = $userAttributes['first_name'] . " " . $userAttributes['last_name'];

        $user = User::create($userAttributes);

        return redirect('/user/agent/create')->with([
            'message' => "Successfully added " . strtolower($userAttributes['role'])
        ]);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $rules = [
            'first_name' => ['required'],
            'last_name'  => ['required'],
            'gender'     => ['required'],
            'birthday'   => ['required'],
            'contact_no' => ['required'],
            'company_id' => ['required', 'exists:companies,id'],
            'branch_id'  => ['required', 'exists:branches,id'],
            'email'      => ['required', 'email', 'unique:users,email'],
            'role'       => ['required'],
        ];

        if($user->email==$request->input('email')) {
            unset($rules['email']);
        }

        $userAttributes = $request->validate($rules);
        $user->update($userAttributes);

        return redirect("/user/agent")->with([
            'message' => "Successfully updated the " . strtolower($userAttributes['role']),
        ]);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect("/user/agent")
            ->with([
                'message' => 'Successfully deleted the agent',
            ]);
    }
}
