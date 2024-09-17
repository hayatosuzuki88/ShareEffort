<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Routine;
use App\Models\Goal;
use App\Models\Plan;
use App\Models\Task;
use App\Models\Post;
use Auth;

class HomeController extends Controller
{
                                                    
    public function home(Routine $routine)
    {
        $my_goals = Goal::where("user_id", "=", Auth::id())->get();
        
        
        $Task = new Task;
        $today_tasks = $Task->get_today_tasks();
        
        $Routine = new Routine;
        $today_routines_of_friends = $Routine->get_today_routines_of_friends();
        
        //未実装　いずれゴールごとに今日のタスクを表示したい
        $goals_of_today_tasks = [];
        
        //未実装　いずれ友達の投稿のみにしたい
        $Post = new Post;
        $posts_of_friends = $Post->get_posts_of_friends();
        
        //dd($posts_of_friends);
        return view("home")->with([
            "today_routines_of_friends" => $today_routines_of_friends, 
            "my_goals" => $my_goals,
            "goals_of_today_tasks" => $goals_of_today_tasks,
            "today_tasks" => $today_tasks,
            "posts_of_friends" => $posts_of_friends,
        ]);
    }
}
