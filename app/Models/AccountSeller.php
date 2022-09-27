<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountSeller extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function shippment()
    {
        return $this->belongsTo(Shippment::class);
    }
    public function pickup()
    {
        return $this->belongsTo(Pickup::class);
    }

    public function delivery()
    {
        return $this->hasone(Delivery::class);
    }
}
