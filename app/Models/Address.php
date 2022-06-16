<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'city_id',
        'area_id',
        'address_line',
        'building',
        'apartment',
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
