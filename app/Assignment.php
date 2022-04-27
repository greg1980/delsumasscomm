<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
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

    /**
     * @return BelongsTo
     */
    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @return BelongsTo
     */
    public function level(): BelongsTo
    {
        return $this->belongsTo(level::class, 'level_id');
    }

    /**
     * @return HasMany
     */
    public function lecturers(): HasMany
    {
        return $this->hasMany(Lecturer::class, 'course_id');
    }


}
