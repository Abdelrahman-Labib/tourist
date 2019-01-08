<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'user_id', 'post_id', 'comment'
    ];

    public function get_user($user_id)
    {
        $user = User::where('id', $user_id)->select('name','image')->first();
        return $user;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
