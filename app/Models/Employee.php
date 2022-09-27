<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;


class Employee extends Authenticatable
{
    use HasFactory, HasRoles;

    protected $fillable = [
        'id',
        'name',
        'phone',
        'avatar',
        'email',
        'password',
    ];

    public function roles() {
        return $this->belongsToMany(Role::class, 'model_has_roles', 'model_id');
    }
}
