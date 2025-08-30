<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'customer_name',
        'table_number',
        'payment_method',
        'total',
        'status',
        'statusdapur'
    ];

    public function items()
    {
        return $this->hasMany(TransactionItem::class);
    }

    public function user(){
        return $this->hasMany(User::class);
    }

}
