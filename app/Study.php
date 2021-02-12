<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Study extends Model
{
    protected $table = 'studies';

    protected $fillable = [
        'user_id', 'course_id', 'periode_id', 'grade'
    ];

    public function user () {
        return $this->belongsTo(User::class);
    }

    public function course () {
        return $this->belongsTo(Course::class);
    }

    public function periode () {
        return $this->belongsTo(Periode::class);
    }
}
