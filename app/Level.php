<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{

    protected $fillable = [
        'name'
    ];

public function course(){
    return $this->hasOne(Course::class, 'level_id');
}

public function user(){
    return $this->belongsTo(User::class, 'level_id');
}

}
