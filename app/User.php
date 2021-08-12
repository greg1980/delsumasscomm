<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','role_id','avatar','title','gender','dateofbirth','mobile','housenumber','yearofadmission',
        'yearofgrad','matnumber','address','city','level_id','semesters'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function accountActive(){
        if($this->email_verified_at){
            return true;
        }
        return false;
    }
//    public function UserActivationCode(){
//        return $this->hasOne(ActivationCode::class);
//    }

    public function userIsActivated(){

        if ($this->is_active){
            return true;
        }
        return false;
    }

    public function isAdmin(){
        if($this->role->name =="administrator" && $this->is_active ==1){
            return true;
        }
        return false;
    }

    public function setPasswordAttribute($password){

        if (!empty($password)){
            $this->attributes['password'] = bcrypt($password);
        }
    }

    public function role(){
        return $this->belongsTo(Role::class);
    }


//    public function projects(){
//        return $this->hasMany(Post::class);
//    }

    public function level(){
      return  $this->belongsTo(Level::class, 'level_id');
    }

    public function courses(){
        return $this->hasMany(Course::class)->latest('updated_at');
    }

   public function enrollments(){
        return $this->hasMany(Enrollment::class);
   }

    public function assignment(){
        return $this->hasMany(Assignment::class);
    }

}
