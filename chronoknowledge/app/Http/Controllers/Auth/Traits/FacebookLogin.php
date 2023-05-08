<?php

namespace App\Http\Controllers\Auth\Traits;

use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

trait FacebookLogin {
    /**
     * redirect link
     */
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Logs in a user
     */
    public function loginWithFacebook(Request $request)
    {
        try {

            $facebookUser = Socialite::driver('facebook')->stateless()->user();
            $user = User::where('email', $facebookUser->email)->first();

            if (!$user) {
                if ($method == 'register') {
                  $user = $this->user->registerUserViaGoogle($facebookUser);

                    if ($user) {
                        return redirect()->route('login.index')->with('success', trans('messages.register.success'));
                    }
                } else {
                    return back()->with('error', trans('auth.failed'));
                }
            }

            $this->socialAccount->store($user, $facebookUser);

            Auth::login($user);

            $request->session()->regenerate();

            return redirect('/')->with('success', trans('messages.login.success'));

        } catch (Exception $exception) {
            dd($exception->getMessage());
        }
    }
}
