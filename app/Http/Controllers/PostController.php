<?php

namespace App\Http\Controllers;

use App\Models\LikePost;
use App\Models\Post;
use App\Models\Task;
use Auth;
use Cloudinary;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // 投稿作成画面の表示
    public function create(Post $post)
    {
        // 今日のタスク
        $Task = new Task;
        $my_today_tasks = $Task->getTodayTasks();

        return view('Post.create')->with(['my_today_tasks' => $my_today_tasks]);
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
        if($task->previousTaskIsAchived())
        {
            Auth::User()->continue += 1;
            Auth::User()->save();
        } else {
            Auth::User()->continue = 1;
            Auth::User()->save();
        }
        */

        // 投稿ができたらタスクを達成状態にする
        $input = $request['post'];
        $minutes = $request['minutes'];
        $task_id = $input['task_id'];
        $task = new Task;
        $target_task = $task->find($task_id);

        if ($target_task) { // taskが存在したら、かかった時間とともに達成状態にする
            $target_task->achive($minutes);
        }

        // todo　いずれタスクごとに色を決められるようにしたい
        $target_task->color = '#ff8484';

        $target_task->save();

        // 画像の保存
        $image_path = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();

        $input += ['image_path' => $image_path];
        $post->fill($input)->save();

        return redirect(route('post.show', ['post_id' => $post->id]));
    }

    // 投稿の詳細画面の表示
    public function show($post_id)
    {
        $post = new Post;
        $targetpost = $post->find($post_id);

        return view('Post.show')->with(['post' => $target_post]);
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
        if($task->previousTaskIsAchived()){
            Auth::User()->continue -= 1;
            Auth::User()->save();
        } else {
            Auth::User()->continue = 0;
            Auth::User()->save();
        }
        */
        
        $post = new Post;
        $task = new Task;
        $target_post = $post->find($post_id);
        $target_task = $task->find($post->task_id);

        // タスクの色を灰色に戻す
        $target_task->color = '#c0c0c0';
        $target_task->finish = 0;

        $target_task->save();

        $target_post->delete();

        return redirect('/');
    }

    // 全ての投稿を（NEW POSTページに）表示
    public function all()
    {
        $post = new Post;
        $all_posts = $post->all();

        return view('Post.new')->with(['all_posts' => $all_posts]);
    }

    // 投稿のいいね
    public function like($post_id)
    {
        // 投稿のポイント制度導入時の処理　廃止
        /*
        Auth::User()->point += 3;
        Auth::User()->save();
        */

        $like_post = new LikePost;
        $like_post->create($post_id, Auth::id());

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
        
        $like_post = new LikePost;
        $like = $like_post->getByPostAndUserId($post_id, Auth::id());
        $like->delete();

        return redirect()->back();
    }
}
