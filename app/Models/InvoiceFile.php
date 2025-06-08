<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceFile extends Model
{

    protected $fillable = [
        'user_id',
        'project_id',
        'invoice_id',
        'name',
        'file_path',
        'storage_path',
        'mime_type',
        'extension',
    ];
}
