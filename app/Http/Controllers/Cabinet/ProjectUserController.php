<?php

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProjectUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Project $project)
    {
        $users = User::where('project_id', $project->id)->get();
        return view('cabinet.projects.users.index', compact('project', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Project $project)
    {
        return view ('cabinet.projects.users.create', compact('project'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Project $project)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'nullable'],
            'email' => ['required', 'string', 'email', 'max:255', 'nullable'],
            'role' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed', 'nullable'],
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['project_id'] = $project->id;



        $status = User::create($validated);

        if($status) {
            request()->session()->flash('success', 'Пользователь добавлен!');
        } else {
            request()->session()->flash('error', 'Ошибка!!!');
        }

        return redirect()->route('cabinet.project.user.index', $project->id);


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
    public function edit(Project $project, User $user)
    {


        return view('cabinet.projects.users.edit', compact('project', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project, User $user)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'nullable'],
            'email' => ['required', 'string', 'email', 'max:255', 'nullable'],
            'role' => ['required', 'string'],
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
    public function destroy(Project $project, User $user)
    {
        $status = $user->delete();

        if ($status) {
            request()->session()->flash('success', 'Пользователь удален!');

        } else {
            request()->session()->flash('error', 'Ошибка!!!');
        }

        return redirect()->route('cabinet.project.user.index', $project->id);
    }
}
