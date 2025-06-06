<?php

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SuperUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where('role', 'superadmin')->get();
        return view('cabinet.superusers.index', compact( 'users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cabinet.superusers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'nullable'],
            'email' => ['required', 'string', 'email', 'max:255', 'nullable'],
            'password' => ['required', 'string', 'min:8', 'confirmed', 'nullable'],
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['role'] = 'superadmin';



        $status = User::create($validated);

        if($status) {
            request()->session()->flash('success', 'Пользователь добавлен!');
        } else {
            request()->session()->flash('error', 'Ошибка!!!');
        }

        return redirect()->route('cabinet.superuser.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {

        return view('cabinet.superusers.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'nullable'],
            'email' => ['required', 'string', 'email', 'max:255', 'nullable'],
            'password' => ['string', 'min:8', 'confirmed', 'nullable'],
        ]);

        if($validated['password']) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }



        $status = $user->update($validated);

        if ($status) {
            request()->session()->flash('success', 'Данные пользователя успешно обновлены!');

        } else {
            request()->session()->flash('error', 'Ошибка!!!');
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $status = $user->delete();

        if ($status) {
            request()->session()->flash('success', 'Пользователь удален!');

        } else {
            request()->session()->flash('error', 'Ошибка!!!');
        }

        return redirect()->route('cabinet.superuser.index');
    }
}
