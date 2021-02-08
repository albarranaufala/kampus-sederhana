<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'name', 'credit', 'user_id'
    ];

    public function users () {
        return $this->belongsTo(User::class);
    }

    public function studies () {
        return $this->hasMany(Study::class);
    }
}
