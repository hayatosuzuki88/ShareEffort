<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Routine;
use App\Models\Goal;
use App\Models\Plan;
use App\Models\Task;
use Carbon\Carbon;
use Auth;

class HomeController extends Controller
{
    //
                                                    
    public function home(Routine $routine)
    {
        $goals = Goal::where('user_id', '=', Auth::user()->id)->get();
        $today_routine = Routine::whereDate('created_at', '>=', Carbon::today()->subDay())->get();
        
        $tmp_task = new Task;
        $today_tasks = $tmp_task->get_today_tasks();
        $goals_of_today_tasks = [];
        return view('home')->with([
            'routines' => $today_routine, 
            'goals' => $goals,
            'goals_of_today_tasks' => $goals_of_today_tasks,
            'today_tasks' => $today_tasks,
            ]);
    }
}
