<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RedirectsUsers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\View\View;
use RealRashid\SweetAlert\Facades\Alert;

class NewPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | New Password Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new password after user's
    | successful email verification.
    |
    */

    use RedirectsUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected string $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display the new password view
     *
     * @return View
     */
    public function showNewPasswordForm(): View
    {
        return view('auth.passwords.new');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function new(Request $request): RedirectResponse
    {
        $this->validator($request->all())->validate();

        $this->createPassword(Auth::user(), $request->input('password'));

        Alert::toast('New password created successfully', 'success');

        return redirect($this->redirectPath());
    }

    /**
     * Get a validator for an incoming new user password request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data): \Illuminate\Contracts\Validation\Validator
    {
        return Validator::make($data, [
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create the given user's new password
     *
     * @param $user
     * @param $password
     * @return void
     */
    protected function createPassword($user, $password): void
    {
        $this->setUserPassword($user, $password);

        $user->setRememberToken(Str::random(60));

        $user->save();

        // TODO - Fire new password created event event(new NewPassword());
    }

    /**
     * Set the user's new password.
     *
     * @param $user
     * @param $password
     * @return void
     */
    protected function setUserPassword($user, $password): void
    {
        $user->password = Hash::make($password);
    }
}
