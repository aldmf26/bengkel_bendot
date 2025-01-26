<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogTransaksiStok extends Model
{
    //
    protected $guarded = [];

    public function sparepart()
    {
        return $this->belongsTo(Sparepart::class, 'id_sparepart');
    }

    public function transaksi()
    {
        return $this->belongsTo(Transaction::class, 'id_transaksi');
    }
}
