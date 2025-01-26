<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    //
    protected $guarded = [];
    public function service()
    {
        return $this->belongsTo(Service::class, 'id_service');
    }

    public function sparepart()
    {
        return $this->belongsTo(Sparepart::class, 'id_sparepart');
    }
}
