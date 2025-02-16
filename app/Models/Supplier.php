<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    //
protected $guarded = [];
    public function sparepart()
    {
        return $this->hasMany(Sparepart::class, 'id_supplier');
    }

}
