<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippmentView extends Model
{
    use HasFactory;

    protected $table = 'shippments_view';
    protected $guarded = [];
}
