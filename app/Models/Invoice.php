<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Invoice extends Model
{
    /** @use HasFactory<\Database\Factories\InvoiceFactory> */
    use HasFactory;

    public static  $statuses = [
        'status_1' => 'Не оплачен',
        'status_2' => 'Оплачен',
    ];

    protected $fillable = [
        'user_id',
        'project_id',
        'status',
        'invoice_number',
        'invoice_id',
    ];

    public function files(): HasMany
    {
        return $this->hasMany(InvoiceFile::class);
    }
}
