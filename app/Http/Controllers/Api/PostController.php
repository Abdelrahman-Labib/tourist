<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Report;
use App\Models\PostImage;
use App\Models\PostUser;
use App\Models\Repost;
use App\Models\User;
use App\Models\Follow;
use App\Models\PostFavorite;
use App\Models\Term;
use App\Models\Suggest;
use App\Models\AboutUs;
use App\Models\PostNotification;
use App\Models\PhoneData;
use App\Models\Notify;


class PostController extends Controller
{
    public function post(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'body' => 'required|max:250',
        ]);

        if($validator->fails()){
            return response()->json(['status' => 'error', 'msg' => $validator->messages()]);
        }

        $post = Post::create([
            'user_id' => $request->user_id,
            'body' => $request->body,
        ]);


        foreach($request->images as $image)
        {
            $postImage = new PostImage();
                $photo = unique_file($image->getClientOriginalName());
                $image->move(base_path() .'/public/posts/',$photo);
                $postImage->post_id = $post->id;
                $postImage->image = $photo;
            $postImage->save();
        }
        return response()->json(['status' => 'success', 'msg' => $request->header('language')=='ar'?"تم اضافه المنشور":"post added", 'post' => $post]);
    }

    public function repost(Request $request)
    {
        $ids = Follow::where('follower_id', $request->user_id)->pluck('followed_id')->toArray();
        
        $followData = array();
        for($i = 0; $i < count($ids); $i++){
            $followData[$i] = User::where('id', $ids[$i])->select('id', 'name', 'image')->get();
        }
        // dd($followData);
        $post = Post::where('id', $request->id)->with('postImage')->get();
        
        // ->with(array('postImage'=>function($query){$query->select('id','image');}))->get();
        return response()->json(['followData' => $followData, 'post' => $post]);
    }

    public function sendRepost(Request $request)
    {
        $ids = Follow::where('follower_id', $request->follow_id)->pluck('followed_id')->toArray();
        
        if($ids){
            $validator = Validator::make($request->all(), [
                'user_id' => 'required|exists:users,id',
                'body' => 'required|max:250',
            ]);
    
            if($validator->fails()){
                return response()->json(['status' => 'error', 'msg' => $validator->messages()]);
            }

            if($request->private)
            {
                $repost = Post::create([
                    'user_id' => $request->user_id,
                    'body' => $request->body,
                    'private' => $request->private
                ]);
                $ask = PostUser::create([
                  'user_id' => $request->user_id,
                  'ask_id' => $request->ask_id,  
                  'post_id' => $request->post_id, 
                ]);
            }else{
                $repost = Post::create([
                    'user_id' => $request->user_id,
                    'body' => $request->body,
                ]);
                $ask = PostUser::create([
                  'user_id' => $request->user_id,
                  'ask_id' => $request->ask_id, 
                  'post_id' => $request->post_id,  
                ]);
            }

            foreach($request->images as $image)
            {
                $model = new PostImage();
                    $photo = unique_file($image->getClientOriginalName());
                    $image->move(base_path() .'/public/tourist/',$photo);
                    $model->post_id = $repost->id;
                    $model->image = $photo;
                $model->save();
            }
        }else{
            $validator = Validator::make($request->all(), [
                'user_id' => 'required|exists:users,id',
                'body' => 'required|max:250',
            ]);

            if($validator->fails()){
                return response()->json(['status' => 'error', 'msg' => $validator->messages()]);
            }

            if($request->private)
            {
                $repost = Post::create([
                    'user_id' => $request->user_id,
                    'body' => $request->body,
                    'private' => $request->private
                ]);
            }else{
                $repost = Post::create([
                    'user_id' => $request->user_id,
                    'body' => $request->body,
                ]);
            }

            foreach($request->images as $image)
            {
                $model = new PostImage();
                    $photo = unique_file($image->getClientOriginalName());
                    $image->move(base_path() .'/public/tourist/',$photo);
                    $model->post_id = $post->id;
                    $model->image = $photo;
                $model->save();
            }
        }

        $token = PhoneData::where('user_id', $request->user_id)->select('token')->pluck('token');
        
        $notify = PostNotification::create
        (
            [
                'post_id' => $request->post_id,
                'user_id' => $request->user_id,
                'ar_text' => 'هناك شخص يسألك .',
                'en_text' => 'Someone ask you question .',
            ]
        );
        Notify::send($token,$notify->ar_text,$notify->en_text,'post',$notify->post_id);

        return response()->json(['status' => 'success', 'msg' => $request->header('language')=='ar'?"تم إعادة النشر بنجاح":"successfully repost", 'repost' => $repost, 'ask' => $ask]);
    }

    public function comment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'post_id' => 'required|exists:posts,id',
            'comment' => 'required|max:250',
        ]);

        if($validator->fails()){
            return response()->json(['status' => 'error', 'msg' => $validator->messages()]);
        }

        $comment = Comment::create([
            'user_id' => $request->user_id,
            'post_id' => $request->post_id,
            'comment' => $request->comment,
        ]);

        return response()->json(['status' => 'success', 'msg' => $request->header('language')=='ar'?"تم اضافه التعليق":"Comment added", 'comment' => $comment]);
    }

    public function showComment(Request $request)
    {
        $comments = Comment::where('post_id', $request->post_id)->orderBy('created_at', 'desc')->get();
        
        foreach($comments as $comment){
            $comment['name'] = $comment->get_user($comment['user_id'])->name;
            $comment['image'] = 'http://'.$_SERVER['SERVER_NAME'].'/public/users/'.$comment->get_user($comment['user_id'])->image;

        }
        return response()->json(['comments' => $comments]);
    }

    public function like(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'post_id' => 'required|exists:posts,id',
        ]);

        if($validator->fails()){
            return response()->json(['status' => 'error', 'msg' => $validator->messages()]);
        }

        $like = Like::create([
            'user_id' => $request->user_id,
            'post_id' => $request->post_id,
        ]);

        if($like){
            Post::where('id',$request->post_id)->update([
                'likes' => $like->count()
            ]);
        }

        return response()->json(msg($request,success(),'like'));
    }

    public function report(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'post_id' => 'required|exists:posts,id',
            'type' => 'required|in:Hate speech,Self harm,Bulling and harassment',
        ]);

        if($validator->fails())
        {
            return response()->json(['status' => 'error', 'msg' => $validator->messages()]);
        }

        $report = Report::create([
           'user_id' => $request->user_id,
           'post_id' => $request->post_id,
           'type' => $request->type 
        ]);
        
        return response()->json(msg($request,success(),'report'));
    }

    public function show(Request $request)
    {
        $ids = Follow::where('follower_id', $request->user_id)->pluck('followed_id')->toArray();
        array_push($ids,$request->user_id);
        $posts = Post::whereIn('user_id', $ids)->get();
        
        
        foreach($posts as $post)
        {           
            $post['name'] = $post->get_user($post->user_id)->name;
            $post['image'] = 'http://'.$_SERVER['SERVER_NAME'].'/public/users/'.$post->get_user($post->user_id)->image;
        }
        
        $askIds = PostUser::where('ask_id', $request->user_id)->pluck('post_id')->toArray();
        $askPosts = Post::whereIn('id', $askIds)->get();
       
        foreach($askPosts as $post)
        { 
            $post['name'] = $post->get_user($post->user_id)->name;
            $post['image'] = 'http://'.$_SERVER['SERVER_NAME'].'/public/users/'.$post->get_user($post->user_id)->image;
        }

        $new_arr = [];
        $new_arr = array_merge($posts->toArray(),$askPosts->toArray());
       
        return response()->json(['new_arr' =>  $new_arr]);        
    }

    public function favorite(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'user_id' => 'required|exists:users,id',
                'jwt' => 'required|exists:users,jwt,id,'.$request->user_id,
                'post_id' => 'required|exists:posts,id',
            ]
        );

        if($validator->fails())
        {
            return response()->json(['status' => 'error', 'msg' => $validator->messages()]);
        }


        $check = PostFavorite::where('user_id', $request->user_id)->where('post_id', $request->post_id)->first();

        if($check)
        {
            $check->delete();
            return response()->json(['status' => 'success', 'msg' => 'removed']);
        }
        else
        {
            PostFavorite::create
            (
                [
                    'user_id' => $request->user_id,
                    'post_id' => $request->post_id
                ]
            );

            return response()->json(['status' => 'success', 'msg' => 'added']);
        }
    }

    public function terms($lang)
    {
        if ($lang == 'ar') {
            $terms = Term::select('ar_text as text')->first();
        } else {
            $terms = Term::select('en_text as text')->first();
        }

        return response()->json(['terms' => $terms]);
    }

    public function suggest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'text' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'msg' => $validator->messages()]);
        }

        Suggest::create(
            [
                'name' => $request->name,
                'email' => $request->email,
                'text' => $request->text,
            ]
        );

        return response()->json(['status' => 'success', 'msg' => 'suggestion sent successfully']);
    }

    public function aboutus($lang)
    {
        if ($lang == 'ar') {
            $about = AboutUs::select('ar_text as text')->first();
        } else {
            $about = AboutUs::select('en_text as text')->first();
        }

        return response()->json(['abouts' => $about]);
    }



}
