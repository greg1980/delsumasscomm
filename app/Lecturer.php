<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Lecturer extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'title',
        'description',
        'level_id',
        'course_code'

        ];

    public function course(){
        return $this->belongsTo(Course::class, 'course_code');
    }

    public function level(){
        return $this->belongsTo(Level::class, 'level_id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
