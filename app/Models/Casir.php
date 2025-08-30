<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Casir extends Model
{
    //
    public function items()
    {
        return $this->hasMany(Good::class);
    }
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
