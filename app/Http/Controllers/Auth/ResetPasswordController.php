<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    public function showResetForm(Request $request, $token, $email)
    {
        $user_data = User::where('email', $email)->first();
        $user=$user_data->id;
        $first_name=$user_data->first_name;
        // Check if the user exists and proceed with the password reset form
        if ($user) {
            return view('auth.passwords.reset', compact('token','email','first_name'));
        } else {
            // Handle the case when the user with the given email does not exist
            return redirect()->route('password.request')->with('error', 'User not found.');
        }

    }

    public function createPasswordForm(Request $request, $token, $email)
    {
        $user = User::where('email', $email)->first()->id ?? null;
        if ($user == null) {
            return redirect()->route('login')->with('error', 'User not found,Contact Admin');
        }
        if ($user) {
            return view('auth.passwords.create', compact('token','email'));
        } else {
            // Handle the case when the user with the given email does not exist
            return redirect()->route('password.request')->with('error', 'User not found.');
        }

    }
}
