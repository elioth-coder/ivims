<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;

class AgentController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'AGENT')->get();

        $users = $users->map(function (Object $user) {
            $user->company = Company::findOrFail($user->company_id);

            return $user;
        });

        return view('agent.index', [
            'users' => $users,
        ]);
    }

    public function create()
    {
        $companies = Company::all();

        return view('agent.create', [
            'companies' => $companies,
        ]);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $user->company = Company::findOrFail($user->company_id);
        $companies = Company::all();

        return view('agent.edit', [
            'user'      => $user,
            'companies' => $companies,
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
            'company_id' => ['required', 'exists:companies,id'],
            'email'      => ['required', 'email', 'unique:users,email'],
        ]);

        $userAttributes['name'] = $userAttributes['first_name'] . " " . $userAttributes['last_name'];
        $userAttributes['role'] = 'AGENT';

        $user = User::create($userAttributes);

        return redirect('/agent/create')->with([
            'message' => "Successfully added an agent"
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
            'email'      => ['required', 'email', 'unique:users,email'],
        ];

        if($user->email==$request->input('email')) {
            unset($rules['email']);
        }

        $userAttributes = $request->validate($rules);
        $userAttributes['role'] = 'AGENT';
        $user->update($userAttributes);

        return redirect("/agent")->with([
            'message' => "Successfully updated the agent"
        ]);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect("/agent")
            ->with([
                'message' => 'Successfully deleted the agent',
            ]);
    }
}
