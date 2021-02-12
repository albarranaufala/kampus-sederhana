<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Credit extends Model
{
    protected $fillable = [
        'credit', 'user_id'
    ];

    public function user () {
        return $this->belongsTo(User::class);
    }
}
