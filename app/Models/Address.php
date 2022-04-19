<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    public function City()
    {
        return $this->belongsTo(City::class);
    }
    protected $fillable = [
        'address_line',
        'building',
        'apartment',
        'user_id',
        'city_id',
        'area_id',
        'contact_id',
    ];
}
