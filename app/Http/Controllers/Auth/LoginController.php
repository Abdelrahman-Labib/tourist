<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PhoneData;
use App\Models\Code;
use Carbon\Carbon;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|max:191',
            'password' => 'required|max:191',
            'token' => 'required'
        ]);

        if($validator->fails())
        {
            return response()->json(['status' => 'error', 'msg' => $validator->messages()]);
        }



        $user = User::where('email', $request->email)->select('id','jwt','name','email','phone','password','image','active')->first();

        if($user)
        {
            $check = Hash::check($request->password,$user->password);

            if($check)
            {
                if($user->active == 0)
                {
                    return response()->json(['status' => 'failed', 'msg' => 'user not active']);
                }

                PhoneData::updateOrcreate
                (
                    [
                        'user_id' => $user->id,
                    ],
                    [
                        'token' => $request->token,
                    ]
                );

                unset($user->created_at,$user->updated_at,$user->remember_token);

                return response()->json(['status' => 'success', 'msg' => 'logged in', 'data' => $user]);
            }
            else
            {
                return response()->json(['status' => 'failed', 'msg' => 'invalid data']);
            }

        }
        else
        {
            return response()->json(['status' => 'failed', 'msg' => 'invalid data']);
        }

    }

    public function code_send(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required|in:activate,reset',
            'phone' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'msg' => $validator->messages()]);
        }

        $code = Code::updateOrcreate
        (
            [
                'type' => $request->type,
                'phone' => $request->phone
            ],
            [
                'code' =>rand(1000,9999),
                'expire_at' => Carbon::now()->addHour()->toDateTimeString()
            ]
        );

        $msg = 'هذا هو كود التحقق الخاص بك في تطبيق سائح '.$code->code. ' وشكراً';

        return response()->json(['status' => 'success', 'msg' => 'code sent']);

    }


    public function code_check(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'code' => 'required',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'msg' => $validator->messages()]);
        }

        $check = Code::where('code', $request->code)->select('id','type','phone')->first();

        if($check)
        {
            if($check->type == 'activate')
            {
                $user = User::where('phone', $check->phone)->first();
                $user->active = 1;
                $user->save();
            }
            else
            {
                $user = User::where('phone', $check->phone)->select('id','jwt')->first();
            }

            unset($user->created_at,$user->updated_at,$user->remember_token);

            return response()->json(['status' => 'success', 'msg' => 'activated successfully', 'data' => $user]);

        }
        else
        {
            return response()->json(['status' => 'failed', 'msg' => 'invalid data']);
        }

    }


    public function password_change(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'id' => 'required|exists:users,id',
                'jwt' => 'required|exists:users,jwt,id,'.$request->id,
                'password' => 'required',
            ]
        );


        if ($validator->fails())
        {
            return response()->json(['status' => 'error', 'msg' => $validator->messages()]);
        }

        User::where('id', $request->id)->select('id','password')->update(['password' => Hash::make($request->password)]);

        return response()->json(['status' => 'success', 'msg' => 'password changed']);
    }

}
