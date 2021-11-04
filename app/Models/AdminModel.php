<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
class AdminModel extends Authenticatable
{
    use HasFactory, HasRoles;
    protected $table = 'admins';
    protected $guard_name = 'admin';
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password'
    ];
}
