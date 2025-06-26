<?php

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;
use App\Models\Contractor;
use App\Models\Project;
use App\Models\Purchase;
use App\Models\Stage;
use Illuminate\Http\Request;

class ProjectPurchaseController extends Controller
{
    public function index(Project $project)
    {
        $purchases = Purchase::where('project_id', $project->id)->get();

        return view('cabinet.projects.purchases.index', compact('purchases', 'project'));
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

        return view('cabinet.projects.purchases.create', compact('project', 'stages' ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['string', 'nullable'],
            'stage_id' => ['required', 'string'],
            'comments' => ['string', 'nullable'],
            'purchase_date' => ['date', 'nullable'],

        ]);


        $validated['user_id'] = auth()->user()->id;
        $validated['project_id'] = $project->id;

        $status = Purchase::create($validated);

        if($status) {
            request()->session()->flash('success', 'Закупка добавлена!');
        } else {
            request()->session()->flash('error', 'Ошибка!!!');
        }

        return redirect()->route('cabinet.project.purchase.index', $project->id);


    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project, Purchase $purchase)
    {
        return view('cabinet.projects.purchases.show', compact('purchase',  'project' ));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project, Purchase $purchase)
    {

        $stages = Stage::whereNull('stage_id')
            ->where('project_id', $project->id)
            ->with('child_stages')
            ->get();

        return view('cabinet.projects.purchases.edit', compact('purchase',  'project', 'stages' ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project, Purchase $purchase)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['string', 'nullable'],
            'stage_id' => ['required', 'string'],
            'comments' => ['string', 'nullable'],
            'purchase_date' => ['date', 'nullable'],
        ]);



        $status = $purchase->update($validated);

        if ($status) {
            request()->session()->flash('success', 'Закупка обновлена!');

        } else {
            request()->session()->flash('error', 'Ошибка!!!');
        }



        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project, Purchase $purchase)
    {
        $status = $purchase->delete();

        if ($status) {
            request()->session()->flash('success', 'Закупка удалена!');

        } else {
            request()->session()->flash('error', 'Ошибка!!!');
        }

        return redirect()->route('cabinet.project.purchase.index', $project->id);
    }
}
