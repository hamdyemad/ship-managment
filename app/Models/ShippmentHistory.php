<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippmentHistory extends Model
{
    use HasFactory;

    protected $table = 'shippments_histories';
    protected $fillable = [
        'user_id',
        'shippment_id',
        'status'
    ];



    public function user() {
        return $this->belongsTo(Employee::class);
    }
    public function shippment() {
        return $this->belongsTo(Shippment::class);
    }
}
