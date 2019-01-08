<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostNotification extends Model
{
    protected $fillable = [
        'user_id','post_id','ar_text','en_text'
    ];
}
