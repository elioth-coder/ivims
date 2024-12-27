<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SubagentController extends Controller
{
    public function index()
    {
        $company_id = Auth::user()->company_id;
        $users =
            User::where('role', 'subagent')
                ->where('company_id', $company_id)
                ->get();
        $users = $users->map(function (Object $user) {
            $user->branch = Branch::find($user->branch_id);

            return $user;
        });

        return view('subagent.index', [
            'users' => $users,
        ]);
    }

    public function create()
    {
        $branches = Branch::all();

        return view('subagent.create', [
            'branches' => $branches,
        ]);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $user->branch = Branch::findOrFail($user->company_id);
        $branches = Branch::all();

        return view('subagent.edit', [
            'user'     => $user,
            'branches' => $branches,
        ]);
    }
    public function store(Request $request)
    {
        $company_id = Auth::user()->company_id;

        $userAttributes = $request->validate([
            'first_name' => ['required'],
            'last_name'  => ['required'],
            'gender'     => ['required'],
            'birthday'   => ['required'],
            'contact_no' => ['required'],
            'branch_id'  => ['required', 'exists:branches,id'],
            'email'      => ['required', 'email', 'unique:users,email'],
        ]);

        $userAttributes['name'] = $userAttributes['first_name'] . " " . $userAttributes['last_name'];
        $userAttributes['role'] = 'subagent';
        $userAttributes['company_id'] = $company_id;

        $user = User::create($userAttributes);

        return redirect('/subagent/create')->with([
            'message' => "Successfully added a subagent"
        ]);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $company_id = Auth::user()->company_id;

        $rules = [
            'first_name' => ['required'],
            'last_name'  => ['required'],
            'gender'     => ['required'],
            'birthday'   => ['required'],
            'contact_no' => ['required'],
            'branch_id'  => ['required', 'exists:branches,id'],
            'email'      => ['required', 'email', 'unique:users,email'],
        ];

        if($user->email==$request->input('email')) {
            unset($rules['email']);
        }

        $userAttributes = $request->validate($rules);
        $userAttributes['company_id'] = $company_id;
        $user->update($userAttributes);

        return redirect("/subagent")->with([
            'message' => "Successfully updated the subagent"
        ]);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect("/subagent")
            ->with([
                'message' => 'Successfully deleted the subagent',
            ]);
    }
}
