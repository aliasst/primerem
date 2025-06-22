<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActFile extends Model
{
    protected $fillable = [
        'user_id',
        'project_id',
        'act_id',
        'name',
        'file_path',
        'storage_path',
        'mime_type',
        'extension',
    ];
}
