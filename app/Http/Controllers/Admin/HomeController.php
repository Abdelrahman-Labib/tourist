<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Post;

class HomeController extends Controller
{
    public function index()
    {
        $totals = 
        [
            'users' => User::count(),
            'post' => Post::count() 
        ];
        return view('admin.dashboard', compact('totals'));
    }
}
