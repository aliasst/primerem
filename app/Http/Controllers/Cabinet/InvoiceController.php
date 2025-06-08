<?php

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\InvoiceFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $invoices = Invoice::with('files')->get();


        return view('cabinet.invoices.index', compact( 'invoices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cabinet.invoices.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'invoice_number' => ['required', 'string', 'max:255', 'nullable'],
            'status' => ['required', 'string'],
            'file-invoice' => ['mimes:pdf', 'max:2048', 'nullable'],
        ]);



        $validated['user_id'] = auth()->user()->id;

//        dd( $validated);

        $status = Invoice::create($validated);

        if ($status) {
            $invoice_id = $status->id;

            if ($request->hasfile('file-invoice')) {
                $file = $request->file('file-invoice');
                    $name = $file->getClientOriginalName();
                    $mimeType = $file->getClientMimeType();
                    $extension = $file->getClientOriginalExtension();
                    $nameTrimmed = str_replace(' ', '', $name);
//                    $path = '/uploads/orders/' . $order . '/';
                    $path = 'invoices/' . $invoice_id . '/';
//                    $file->move(public_path() . $path, $nameTrimmed);
                    Storage::disk('public')->put($path . $nameTrimmed, $file->getContent());
                    $image = new InvoiceFile();
                    $image->invoice_id = $invoice_id;
                    $image->user_id = $validated['user_id'];
                    $image->project_id = 0;
                    $image->name = $name;
                    $image->file_path = '/storage/' . $path . $nameTrimmed;
                    $image->storage_path = $path . $nameTrimmed;
                    $image->mime_type = $mimeType;
                    $image->extension = $extension;
                    $image->save();
            }
        }



        if($status) {
            request()->session()->flash('success', 'Cчет добавлен!');
        } else {
            request()->session()->flash('error', 'Ошибка!!!');
        }

        return redirect()->route('cabinet.invoice.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        $files = $invoice->files()->get();


        return view('cabinet.invoices.show', compact('invoice', 'files' ));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice)
    {
        $files = $invoice->files()->get();


        return view('cabinet.invoices.edit', compact('invoice', 'files' ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invoice $invoice)
    {
        $validated = $request->validate([
            'invoice_number' => ['required', 'string', 'max:255', 'nullable'],
            'status' => ['required', 'string'],
            'file-invoice' => ['mimes:pdf', 'max:2048', 'nullable'],
        ]);

        $validated['user_id'] = auth()->user()->id;

        $invoice->update($validated);


        if ($request->hasfile('file-invoice')) {
            $file = $request->file('file-invoice');

            $name = $file->getClientOriginalName();
            $nameTrimmed = str_replace(' ', '', $name);
            $path = 'invoices/' . $invoice->id . '/';

            $file_data = [
                'invoice_id' => $invoice->id,
                'user_id' => $validated['user_id'],
                'project_id' => 0,
                'name' => $name,
                'file_path' => '/storage/' . $path . $nameTrimmed,
                'storage_path' => $path . $nameTrimmed,
                'mime_type' => $file->getClientMimeType(),
                'extension' => $file->getClientOriginalExtension(),
            ];

            Storage::disk('public')->put($path . $nameTrimmed, $file->getContent());

            $file = InvoiceFile::updateOrCreate([
                'invoice_id' => $invoice->id
            ], $file_data);

        }




        return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        $status = $invoice->delete();

        if ($status) {
            request()->session()->flash('success', 'Счет удален!');

        } else {
            request()->session()->flash('error', 'Ошибка!!!');
        }

        return redirect()->route('cabinet.invoice.index');
    }
}
