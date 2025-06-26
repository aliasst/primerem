<?php

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\SampleStage;
use App\Models\Stage;
use App\Models\StageFile;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectReportController extends Controller
{



    public function index(Project $project)
    {
        $stages = Stage::where('project_id', $project->id)->get();


        $stages = Stage::whereNull('stage_id')
            ->where('project_id', $project->id)
            ->with('child_stages')
            ->get();


        return view('cabinet.projects.reports.index', compact('stages', 'project'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project, Stage $stage)
    {
        $files = $stage->files()->get();

        return view('cabinet.projects.reports.show', compact('project', 'stage', 'files'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project, Stage $stage)
    {
        $files = $stage->files()->get();

        return view('cabinet.projects.reports.edit', compact('project', 'stage', 'files'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project, Stage $stage)
    {
        $validated = $request->validate([
            'comments' => ['string', 'nullable'],
            'file-stage' => ['max:2048', 'nullable'],
        ]);


        $status = $stage->update($validated);





        if ($request->hasfile('file-stage')) {
            foreach ($request->file('file-stage') as $file) {

            $name = $file->getClientOriginalName();
            $nameTrimmed = str_replace(' ', '', $name);
            $path = '/projects/' . $project->id . '/stages/' . $stage->id . '/';

            $file_data = [
                'stage_id' => $stage->id,
                'user_id' => auth()->user()->id,
                'project_id' => $project->id,
                'name' => $name,
                'file_path' => '/storage' . $path . $nameTrimmed,
                'storage_path' => $path . $nameTrimmed,
                'mime_type' => $file->getClientMimeType(),
                'extension' => $file->getClientOriginalExtension(),
            ];

            Storage::disk('public')->put($path . $nameTrimmed, $file->getContent());

            $file = StageFile::updateOrCreate([
                'name' => $name
            ], $file_data);
        }

        }




        if ($status) {
            request()->session()->flash('success', 'Отчет успешно обновлен!');

        } else {
            request()->session()->flash('error', 'Ошибка!!!');
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }



}
