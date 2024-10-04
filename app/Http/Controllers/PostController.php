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
    // 投稿作成画面の表示
    public function create(Post $post)
    {
        // 今日のタスク
        $Task = new Task;
        $my_today_tasks = $Task->get_today_tasks();
        
        return view("Post.create")->with(["my_today_tasks" => $my_today_tasks]);
    }
    
    // 投稿画面の保存
    public function store(Request $request, Post $post)
    {
        // 投稿のポイント制度導入時の処理　廃止
        /*
        Auth::User()->point += 5;
        Auth::User()->save();
        */
        
        // todo　タスクの継続をカウント
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
       
        // 投稿ができたらタスクを達成状態にする
        $input = $request["post"];
        $minutes = $request["minutes"];
        $task_id = $input["task_id"];
        $task = Task::find($task_id);
        
        if ($task){ // taskが存在したら、かかった時間とともに達成状態にする
            $task->achive($minutes);
        }
        
        // todo　いずれタスクごとに色を決められるようにしたい
        $task->color = "#ff8484";
        
        $task->save();
        
        // 画像の保存
        $image_path = Cloudinary::upload($request->file("image")->getRealPath())->getSecurePath();
        
        $input += ["image_path" => $image_path];
        $post->fill($input)->save();
        
        return redirect(route("post.show", ["post_id" => $post->id]));
    }
    
    // 投稿の詳細画面の表示
    public function show($post_id)
    {
        $post = Post::find($post_id);
        
        return view("Post.show")->with(["post" => $post]);
    }
    
    // 投稿の削除
    public function delete($post_id)
    {
        // 投稿のポイント制度導入時の処理　廃止
        /*
        Auth::User()->point -= 5;
        Auth::User()->save();
        */
       
        // todo　タスクの継続をカウント
        /*
        if($task->previous_task_is_achived()){
            Auth::User()->continue -= 1;
            Auth::User()->save();
        } else {
            Auth::User()->continue = 0;
            Auth::User()->save();
        }
        */
       
        $post = Post::find($post_id);
        $task = Task::find($post->task_id);
        
        // タスクの色を灰色に戻す
        $task->color = "#c0c0c0";
        
        $task->save();
        
        $post->delete();
        
        return redirect("/");
    }
    
    // 全ての投稿を（NEW POSTページに）表示
    public function all()
    {
        $all_posts = Post::all();
        return view("Post.new")->with(["all_posts" => $all_posts ]);
    }
    
    // 投稿のいいね
    public function like($post_id)
    {
        // 投稿のポイント制度導入時の処理　廃止
        /*
        Auth::User()->point += 3;
        Auth::User()->save();
        */
        
        LikePost::create([
            "post_id" => $post_id,
            "user_id" => Auth::id(),
        ]);
            
        return redirect()->back();
    }
    
    // 投稿のいいね取り消し
    public function unlike($post_id)
    {
        // 投稿のポイント制度導入時の処理　廃止
        /*
        Auth::User()->point -= 3;
        Auth::User()->save();
        */
        
        $like = LikePost::where("post_id", $post_id)->where("user_id", Auth::id())->first();
        $like->delete();
        
        return redirect()->back();
    }
}
