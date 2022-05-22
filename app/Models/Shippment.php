<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shippment extends Model
{
    use HasFactory;

    public function accountseller()
    {
        return $this->hasOne(AccountSeller::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function pickup()
    {
        return $this->hasOne(Pickup::class);
    }

    public function delivery()
    {
        return $this->hasMany(Delivery::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    protected $fillable = [
        'shippment_type',
        'business_referance',
        'receiver_name',
        'receiver_phone',
        'address',
        'price',
        'package_details',
        'note',
        'status',
        'user_id',
        'city_id',
        'area_id',
        'created_at',
    ];
}
