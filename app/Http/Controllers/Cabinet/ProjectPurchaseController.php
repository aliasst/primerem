<?php

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;
use App\Models\Contractor;
use App\Models\Project;
use App\Models\Purchase;
use App\Models\PurchaseFile;
use App\Models\Stage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectPurchaseController extends Controller
{
    public function index(Request $request, Project $project)
    {

        $validated = $request->validate([
            'sort' => ['nullable', 'string'],
        ]);

        $sort = $request->input('sort');
//        dd($sort);
        $sortCurrent = 'Дате создания';
        if($sort == 'title') {
            $sortCurrent = 'Названию';
        }
        if($sort == 'updated_at') {
            $sortCurrent = 'Дате изменения';
        }



        $purchases = Purchase::query()
            ->when($validated['sort'] ?? null, function (Builder $query, string $sort) {
                $query->orderBy($sort, 'desc');
            })
            ->where('project_id', $project->id)
//            ->with('files')
            ->get();


//        $purchases = Purchase::where('project_id', $project->id)->get();

        return view('cabinet.projects.purchases.index', compact('purchases', 'project', 'sortCurrent'));
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
            'file-purchase' => ['max:2048', 'nullable'],

        ]);




        $validated['user_id'] = auth()->user()->id;
        $validated['project_id'] = $project->id;

        $purchase = Purchase::create($validated);

        if ($request->hasfile('file-purchase')) {
            foreach ($request->file('file-purchase') as $file) {

                $name = $file->getClientOriginalName();
                $nameTrimmed = str_replace(' ', '', $name);
                $path = '/projects/' . $project->id . '/purchases/' . $purchase->id . '/';

                $file_data = [
                    'purchase_id' => $purchase->id,
                    'user_id' => auth()->user()->id,
                    'project_id' => $project->id,
                    'name' => $name,
                    'file_path' => '/storage' . $path . $nameTrimmed,
                    'storage_path' => $path . $nameTrimmed,
                    'mime_type' => $file->getClientMimeType(),
                    'extension' => $file->getClientOriginalExtension(),
                ];

                Storage::disk('public')->put($path . $nameTrimmed, $file->getContent());

                $file = PurchaseFile::updateOrCreate([
                    'name' => $name
                ], $file_data);
            }

        }


        if($purchase) {
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
        $files = $purchase->files()->get();

        return view('cabinet.projects.purchases.show', compact('purchase',  'project', 'files' ));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project, Purchase $purchase)
    {
        $files = $purchase->files()->get();

        $stages = Stage::whereNull('stage_id')
            ->where('project_id', $project->id)
            ->with('child_stages')
            ->get();

        return view('cabinet.projects.purchases.edit', compact('purchase',  'project', 'stages', 'files'));
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
            'file-purchase' => ['max:2048', 'nullable'],
        ]);



        $status = $purchase->update($validated);


        if ($request->hasfile('file-purchase')) {
            foreach ($request->file('file-purchase') as $file) {

                $name = $file->getClientOriginalName();
                $nameTrimmed = str_replace(' ', '', $name);
                $path = '/projects/' . $project->id . '/purchases/' . $purchase->id . '/';

                $file_data = [
                    'purchase_id' => $purchase->id,
                    'user_id' => auth()->user()->id,
                    'project_id' => $project->id,
                    'name' => $name,
                    'file_path' => '/storage' . $path . $nameTrimmed,
                    'storage_path' => $path . $nameTrimmed,
                    'mime_type' => $file->getClientMimeType(),
                    'extension' => $file->getClientOriginalExtension(),
                ];

                Storage::disk('public')->put($path . $nameTrimmed, $file->getContent());

                $file = PurchaseFile::updateOrCreate([
                    'name' => $name
                ], $file_data);
            }

        }


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
