<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $fillable = [
        'id', 'city', 'rate',
    ];

    //city has many areas
    public function areas()
    {
        return $this->hasMany(Area::class);
    }

    public function specialprices()
    {
        return $this->hasMany(Specialprice::class);
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }
}
