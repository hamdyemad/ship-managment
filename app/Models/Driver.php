<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Driver extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'email', 'special_pickup',
    ];

    public function deliveries()
    {
        return $this->hasMany(Delivery::class);
    }

    public function Scheduledrivers()
    {
        return $this->hasMany(Scheduledriver::class);
    }

    public function assignedpickups()
    {
        return $this->hasMany(Assignedpickup::class);
    }
}
