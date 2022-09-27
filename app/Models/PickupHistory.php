<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PickupHistory extends Model
{
    use HasFactory;
    protected $table = 'pickups_histories';
    protected $fillable = [
        'user_id',
        'pickup_id',
        'status'
    ];

    public function user() {
        return $this->belongsTo(Employee::class);
    }
    public function pickup() {
        return $this->belongsTo(Pickup::class);
    }
}
