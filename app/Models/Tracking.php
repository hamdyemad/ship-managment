<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tracking extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'shippment_id',
        'user_id',
        'user_type',
        'status',
        'created_at',
    ];

    public function shippment()
    {
        return $this->belongsTo(Shippment::class);
    }
}
