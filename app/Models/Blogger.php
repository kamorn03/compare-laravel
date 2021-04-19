<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

    class Blogger extends Authenticatable
    {
        use Notifiable;

        protected $guard = 'bloggers';

        protected $fillable = [
            'name', 'email', 'password','address',
        ];

        protected $casts = [
            'address' => 'json',
        ];

        protected $hidden = [
            'password', 'remember_token',
        ];
    }