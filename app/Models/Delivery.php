<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;

    protected $fillable = [
        'driver_id', 'shippment_id'
    ];

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }


    public function shippment()
    {
        return $this->belongsTo(Shippment::class);
    }
}
