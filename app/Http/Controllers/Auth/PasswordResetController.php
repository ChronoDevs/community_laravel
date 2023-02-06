<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\SendResetLinkRequest;
use Illuminate\Support\Facades\Password;
use App\Http\Requests\ResetPasswordRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Auth\Events\PasswordReset;

class PasswordResetController extends Controller
{
    public function index()
    {
        return view('auth.forget-password');
    }

    public function send(SendResetLinkRequest $request)
    {
        $status = Password::sendResetLink(
            $request->only('email')
        );

        return back()->with('success', __('messages.success.send_mail'));
    }

    public function sendResetLink($token)
    {
        return view('auth.reset-password', ['token' => $token]);
    }

    public function update(ResetPasswordRequest $request)
    {
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }
}
