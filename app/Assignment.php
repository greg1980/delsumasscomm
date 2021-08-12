<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Assignment extends Model
{
    use Notifiable;
    //
    protected $fillable = [
        'course_name',
        'course_code',
        'user_id',
        'level_id',
        'lecturer_id',
        'file_name'
        ];

    public function users(){
        return $this->belongsToMany(User::class, 'user_id');
    }

    public function level(){
        return $this->belongsTo(level::class, 'level_id');
    }

    public function lecturers(){
        return $this->hasMany(Lecturer::class, 'lecturer_id');
    }
}
