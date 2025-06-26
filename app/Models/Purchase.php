<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Purchase extends Model
{
    protected $fillable = [
        'title',
        'description',
        'sort',
        'stage_id',
        'user_id',
        'project_id',
        'purchase_date',
        'start_date',
        'finish_date',
        'comments',
    ];

    protected $casts = [
        'purchase_date' => 'datetime',
        'start_date' => 'datetime',
        'finish_date' => 'datetime',
    ];


    public function stage(): BelongsTo
    {
        return $this->belongsTo(Stage::class);
    }


}
