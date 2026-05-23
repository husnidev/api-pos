<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasUuids;
    use Notifiable;

    protected $fillable=[
        'name',
        'email',
        'password'
    ];

    protected $hidden=[
        'password',
        'remember_token'
    ];

    protected function casts(): array
    {
        return [

            'password'=>'hashed'
        ];
    }
}
