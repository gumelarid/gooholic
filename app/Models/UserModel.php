<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class UserModel extends Authenticatable
{
    use HasFactory;

    protected $table = 'users';
    protected $primaryKey = 'id_user';
    protected $keyType = 'string';


    protected $fillable = [
        'id_user',
        'name',
        'email',
        'password',
        'role',
        'profile',
        'is_active',
        'created_at',
        'updated_at'
    ];
}
