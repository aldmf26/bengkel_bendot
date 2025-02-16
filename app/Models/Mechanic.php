<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mechanic extends Model
{
    //
protected $guarded = [];

public function transactionDetails()
{
    return $this->hasManyThrough(
        TransactionDetail::class,
        Service::class,
        'id_mekanik',   // Foreign key on the services table
        'id_service',   // Foreign key on the transaction_details table
        'id',           // Local key on the mechanics table
        'id'            // Local key on the services table
    );
}

}
