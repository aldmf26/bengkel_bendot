<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sparepart extends Model
{
    //
    protected $guarded = [];

    public function kategori()
    {
        return $this->belongsTo(Category::class, 'id_kategori');
    }
    public function suplier()
    {
        return $this->belongsTo(Supplier::class, 'id_supplier');
    }
}
