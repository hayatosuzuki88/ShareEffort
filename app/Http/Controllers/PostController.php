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
    
    public function create(Post $post)
    {
        $Task = new Task;
        $my_tasks = $Task->get_my_tasks();
        return view("Post.create")->with(["my_tasks" => $my_tasks]);
    }
    
    public function store(Request $request, Post $post)
    {
        $input = $request["post"];
        
        if ($request->file("image") == null)
        {
            $image_path = null;
        } else {
            $image_path = Cloudinary::upload($request->file("image")->getRealPath())->getSecurePath();
        }
        
        $input += ["image_path" => $image_path];
        $post->fill($input)->save();
        
        return redirect(route("post.show", ["post_id" => $post->id]));
    }
    
    public function show($post_id)
    {
        $post = Post::find($post_id);
        return view("Post.show")->with(["post" => $post]);
    }
    
    public function like($post_id)
    {
        LikePost::create([
            "post_id" => $post_id,
            "user_id" => Auth::id(),
            ]);
            
        return redirect()->back();
    }
    
        
    public function unlike($post_id)
    {
        $like = LikePost::where("post_id", $post_id)->where("user_id", Auth::id())->first();
        $like->delete();
        
        return redirect()->back();
    }
}
