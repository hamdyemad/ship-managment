<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;
    // area belong to city
    public function city()
    {
        return $this->belongsTo(City::class);
    }



    protected $fillable = [
        'area',
        'rate',
        'city_id',
    ];
}
