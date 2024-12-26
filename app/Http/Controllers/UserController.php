<?php

namespace App\Http\Controllers;

use App\Mail\ActivateAccountMail;
use App\Models\PolicyHolder;
use App\Models\Token;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function check_email()
    {
        if(!session('confirm')) {
            return redirect('/');
        }

        return view('check_email');
    }

    public function register()
    {
        return view('register');
    }

    public function login_view()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        try {
            $attributes = $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]);

            if (!Auth::attempt($attributes)) {
                throw ValidationException::withMessages([
                    'credential' => 'Incorrect username or password',
                ]);
            }

            $request->session()->regenerate();

            return response()->json([
                'status'  => 'success',
                'message' => 'Successfully logged in',
            ]);
        } catch(Exception $e) {
            return response()->json([
                'status'  => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function logout()
    {
        Auth::logout();

        return response()->json([
            'status' => 'success',
        ]);
    }

    public function email_registration(Request $request)
    {
        $userAttributes = $request->validate([
            'email'        => ['required', 'email'],
            'password'     => ['required', 'confirmed', Password::min(8)],
        ]);

        $user = User::where('email', $userAttributes['email'])->first();

        if (!$user) {
            $policy_holder = PolicyHolder::where('email', $userAttributes['email'])->first();

            if(!$policy_holder) {
                throw ValidationException::withMessages([
                    'email' => 'The email you entered does not exist in our database',
                ]);
            } else {
                $user = User::create([
                    'name'       => $policy_holder->first_name . " " . $policy_holder->last_name,
                    'first_name' => $policy_holder->first_name,
                    'last_name'  => $policy_holder->last_name,
                    'gender'     => $policy_holder->gender,
                    'birthday'   => $policy_holder->birthday,
                    'contact_no' => $policy_holder->contact_no,
                    'email'      => $policy_holder->email,
                    'role'       => 'POLICY_HOLDER',
                ]);
            }
        } else {
            if($user->password != NULL){
                throw ValidationException::withMessages([
                    'email' => 'Account already exists',
                ]);
            }
        }

        $password = Hash::make($userAttributes['password']);
        $generated_token = Str::uuid();
        Token::create([
            'token' => $generated_token,
            'data'  => json_encode([
                'name'        => $user->first_name. " " .$user->last_name,
                'email'       => $userAttributes['email'],
                'password'    => $password,
                'role'        => $user->role,
            ], JSON_UNESCAPED_UNICODE),
            'expiration' => Carbon::now()->addDays(3),
        ]);

        Mail::to($userAttributes['email'])->send(new ActivateAccountMail([
            'name'            => $user->first_name . " " . $user->last_name,
            'app_domain'      => env('APP_DOMAIN'),
            'app_url'         => env('APP_URL'),
            'activation_link' => env('APP_URL') . '/email_activation/' . $generated_token,
        ]));

        return redirect('/check_email')->with([
            'confirm' => true,
        ]);
    }

    public function email_activation($token_value)
    {
        try {
            $token = Token::where('token', $token_value)->first();

            if(!$token) {
                throw ValidationException::withMessages([
                    'token' => 'Error: The token you provided is invalid or missing.',
                ]);
            }
            if(Carbon::today()->gte(Carbon::parse($token->expiration))) {
                throw ValidationException::withMessages([
                    'token' => 'Error: The provided token is incorrect or has expired.',
                ]);
            }

            $data = json_decode($token->data);
            $user = User::where('email', $data->email)->first();

            $user->update([
                'password' => $data->password,
            ]);

            $token->delete();

            return view('activation_status');
        } catch(Exception $e) {
            return view('activation_status', [
                'error' => $e->getMessage()
            ]);
        }
    }
}
