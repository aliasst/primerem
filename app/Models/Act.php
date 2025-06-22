<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Act extends Model
{

    public static  $statuses = [
        'status_1' => 'Добавлен',
        'status_2' => 'Требуется подпись',
        'status_3' => 'Подписан сторонами',
    ];

    protected $fillable = [
        'user_id',
        'project_id',
        'act_number',
        'status',
    ];

    public function files(): HasMany
    {
        return $this->hasMany(ActFile::class);
    }

}
