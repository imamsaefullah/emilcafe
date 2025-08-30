<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'transaction_id',
        'number',
        'methode',
        'checkout_url',
        'status',
        'paid_at',
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}
