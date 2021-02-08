<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Credit extends Model
{
    protected $fillable = [
        'credit', 'user_id'
    ];

    public function users () {
        return $this->belongsTo(User::class);
    }
}
