<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    //
    protected $guarded = [];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'id_pelanggan', 'id');
    }

    public function detail()
    {
        return $this->hasMany(TransactionDetail::class, 'id_transaksi', 'id');
    }
}
