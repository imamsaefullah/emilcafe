<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Good extends Model
{
    protected $fillable = [
        'nama',
        'harga_jual',
        'keterangan',
        'gambar',
    ];
    public function casir()
    {
        return $this->belongsTo(Casir::class);
    }
    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
    public function transactionItems()
    {
        return $this->hasMany(TransactionItem::class);
    }
}
