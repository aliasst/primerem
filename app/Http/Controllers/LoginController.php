<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginFormRequest;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(LoginFormRequest $request)
    {
        if(!auth()->attempt($request->validated())) {
            return back()->withErrors([
                'email' => 'Пользователя с таким e-mail не существует',
            ])->onlyInput('email');
        }

        $request->session()->regenerate();

        return redirect()->intended(route('cabinet.dashboard'));
    }

    public function logout(Request $request)
    {

        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
