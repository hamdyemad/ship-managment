<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pickup extends Model
{
    use HasFactory;

    public function shipment()
    {
        return $this->belongsTo(Shippment::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }
    public function assignedpickups()
    {
        return $this->hasMany(Assignedpickup::class);
    }
    public function accountseller()
    {
        return $this->hasOne(AccountSeller::class);
    }
    public function deliveries()
    {
        return $this->hasMany(Delivery::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function histories() {
        return $this->hasMany(PickupHistory::class);
    }

}
