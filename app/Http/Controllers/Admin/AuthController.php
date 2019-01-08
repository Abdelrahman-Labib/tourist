<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login_view()
    {
        return view('admin.login.login');
    }

    public function login(Request $request)
    {
        $this->validate($request,
            [
                'email' => 'required|email|exists:users',
                'password' => 'required'
            ]
        );


        if(Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], false))
        {
            return redirect('/admin/dashboard');
        }
        else
        {
            return back()->with('error', 'بيانات خاطئة');
        }
    }


    public function logout()
    {
        Auth::logout();
        return redirect('/admin/login');
    }
}
