<?php

namespace App\Http\Controllers;

use App\Models\Goal;
use App\Models\Post;
use App\Models\Routine;
use App\Models\Task;
use Auth;

class HomeController extends Controller
{
    // ホーム画面の表示
    public function home(Routine $routine)
    {
        // 自分のゴール
        $my_goals = Goal::where('user_id', '=', Auth::id())->get();

        // 自分の今日のタスク
        $Task = new Task;
        $today_tasks = $Task->getTodayTasks();

        // 今日の自分のルーティン
        $Routine = new Routine;
        $my_today_routine = $Routine->getMyTodayRoutine();

        // 友達の今日のルーティン
        $today_routines_of_friends = $Routine->getTodayRoutinesOfFriends();

        // ゴールごとのタスク
        // todo　いずれゴールごとに今日のタスクを表示したい
        $goals_of_today_tasks = [];

        // 友達の投稿
        $Post = new Post;
        $posts_of_friends = $Post->getPostsOfFriends();

        return view('home')->with([
            'my_today_routine' => $my_today_routine,
            'today_routines_of_friends' => $today_routines_of_friends,
            'my_goals' => $my_goals,
            'goals_of_today_tasks' => $goals_of_today_tasks,
            'today_tasks' => $today_tasks,
            'posts_of_friends' => $posts_of_friends,
        ]);
    }
}
