<?php

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
            $projects = Project::all();

            return view('cabinet.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cabinet.projects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'organization' => ['required', 'string', 'max:255', 'nullable'],
            'email' => ['string', 'email', 'max:255', 'nullable'],
            'phone' => ['string','max:255', 'nullable'],
            'details' => ['string', 'nullable'],
        ]);

        $validated['user_id'] = auth()->user()->id;


        $status = Project::create($validated);

        if ($status) {
            request()->session()->flash('success', 'Проект добавлен!');

        } else {
            request()->session()->flash('error', 'Ошибка!!!');
        }

        return redirect()->route('cabinet.project.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        return view('cabinet.projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'organization' => ['required', 'string', 'max:255', 'nullable'],
            'email' => ['string', 'email', 'max:255', 'nullable'],
            'phone' => ['string','max:255', 'nullable'],
            'details' => ['string', 'nullable'],
        ]);

        $status = $project->update($validated);


        if ($status) {
            request()->session()->flash('success', 'Данные проекта успешно обновлены!');

        } else {
            request()->session()->flash('error', 'Ошибка!!!');
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $status = $project->delete();

        if ($status) {
            request()->session()->flash('success', 'Проект удален!');

        } else {
            request()->session()->flash('error', 'Ошибка!!!');
        }

        return redirect()->route('cabinet.project.index');
    }
}
