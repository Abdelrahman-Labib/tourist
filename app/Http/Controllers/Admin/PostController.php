<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Post;
class PostController extends Controller
{
    public function index()
    {
        $posts = Post::paginate(50);
        return view('admin.posts.index', compact('posts'));
    }

    public function view(Request $request, $id)
    {
        $request->merge(['post_id' => $id]);
        $post = Post::find($id);

        return view('admin.posts.view', compact('post'));
    }

    public function destroy(Request $request)
    {
        $this->validate($request,
            [
                'post_id' => 'required|exists:posts,id'
            ]
        );

        Post::where('id', $request->post_id)->delete();

        return back()->with('success', 'تمت العملية بنجاح');
    }
}
