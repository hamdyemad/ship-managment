<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scheduledriver extends Model
{
    use HasFactory;

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }
    protected $fillable = [
        'id',
        'driver_id',
        'from',
        'to',
        'total_cost',
        'total_delivery_commission',
    ];
}
