<?php

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;
use App\Models\Contractor;
use App\Models\Project;
use App\Models\Purchase;
use App\Models\Stage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $validated = $request->validate([
            'sort' => ['nullable', 'string'],
        ]);

        $sort = $request->input('sort');
//        dd($sort);
        $sortCurrent = 'Дате создания';
        if($sort == 'name') {
            $sortCurrent = 'Названию';
        }
        if($sort == 'updated_at') {
            $sortCurrent = 'Дате изменения';
        }



        $projects = Project::query()
            ->when($validated['sort'] ?? null, function (Builder $query, string $sort) {
                $query->orderBy($sort, 'desc');
            })
            ->get();



//        $projects = Project::all();

        return view('cabinet.projects.index', compact('projects', 'sortCurrent'));
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
            'phone' => ['string', 'max:255', 'nullable'],
            'details' => ['string', 'nullable'],
        ]);

        $validated['user_id'] = auth()->user()->id;


        $project = Project::create($validated);

        if ($project) {

            Stage::makeStagesFromSample($project);

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

        return view('cabinet.projects.show', compact('project'));

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
            'phone' => ['string', 'max:255', 'nullable'],
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


    public function copy(Project $project)
    {

        $new_project = $project->replicate();
        $new_project->name = $new_project->name . '_копия';
        $new_project->save();



        foreach ($project->invoices as $invoice) {
            $clonedInvoice = $invoice->replicate();
            $newInvoice = $new_project->invoices()->save($clonedInvoice);
            foreach($invoice->files as  $file) {
                $clonedFile = $file->replicate();
//                $clonedFile->invoice_id = $newInvoice->id;
                $newInvoice->files()->save($clonedFile);

            }

        }


        foreach ($project->acts as $act) {
            $clonedAct = $act->replicate();
            $newAct = $new_project->acts()->save($clonedAct);
            foreach($act->files as  $file) {
                $clonedFile = $file->replicate();
                $newAct->files()->save($clonedFile);

            }

        }



        $stages = Stage::whereNull('stage_id')
            ->where('project_id', $project->id)
            ->with('child_stages')
            ->get();

        foreach($stages as  $stage)
    {
        $clonedStage = $stage->replicate();
        $clonedStage->project_id = $new_project->project_id;
        $newParentStage = $new_project->stages()->save($clonedStage);

        /*копируем подрядчиков*/
        $contractors = Contractor::where('stage_id', $stage->id)->get();
        foreach ($contractors as $contractor) {
            $clonedContractor = $contractor->replicate();
            $clonedContractor->stage_id = $newParentStage->id;
            $new_project->contractors()->save($clonedContractor);
        }

        /*копируем закупки*/
        $purchases = Purchase::where('stage_id', $stage->id)->get();
        foreach ($purchases as $purchase) {
            $clonedPurchase = $purchase->replicate();
            $clonedPurchase->stage_id = $newParentStage->id;
            $new_project->purchases()->save($clonedPurchase);
        }



//        dd($newParentStage->id);
        foreach($stage->child_stages as  $child_stage) {
            $clonedStage = $child_stage->replicate();
            $clonedStage->project_id = $new_project->project_id;
            $clonedStage->stage_id = $newParentStage->id;
            $newChildStage = $new_project->stages()->save($clonedStage);

            /*копируем подрядчиков*/
            $contractors = Contractor::where('stage_id', $child_stage->id)->get();
            foreach ($contractors as $contractor) {
                $clonedContractor = $contractor->replicate();
                $clonedContractor->stage_id = $newChildStage->id;
                $new_project->contractors()->save($clonedContractor);
            }

            /*копируем закупки*/
            $purchases = Purchase::where('stage_id', $child_stage->id)->get();
            foreach ($purchases as $purchase) {
                $clonedPurchase = $purchase->replicate();
                $clonedPurchase->stage_id = $newChildStage->id;
                $new_project->purchases()->save($clonedPurchase);
            }

        }
    }




        $status = true;

        if ($status) {
            request()->session()->flash('success', 'Проект скопирован!');

        } else {
            request()->session()->flash('error', 'Ошибка!!!');
        }

        return redirect()->route('cabinet.project.index');
    }


    public function copyStages(Project $project)
    {

        $new_project = $project->replicate();
        $new_project->name = $new_project->name . '_копия';
        $new_project->save();



        $stages = Stage::whereNull('stage_id')
            ->where('project_id', $project->id)
            ->with('child_stages')
            ->get();

        foreach($stages as  $stage)
        {
            $clonedStage = $stage->replicate();
            $clonedStage->project_id = $new_project->project_id;
            $clonedStage->comments = null;
            $clonedStage->start_date = '';
            $clonedStage->finish_date = '';
            $clonedStage->status = 'status_1';
            $newParentStage = $new_project->stages()->save($clonedStage);


            foreach($stage->child_stages as  $child_stage) {
                $clonedStage = $child_stage->replicate();
                $clonedStage->project_id = $new_project->project_id;
                $clonedStage->comments = null;
                $clonedStage->start_date = '';
                $clonedStage->finish_date = '';
                $clonedStage->status = 'status_1';
                $clonedStage->stage_id = $newParentStage->id;
                $newChildStage = $new_project->stages()->save($clonedStage);





            }
        }




        $status = true;

        if ($status) {
            request()->session()->flash('success', 'Проект скопирован!');

        } else {
            request()->session()->flash('error', 'Ошибка!!!');
        }

        return redirect()->route('cabinet.project.index');
    }


}
