<?php

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\SampleStage;
use App\Models\Stage;
use Illuminate\Http\Request;

class ProjectStageController extends Controller
{


    public function test()
    {
        $stages = SampleStage::with('sample_stages')->get();

        $stages = SampleStage::whereNull('sample_stage_id')
            ->with('sample_stages')
            ->get();



         foreach ($stages as $stage)
         {
             dump($stage->title);

             $data = [
                 'title' => $stage->title,
                 'sort' => $stage->sort,
                 'stage_id' => null,
             ];

             $item = Stage::create($data);

             echo $item->id;


             foreach ($stage->sample_stages as $child_stage)
             {
//                 echo 'дочерний';
//                 dump($child_stage->title);

                 $data = [
                     'title' => $child_stage->title,
                     'sort' => $child_stage->sort,
                     'stage_id' => $item->id,
                 ];

                Stage::create($data);



             }

         }



    }

    public function index(Project $project)
    {
        $stages = Stage::where('project_id', $project->id)->get();

        $stages = Stage::whereNull('stage_id')
            ->where('project_id', $project->id)
            ->with('child_stages')
            ->get();


        return view('cabinet.projects.stages.index', compact( 'stages', 'project'));

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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project, Stage $stage )
    {
        return view('cabinet.projects.stages.edit', compact('project', 'stage'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project, Stage $stage)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255', 'nullable'],
            'status' => ['required', 'string'],
            'start_date' => ['string', 'nullable'],
            'finish_date' => ['string', 'nullable'],
        ]);


        $status = $stage->update($validated);

        if ($status) {
            request()->session()->flash('success', 'Данные этапа успешно обновлены!');

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
