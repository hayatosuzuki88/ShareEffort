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
        $my_today_tasks = $Task->get_today_tasks();
        return view("Post.create")->with(["my_today_tasks" => $my_today_tasks]);
    }
    
    public function store(Request $request, Post $post)
    {
       /*Auth::User()->point += 5;
       Auth::User()->save();*/
       
        
        $input = $request["post"];
        
        $minutes = $request["minutes"];
        $task_id = $input["task_id"];
        $task = Task::find($task_id);
        if ($task){
            $task->achive($minutes);
        }
        
        $task->color = "#ff8484";
        $task->save();
        
        if ($request->file("image") == null)
        {
            $image_path = null;
        } else {
            $image_path = Cloudinary::upload($request->file("image")->getRealPath())->getSecurePath();
        }
        
        $input += ["image_path" => $image_path];
        $post->fill($input)->save();
        /*
        if($task->previous_task_is_achived())
        {
            Auth::User()->continue += 1;
            Auth::User()->save();
        } else {
            Auth::User()->continue = 1;
            Auth::User()->save();
        }
        */
        return redirect(route("post.show", ["post_id" => $post->id]));
    }
    
    public function show($post_id)
    {
        $post = Post::find($post_id);
        return view("Post.show")->with(["post" => $post]);
    }
    
    public function delete($post_id)
    {
        /*Auth::User()->point -= 5;
        Auth::User()->save();*/
       
        $post = Post::find($post_id);
        
        $task = Task::find($post->task_id);
        /*if($task->previous_task_is_achived())
        {
            Auth::User()->continue -= 1;
            Auth::User()->save();
        } else {
            Auth::User()->continue = 0;
            Auth::User()->save();
        }
        */
        $task->color = "#c0c0c0";
        $task->save();
        
        $post->delete();
        
        return redirect("/");
    }
    
    public function all()
    {
        $all_posts = Post::all();
        return view("Post.new")->with(["all_posts" => $all_posts ]);
    }
    
    public function like($post_id)
    {
        /*Auth::User()->point += 3;
        Auth::User()->save();*/
        
        LikePost::create([
            "post_id" => $post_id,
            "user_id" => Auth::id(),
            ]);
            
        return redirect()->back();
    }
    
        
    public function unlike($post_id)
    {
        
        /*Auth::User()->point -= 3;
        Auth::User()->save();*/
        
        $like = LikePost::where("post_id", $post_id)->where("user_id", Auth::id())->first();
        $like->delete();
        
        return redirect()->back();
    }
}
