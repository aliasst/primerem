<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    public static  $statuses = [
        'active' => 'Активный',
        'inactive' => 'Не активный',
    ];
    protected $fillable = [
        'user_id',
        'status',
        'name',
        'organization',
        'phone',
        'email',
        'details',
        'progress',
    ];



}
