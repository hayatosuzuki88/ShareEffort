<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Routine;
use App\Models\Goal;
use App\Models\Plan;
use App\Models\Task;
use App\Models\Post;
use Carbon\Carbon;
use Auth;

class HomeController extends Controller
{
                                                    
    public function home(Routine $routine)
    {
        $my_goals = Goal::where("user_id", "=", Auth::id())->get();
        
        $yesterday = Carbon::now()->subDay();
        $today_routines = Routine::whereDate("created_at", ">=", $yesterday)->get();
        
        $Task = new Task;
        $today_tasks = $Task->get_today_tasks();
        
        //未実装　いずれゴールごとに今日のタスクを表示したい
        $goals_of_today_tasks = [];
        
        //未実装　いずれ友達の投稿のみにしたい
        $all_posts = Post::all();
        
        return view("home")->with([
            "today_routines" => $today_routines, 
            "my_goals" => $my_goals,
            "goals_of_today_tasks" => $goals_of_today_tasks,
            "today_tasks" => $today_tasks,
            "all_posts" => $all_posts,
        ]);
    }
}
