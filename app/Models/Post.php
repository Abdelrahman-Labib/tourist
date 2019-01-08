<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'user_id', 'body', 'likes', 'ask_id', 'private'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function report()
    {
        return $this->hasMany(Report::class, 'post_id');
    }

    public function comment()
    {
        return $this->hasMany(Comment::class, 'post_id');
    }

    public function get_user($user_id)
    {
        $user = User::where('id', $user_id)->select('name','image')->first();
        return $user;
    }

    public function postImage()
    {
        return $this->hasMany(PostImage::class, 'post_id');
    }
}
