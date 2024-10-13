<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property int $id
 * @property string $email
 * @property string $password
 * @property string $full_name
 * @property string $sdt
 * @property string $image_url
 * @property int $role
 */
class Account extends Authenticatable
{
    use HasApiTokens;

    protected $fillable = [
        'email',
        'password',
        'full_name',
        'sdt',
        'image_url',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
