<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\RegisterFormRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function register(RegisterFormRequest $request)
    {
        $user = User::query()->create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password')),
        ]);

        event(new Registered($user));
        auth()->login($user);

        return redirect()->route('cabinet.dashboard');
    }
}
