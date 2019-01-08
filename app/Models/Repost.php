<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Repost extends Model
{
    protected $fillable = [
        'user_id', 'post_id', 'body'
    ];

    public function get_user($user_id)
    {
        $user = User::where('id', $user_id)->select('name','image')->first();
        return $user;
    }
}
