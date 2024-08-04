<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Task;
use App\Models\LikePost;
use Auth;
use Cloudinary;

class PostController extends Controller
{
    //
    
    public function create(Post $post)
    {
        $tmp_task = new Task;
        $tasks = $tmp_task->get_task_of_auth_user();
        return view('Post.Pcreate')->with(['tasks' => $tasks]);
    }
    
    public function store(Request $request, Post $post)
    {
        $input = $request['post'];
        $image_path = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
        $user_id = Auth::user()->id;
        $input += ['image_path' => $image_path];
        $input += ['user_id' => $user_id];
        $post->fill($input)->save();
        return redirect('/posts/' .$post->id);
    }
    
    public function show(Post $post)
    {
        return view('Post.post')->with(['post' => $post]);
    }
    
    public function like($id)
    {
        LikePost::create([
            'post_id' => $id,
            'user_id' => Auth::id(),
            ]);
            
        session()->flash('success', 'You Liked the Post.');
        
        return redirect()->back();
    }
    
        
    public function unlike($id)
    {
        $like = LikePost::where('post_id', $id)->where('user_id', Auth::id())->first();
        $like->delete();
        
        session()->flash('success', 'You Unliked the Post.');
        
        return redirect()->back();
    }
}
