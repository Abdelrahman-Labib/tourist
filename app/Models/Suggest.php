<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Suggest extends Model
{
    protected $fillable = [
        'name', 'email', 'text' 
    ];

    protected $table = 'suggestions';
}
