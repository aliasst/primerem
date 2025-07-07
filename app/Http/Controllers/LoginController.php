<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginFormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        if (Auth::user()->role == 'superadmin') {
            return redirect()->intended(route('cabinet.dashboard'));
        } else {
            return redirect()->route('cabinet.project.show', Auth::user()->project_id);
        }

    }

    public function logout(Request $request)
    {

        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
