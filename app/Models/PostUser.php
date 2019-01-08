<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostUser extends Model
{
    protected $fillable = [
        'user_id', 'ask_id', 'post_id'
    ];
}
