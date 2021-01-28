<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Enrollment extends Model
{
    use Notifiable;

    protected $casts = [
        'course_id' => 'array',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'course_id', 'enrolled','user_id','level_id','semesters','year','grades'
    ];


    public function user(){
        return $this->belongsTo(User::class,  'user_id');
    }

    public function course(){
        return $this->belongsTo(Course::class, 'course_id');
    }

}
