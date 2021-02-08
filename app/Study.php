<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Study extends Model
{
    protected $table = 'studies';

    protected $fillable = [
        'user_id', 'course_id', 'periode_id', 'grade'
    ];

    public function users () {
        return $this->belongsTo(User::class);
    }

    public function courses () {
        return $this->belongsTo(Course::class);
    }

    public function periodes () {
        return $this->belongsTo(Periode::class);
    }
}
