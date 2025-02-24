<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class TechSupportController extends Controller
{
    public function index()
    {
        $users = User::latest()->whereIn('role', ['TECH_SUPPORT'])->get();

        return view('tech_support.index', [
            'users' => $users,
        ]);
    }

    public function create()
    {
        return view('tech_support.create');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('tech_support.edit', [
            'user' => $user,
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
            'email'      => ['required', 'email', 'unique:users,email'],
        ]);

        $userAttributes['status'] = 'new';
        $userAttributes['role']   = 'TECH_SUPPORT';
        $userAttributes['name']   = $userAttributes['first_name'] . " " . $userAttributes['last_name'];

        $user = User::create($userAttributes);

        return redirect('/user/tech_support/create')->with([
            'message' => "Successfully added user"
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
            'email'      => ['required', 'email', 'unique:users,email'],
        ];

        if($user->email==$request->input('email')) {
            unset($rules['email']);
        }

        $userAttributes = $request->validate($rules);
        $user->update($userAttributes);

        return redirect("/user/tech_support")->with([
            'message' => 'Successfully updated the user',
        ]);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect("/user/tech_support")
            ->with([
                'message' => 'Successfully deleted the user',
            ]);
    }
}
