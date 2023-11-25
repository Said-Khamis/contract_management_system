<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\MailResetPasswordToken;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;


class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    public function sendResetLinkEmail(Request $request)
    {
        $this->validateEmail($request);
        $user = User::where('email', $request->email)->first();
        if ($user) {
            $token = Password::createToken($user);
            $user->notify(new MailResetPasswordToken($token, $user));
        }
        return back()->with('status', trans('passwords.sent'));
    }

    public function passwordStore(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate($this->rules(), $this->validationErrorMessages());
        // Log out the user
        Auth::logout();
        $user = $this->broker()->getUser($request->only('email'));
        $token = $request->input('token');
        if(!$user){
            return redirect()->back()->with('error', 'The email address you provided does not match.');
        }
        $passwordReset = DB::table('password_resets')
            ->where('email', $user->email)
            ->where('token', $token)
            ->where('created_at', '>=', now()->subHours(1))
            ->first();
        if (! $passwordReset) {
            return redirect()->back()->with('error', 'Invalid token or email address.');
        }
        $user = User::where('email', $request->input('email'))->first();
        if ($user) {
            $user_password = Hash::make($request->input('password'));
            $user_token = Str::random(60);
            DB::table('users')
                ->where('email', $request->input('email'))
                ->update([
                    'email_verified_at' => now(),
                    'password' => $user_password,
                    'remember_token' => $user_token,
                ]);
            $message = "Password Changed successful.";
            session()->flash('success', $message);
        }
        return redirect()->route('login');

    }

    /**
     * Get the password reset validation rules.
     *
     * @return array
     */
    protected function rules()
    {
        return [
            'token' => 'required',
            'email' => 'required|email',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ];
    }

    /**
     * Get the password reset validation error messages.
     *
     * @return array
     */
    protected function validationErrorMessages()
    {
        return [];
    }
}
