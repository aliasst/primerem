<?php

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return view('cabinet.profile.index', compact('user'));
    }


    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'nullable'],
            'email' => ['required', 'string', 'email', 'max:255', 'nullable'],
            'password' => ['string', 'min:8', 'confirmed', 'nullable'],
        ]);

        if ($validated['password']) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }


        $status = $user->update($validated);


        if ($request->hasfile('avatar')) {
            $file = $request->file('avatar');

            $name = $file->getClientOriginalName();
            $nameTrimmed = str_replace(' ', '', $name);
            $path = '/profiles/' . $user->id . '/avatars/';

            $file_data = [
                'avatar_file_path' => '/storage' . $path . $nameTrimmed,
                'avatar_storage_path' => $path . $nameTrimmed,
            ];

            Storage::disk('public')->put($path . $nameTrimmed, $file->getContent());



            $status = $user->update($file_data);

        }


        if ($status) {
            request()->session()->flash('success', 'Данные пользователя успешно обновлены!');

        } else {
            request()->session()->flash('error', 'Ошибка!!!');
        }

        return redirect()->back();
    }


}
