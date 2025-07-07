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

    public function stages()
    {
        return $this->hasMany(Stage::class);
    }

    public function contractors()
    {
        return $this->hasMany(Contractor::class);
    }

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function acts()
    {
        return $this->hasMany(Act::class);
    }

}
