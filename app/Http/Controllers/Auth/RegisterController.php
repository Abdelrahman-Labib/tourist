<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Code;
use App\Models\PhoneData;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Carbon\Carbon;

class RegisterController extends Controller
{
    protected function create(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'password' => 'required',
            'country' => 'required',
            'city' => 'required',
        ]);

        if($validator->fails())
        {
            return response()->json(['status' => 'error', 'msg' => $validator->messages()]);
        }

        $email = User::where('email', $request->email)->select('id')->first();
        if($email)
        {
            return response()->json(['status' => 'failed', 'msg' => 'email already exists']);
        }

        $phone = User::where('phone', $request->phone)->select('id')->first();
        if($phone)
        {
            return response()->json(['status' => 'failed', 'msg' => 'phone already exists']);
        }

        $image = unique_file($request->image->getClientOriginalName());
        $request->image->move(base_path().'/public/users/', $image);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'country' => $request->country,
            'city' => $request->city,
            'image' => $image,
            'password' => Hash::make($request->password),
            'jwt' => str_random(20)
        ]);
        
        $code = Code::updateOrcreate
        (
            [
               'phone' => $user->phone
            ],
            [
               'code' => rand(1000,9999),
               'expire_at' => Carbon::now()->addHour()->toDateTimeString()
            ]
        );

        $msg = 'هذا هو كود التفعيل الخاص بك في تطبيق سائح '.$code->code. ' وشكراً';

        PhoneData::create
        (
            [
                'type' => 'user',
                'user_id' => $user->id,
                'token' => $request->firebase_token
            ]
        );
            
        return response()->json(['status' => 'success', 'msg' => 'registered', 'user' => $user]);

    
    }

    public function update_token(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'type' => 'required|in:user,tech',
                'user_id' => 'required|exists:users,id',
                'jwt' => 'required|exists:users,jwt,id,'.$request->user_id,
                'firebase_token' => 'required'
            ]
        );

        if($validator->fails())
        {
            return response()->json(['status' => 'error', 'msg' => $validator->messages()]);
        }

        PhoneData::where('role', 'user')->where('user_id', $request->user_id)->update
        (
            [
                'token' => $request->firebase_token
            ]
        );

        return response()->json(['status' => 'success', 'msg' => 'updated']);
    }


    public function activate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required|max:191',
        ]);

        if($validator->fails())
        {
            return response()->json(['status' => 'error', 'msg' => $validator->messages()]);
        }

        $check = Code::where('code', $request->code)->first();

        if(!$check)
        {
            return response()->json(['status' => 'failed', 'msg' => 'invalid data']);
        }


        User::where('phone', $check->phone)->userActivate();

        $user = User::where('phone', $check->phone)->select('id','name','email','phone','image','active')->first();

        return response()->json(['status' => 'success', 'msg' => 'activated', 'user' => $user]);
    }

}
