<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function index()
    {
        $users = User::whereNotIn('role', ['admin'])->get();

        $users = $users->map(function (Object $user) {
            $user->company = Company::findOrFail($user->company_id);

            return $user;
        });

        return view('user.index', [
            'users' => $users,
        ]);
    }

    public function create()
    {
        $companies = Company::all();

        return view('user.create', [
            'companies' => $companies,
        ]);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $user->company = Company::findOrFail($user->company_id);
        $companies = Company::all();

        return view('user.edit', [
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
            'password'   => ['required', 'confirmed', Password::min(8)],
            'role'       => ['required'],
        ]);

        $userAttributes['name'] = $userAttributes['first_name'] . " " . $userAttributes['last_name'];

        $user = User::create($userAttributes);

        return redirect('/user/create')->with([
            'message' => "Successfully added a user"
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
            'password'   => ['required', 'confirmed', Password::min(8)],
            'role'       => ['required'],
        ];

        if($user->email==$request->input('email')) {
            unset($rules['email']);
        }
        if(!$request->input('password')) {
            unset($rules['password']);
        }

        $userAttributes = $request->validate($rules);
        $user->update($userAttributes);

        return redirect("/user")->with([
            'message' => "Successfully updated the user"
        ]);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect("/user")
            ->with([
                'message' => 'Successfully deleted the user',
            ]);
    }

    public function login_view()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $attributes = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (!Auth::attempt($attributes)) {
            throw ValidationException::withMessages([
                'credential' => 'Incorrect username or password',
            ]);
        }

        if(Auth::user()->status=='inactive') {
            Auth::logout();
            throw ValidationException::withMessages([
                'credential' => 'Cannot login, your account is locked by admin',
            ]);
        }

        $request->session()->regenerate();
        return redirect('/');
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }
}
