<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function admins()
    {
        $users = User::where('role', 'admin')->where('id', '!=', 1)->paginate(50);
        return view('admin.users.index', compact('users'));
    }


    public function active()
    {
        $users = User::where('role', 'user')->where('active', 1)->paginate(50);
        return view('admin.users.index', compact('users'));
    }


    public function suspended()
    {
        $users = User::where('active', 0)->paginate(50);
        return view('admin.users.index', compact('users'));
    }

    public function adminize(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required|exists:users,id'
        ]);

        $user = User::find($request->user_id);

        if($user->role != 'admin')
        {
            $user->role = 'admin';
        }else
        {
            $user->role = 'user';
        }

        $user->save();

        return back()->with('success', 'تمت العملية بنجاح');
    }

    public function create()
    {
        return view('admin.users.single');
    }

    public function store(Request $request)
    {
        $this->validate($request, 
            [
                'name' => 'required',
                'email' => 'required|unique:users,email',
                'phone' => 'required|unique:users,phone',
                'password' => 'required|confirmed|min:6'
            ],
            [
                'name.required' => 'الإسم مطلوب',
                'email.required' => 'البريد الإلكتروني مطلوب',
                'email.unique' => 'البريد الإلكتروني موجود من قبل',
                'phone.required' => 'الهاتف مطلوب',
                'phone.unique' => 'الهاتف موجود من قبل',
                'password.required' => 'الباسورد مطلوب',
                'password.confirmed' => 'الباسورد غير متطابق',
                'password.min' => 'الباسورد يجب ألا يقل عن 6 خانات'                
            ]
        );

        User::create
        (
            [
                'jwt' => str_random(20),
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
            ]
        );
        
        return redirect('/admin/users/active')->with('success', 'تم إضافة المستخدم بنجاح');
    }

    public function storeadmin(Request $request)
    {
        $this->validate($request, 
            [
                'name' => 'required',
                'email' => 'required|unique:users,email',
                'phone' => 'required|unique:users,phone',
                'password' => 'required|confirmed|min:6'
            ],
            [
                'name.required' => 'الإسم مطلوب',
                'email.required' => 'البريد الإلكتروني مطلوب',
                'email.unique' => 'البريد الإلكتروني موجود من قبل',
                'phone.required' => 'الهاتف مطلوب',
                'phone.unique' => 'الهاتف موجود من قبل',
                'password.required' => 'الباسورد مطلوب',
                'password.confirmed' => 'الباسورد غير متطابق',
                'password.min' => 'الباسورد يجب ألا يقل عن 6 خانات'                
            ]
        );

        User::create
        (
            [
                'jwt' => str_random(20),
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
                'role' => 'admin',
                'active' => '1'
            ]
        );
        
        return redirect('/admin/users/active')->with('success', 'تم إضافة المستخدم بنجاح');
    }

    public function change_status($user_id)
    {
        $user = User::find($user_id);

        if($user->active == 1)
        {
            $user->active = 0;
        }
        else
        {
            $user->active = 1;
        }

        $user->save();

        return back()->with('success', 'تمت العملية بنجاح');
    }


    public function destroy(Request $request)
    {
        $this->validate($request,
            [
                'user_id' => 'required|exists:users,id'
            ]
        );

        User::where('id', $request->user_id)->delete();

        return back()->with('success', 'تمت العملية بنجاح');
    }
}
