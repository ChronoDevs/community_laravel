<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Providers\RouteServiceProvider;
use App\Http\Services\RoleService;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\LinkedSocialAccount;
use App\Models\User;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function index()
    {
        return view('auth.login');
    }
    /**
     * Authenticate a user
     *
     */
    public function login(LoginRequest $request)
    {
        $data = $request->all([
            'email',
            'password'
        ]);

        if (auth()->attempt($data, $request->remember ?? 0)) {
            $request->session()->regenerate();
            if (RoleService::isAdmin()) {
                return redirect()->intended(RouteServiceProvider::ADMIN_HOME)->with('success', trans('messages.login.success'));
            }
            return redirect()->intended(RouteServiceProvider::HOME)->with('success', trans('messages.login.success'));
        };

        return back()->with('error', trans('auth.failed'));
    }

    /**
     * Logs out a user
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        return redirect()->route('login');
    }

    public function loginWithGoogle(Request $request)
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();

            $user = User::where('email', $googleUser->email)->first();

            $socialAccount = LinkedSocialAccount::updateOrCreate([
                'user_id' => $user->id,
                'provider_id' => $googleUser->id,
                'provider_name' => 'google',
                'email' => $googleUser->email,
            ]);

            Auth::login($user);

            $request->session()->regenerate();

            return redirect('/')->with('success', trans('messages.login.success'));
        } catch(Throwable $e) {
            return back()->with('error', trans('messages.login.error'));
        }
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
}
