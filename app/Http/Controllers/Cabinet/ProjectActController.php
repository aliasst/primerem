<?php

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;
use App\Models\Act;
use App\Models\ActFile;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectActController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Project $project)
    {
        $acts = Act::where('project_id', $project->id)->with('files')->get();
        return view('cabinet.projects.acts.index', compact( 'acts', 'project'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Project $project)
    {
        return view('cabinet.projects.acts.create', compact('project'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Project $project)
    {
        $validated = $request->validate([
            'act_number' => ['required', 'string', 'max:255', 'nullable'],
            'status' => ['required', 'string'],
            'file-act' => ['mimes:pdf', 'max:2048', 'nullable'],
        ]);



        $validated['user_id'] = auth()->user()->id;
        $validated['project_id'] = $project->id;

//        dd( $validated);

        $status = Act::create($validated);

        if ($status) {
            $act_id = $status->id;

            if ($request->hasfile('file-act')) {
                $file = $request->file('file-act');
                    $name = $file->getClientOriginalName();
                    $mimeType = $file->getClientMimeType();
                    $extension = $file->getClientOriginalExtension();
                    $nameTrimmed = str_replace(' ', '', $name);
//                    $path = '/uploads/orders/' . $order . '/';
                    $path = '/projects/' . $project->id . '/acts/' . $act_id . '/';
//                    $file->move(public_path() . $path, $nameTrimmed);
                    Storage::disk('public')->put($path . $nameTrimmed, $file->getContent());
                    $image = new ActFile();
                    $image->act_id = $act_id;
                    $image->user_id = $validated['user_id'];
                    $image->project_id = $project->id;
                    $image->name = $name;
                    $image->file_path = '/storage' . $path . $nameTrimmed;
                    $image->storage_path = $path . $nameTrimmed;
                    $image->mime_type = $mimeType;
                    $image->extension = $extension;
                    $image->save();
            }
        }



        if($status) {
            request()->session()->flash('success', 'Акт добавлен!');
        } else {
            request()->session()->flash('error', 'Ошибка!!!');
        }

        return redirect()->route('cabinet.project.act.index', $project->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project, Act $act)
    {
        $files = $act->files()->get();


        return view('cabinet.projects.acts.show', compact('act', 'files', 'project' ));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project, Act $act)
    {
        $files = $act->files()->get();


        return view('cabinet.projects.acts.edit', compact('act', 'files', 'project' ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project, Act $act)
    {
        $validated = $request->validate([
            'act_number' => ['required', 'string', 'max:255', 'nullable'],
            'status' => ['required', 'string'],
            'file-act' => ['mimes:pdf', 'max:2048', 'nullable'],
        ]);

        $validated['user_id'] = auth()->user()->id;
        $validated['project_id'] = $project->id;

        $act->update($validated);


        if ($request->hasfile('file-act')) {
            $file = $request->file('file-act');

            $name = $file->getClientOriginalName();
            $nameTrimmed = str_replace(' ', '', $name);
            $path = '/projects/' . $project->id . '/acts/' . $act->id . '/';

            $file_data = [
                'act_id' => $act->id,
                'user_id' => $validated['user_id'],
                'project_id' => $project->id,
                'name' => $name,
                'file_path' => '/storage' . $path . $nameTrimmed,
                'storage_path' => $path . $nameTrimmed,
                'mime_type' => $file->getClientMimeType(),
                'extension' => $file->getClientOriginalExtension(),
            ];

            Storage::disk('public')->put($path . $nameTrimmed, $file->getContent());

            $file = ActFile::updateOrCreate([
                'act_id' => $act->id
            ], $file_data);

        }




        return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project, Act $act)
    {
        $status = $act->delete();

        if ($status) {
            request()->session()->flash('success', 'Акт удален!');

        } else {
            request()->session()->flash('error', 'Ошибка!!!');
        }

        return redirect()->route('cabinet.project.act.index', $project->id);
    }
}
