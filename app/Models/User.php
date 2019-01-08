<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'jwt','role','name', 'email', 'password','phone','active','image', 'country', 'city', 'private'
     ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token','created_at','password','updated_at'
    ];

    public function scopeuserActivate($query)
    {
        $query->update(['active' => 1]) ;
        return $query;
    }

}
