<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StageFile extends Model
{
    protected $fillable = [
        'user_id',
        'project_id',
        'stage_id',
        'name',
        'file_path',
        'storage_path',
        'mime_type',
        'extension',
    ];
}
