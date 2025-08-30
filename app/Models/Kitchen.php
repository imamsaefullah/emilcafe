<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kitchen extends Model
{
    //
    public function items()
    {
        return $this->hasMany(TransactionItem::class);
    }
    public function good()
    {
        return $this->belongsTo(Good::class);
    }
    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }

}
