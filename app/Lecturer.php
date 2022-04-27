<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lecturer extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'title',
        'description',
        'level_id',
        'course_code',
        'dead_line',
        'created_at'
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
