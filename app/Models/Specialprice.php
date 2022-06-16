<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialprice extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'city_id',
        'area_id',
        'special_price',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }
}
