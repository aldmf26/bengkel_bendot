<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    //
    protected $guarded = [];

    public function mekanik()
    {
        return $this->belongsTo(Mechanic::class, 'id_mekanik');
    }
}
