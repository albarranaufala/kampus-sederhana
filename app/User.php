<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'username', 'password', 'role'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function courses () {
        return $this->hasMany(Course::class);
    }

    public function credits () {
        return $this->hasMany(Credit::class);
    }

    public function studies () {
        return $this->hasMany(Study::class);
    }
}
