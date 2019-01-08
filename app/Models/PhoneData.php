<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhoneData extends Model
{
    protected $fillable = [
        'user_id','type','token'
    ];

    protected $table = 'phone_datas';

    public $timestamps = false;
}
