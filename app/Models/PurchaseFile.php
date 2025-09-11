<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseFile extends Model
{

    protected $fillable = [
        'user_id',
        'project_id',
        'purchase_id',
        'name',
        'file_path',
        'storage_path',
        'mime_type',
        'extension',
    ];
}
