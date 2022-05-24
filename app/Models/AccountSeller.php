<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountSeller extends Model
{
    use HasFactory;

    public function shippment()
    {
        return $this->belongsTo(Shippment::class);
    }

    public function delivery()
    {
        return $this->hasone(Delivery::class);
    }
}
