<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Follow;
use App\Models\Post;
use App\Models\ReportUser;
use App\Models\Block;
use App\Models\PostUser;

class UserController extends Controller
{
    public function follow(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'follower_id' => 'required|exists:users,id',
            'followed_id' => 'required|exists:users,id',
        ]);

        if($validator->fails()){
            return response()->json(['status' => 'error', 'msg' => $validator->messages()]);
        }

        $follow = Follow::create([
            'follower_id' => $request->follower_id,
            'followed_id' => $request->followed_id
        ]);

        return response()->json(msg($request,success(),'success'));
    }
    
    public function showFollow(Request $request)
    {
        $ids = Follow::where('follower_id', $request->user_id)->pluck('followed_id')->toArray();
        $followData = array();
        for($i = 0; $i < count($ids); $i++){
            $followData[$i] = User::where('id', $ids[$i])->select('id', 'name', 'image')->get();
        }
        return response()->json(['followData' => $followData]);
    }

    //Start profile friend
    public function profileFriend(Request $request)
    {
        $user = User::where('id', $request->id)->get();
        $post = Post::where('user_id', $request->user_id)->get();
        return response()->json(['user' => $user, 'post' => $post]);
    }

    public function reportUsers(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'report_id' => 'required|exists:users,id',
            'type' => 'required|in:Hate speech,Self harm,Bulling and harassment',
        ]);

        if($validator->fails())
        {
            return response()->json(['status' => 'error', 'msg' => $validator->messages()]);
        }

        $report = ReportUser::create([
           'user_id' => $request->user_id,
           'report_id' => $request->report_id,
           'type' => $request->type 
        ]);
        
        return response()->json(msg($request,success(),'report'));
    }

    public function Block(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'blocker_id' => 'required|exists:users,id',
        ]);

        if($validator->fails())
        {
            return response()->json(['status' => 'error', 'msg' => $validator->messages()]);
        }

        $block = Block::create([
           'user_id' => $request->user_id,
           'blocker_id' => $request->blocker_id,
        ]);
        
        return response()->json(msg($request,success(),'block'));
    }

    public function showBlock(Request $request)
    {
        $block = Block::where('user_id', $request->user_id)->pluck('blocker_id')->toArray();
        
        $user = array();
        for($i = 0; $i < count($block); $i++){
            $user[$i] = User::where('id', $block[$i])->select('id', 'name')->get();
        }

        $deleteBlock = Block::find($request->blocker_id);
        if($deleteBlock)
        {
            $deleteBlock->block = 1;
            $deleteBlock->save();
            return response()->json(['status' => 'success', 'msg' => 'unblocked']);
        }

        return response()->json(['user' => $user]);
    }

    public function postUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'ask_id' => 'required|exists:users,id',
            'body' => 'required|max:250',
        ]);

        if($validator->fails())
        {
            return response()->json(['status' => 'error', 'msg' => $validator->messages()]);
        }

        $report = PostUser::create([
           'user_id' => $request->user_id,
           'ask_id' => $request->ask_id,
           'body' => $request->body,
        ]);
        
        return response()->json(msg($request,success(),'ask'));
    }
    //End profile friend

    //start my profile
    public function myProfile(Request $request)
    {
        $user = User::where('id', $request->id)->get();
        $post = Post::where('user_id', $request->user_id)->get();
        $follow = Follow::where('followed_id', $request->user_id)->count();

        return response()->json(['user' => $user, 'post' => $post, 'follow' => $follow]);
    }

    
    protected function update(Request $request)
    {
           
        $user = User::findOrFail($request->id);

        if($user)
        {
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

            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->gender = $request->gender;
            $user->birth_day = $request->birth_day;
            $user->password = $request->password;
            $user->save();
        }
            
        return response()->json(['status' => 'success', 'msg' => 'registered', 'user' => $user]);

    
    }
}
