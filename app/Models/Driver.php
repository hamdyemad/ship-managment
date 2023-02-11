<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Driver extends Authenticatable
{
    use HasFactory, HasRoles;

    protected $guarded = [];

    public function roles() {
        return $this->belongsToMany(Role::class, 'model_has_roles', 'model_id');
    }

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
