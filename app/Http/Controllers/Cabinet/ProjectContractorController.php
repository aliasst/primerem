<?php

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;
use App\Models\Contractor;
use App\Models\Project;
use App\Models\Stage;
use Illuminate\Http\Request;

class ProjectContractorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Project $project)
    {
        $contractors = Contractor::where('project_id', $project->id)->get();

        return view('cabinet.projects.contractors.index', compact('contractors', 'project'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Project $project)
    {
        $stages = Stage::whereNull('stage_id')
            ->where('project_id', $project->id)
            ->with('child_stages')
            ->get();

        return view('cabinet.projects.contractors.create', compact('project', 'stages' ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'stage_id' => ['required', 'string'],
            'comments' => ['string', 'nullable'],
            'start_date' => ['date', 'nullable'],
            'finish_date' => ['date', 'nullable'],

        ]);


        $validated['user_id'] = auth()->user()->id;
        $validated['project_id'] = $project->id;

        $status = Contractor::create($validated);

        if($status) {
            request()->session()->flash('success', 'Подрядчик добавлен!');
        } else {
            request()->session()->flash('error', 'Ошибка!!!');
        }

        return redirect()->route('cabinet.project.contractor.index', $project->id);


    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project, Contractor $contractor)
    {
        return view('cabinet.projects.contractors.show', compact('contractor',  'project' ));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project, Contractor $contractor)
    {

        $stages = Stage::whereNull('stage_id')
            ->where('project_id', $project->id)
            ->with('child_stages')
            ->get();

        return view('cabinet.projects.contractors.edit', compact('contractor',  'project', 'stages' ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project, Contractor $contractor)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'stage_id' => ['required', 'string'],
            'comments' => ['string', 'nullable'],
            'start_date' => ['date', 'nullable'],
            'finish_date' => ['date', 'nullable'],
        ]);



        $status = $contractor->update($validated);

        if ($status) {
            request()->session()->flash('success', 'Подрядчик обновлен!');

        } else {
            request()->session()->flash('error', 'Ошибка!!!');
        }



        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project, Contractor $contractor)
    {
        $status = $contractor->delete();

        if ($status) {
            request()->session()->flash('success', 'Подрядчик удален!');

        } else {
            request()->session()->flash('error', 'Ошибка!!!');
        }

        return redirect()->route('cabinet.project.contractor.index', $project->id);
    }
}
