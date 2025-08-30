<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TransactionItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id',
        'good_id',
        'name',
        'price',
        'qty',
        'total',
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function good()
    {
        return $this->belongsTo(Good::class);
    }

}
