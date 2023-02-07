<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Models\User;

class UserController extends Controller
{
    public function index ()
    {
        return view('auth.register');
    }

    /**
     * Registers a new user
     *
     * @param App\Http\Requests\UserRequest $request
     *
     * @return mixed
     */
    public function register (UserRequest $request)
    {
        $data = $request->validated();
        $register = app(User::class)->registerUser($data);

        if ($register) {
            return redirect()->route('login.index')->with('success', trans('messages.register.success'));
        }

        return back()->with('error', trans('messages.error'));

    }
}
