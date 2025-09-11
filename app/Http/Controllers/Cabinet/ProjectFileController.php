<?php

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;
use App\Models\PurchaseFile;
use App\Models\StageFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectFileController extends Controller
{
    public function deleteStageFile($id)
    {
        $file = StageFile::find($id);

        if (Storage::disk('public')->exists($file->storage_path)) {
            Storage::disk('public')->delete($file->storage_path);
        }


        $status = $file->delete();


        if ($status) {
            echo true;

        }

        echo false;

    }


    public function deletePurchaseFile($id)
    {
        $file = PurchaseFile::find($id);

        if (Storage::disk('public')->exists($file->storage_path)) {
            Storage::disk('public')->delete($file->storage_path);
        }

        $status = $file->delete();

        if ($status) {
            echo true;

        }

        echo false;

    }
}
