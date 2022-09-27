<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;


class Admin extends Authenticatable
{
    use HasFactory, HasRoles;

    protected $fillable = ['name', 'type','email', 'avatar','gender', 'phone', 'dofbirth', 'password'];

    public function roles() {
        return $this->belongsToMany(Role::class, 'model_has_roles', 'model_id');
    }
}
