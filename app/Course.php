<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    Protected $fillable = [
        'course_name',
        'course_code',
        'credit_unit',
        'user_id',
        'level_id',
        'semesters',
        'email_sent'
    ];

    public function users(){
        return $this->belongsToMany(User::class);
    }

    public function level(){
        return $this->belongsTo(level::class);
    }

    public function enrollments(){

        return $this->hasOne( Course::class);
    }

}
