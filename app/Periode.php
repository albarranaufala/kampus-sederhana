<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Periode extends Model
{
    protected $fillable = [
        'year', 'semester', 'register_start', 'register_end'
    ];

    public function studies () {
        return $this->hasMany(Study::class);
    }
}
