<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'address_line',
        'building',
        'apartment',
        'user_id',
        'city_id',
        'area_id',
        'contact_id',
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }


    public function pickups()
    {
        return $this->hasMany(Pickup::class);
    }
}
