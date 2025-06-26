<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Contractor extends Model
{

    protected $fillable = [
        'title',
        'sort',
        'stage_id',
        'user_id',
        'project_id',
        'start_date',
        'finish_date',
        'comments',
    ];


    protected $casts = [
        'start_date' => 'datetime',
        'finish_date' => 'datetime',
    ];


    public function stage(): BelongsTo
    {
        return $this->belongsTo(Stage::class);
    }


}
