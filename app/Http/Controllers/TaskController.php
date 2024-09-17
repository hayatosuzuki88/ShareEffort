<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Goal;
use App\Models\Plan;
use App\Models\Task;
use Auth;

class TaskController extends Controller
{
    //
    
    public function manage(Task $task)
    {
        $my_goals = Goal::where("user_id", "=", Auth::id())->get();
        $my_goals_id =  Goal::where("user_id", "=", Auth::id())->pluck("id");
        
        $my_plans = Plan::whereIn("goal_id", $my_goals_id)->get();
        
        $not_achived_goals_of_mine = Goal::where([
            ["user_id", Auth::id()],
            ["achived", 0],
            ])->get();
            
        return view("Task.manage")->with([
            "my_goals" => $my_goals,
            "my_plans" => $my_plans,
            "not_achived_goals_of_mine" => $not_achived_goals_of_mine,
            ]);
    }
    
    public function getEvents()
    {
        $Task = new Task;
        $my_tasks = $Task->get_my_tasks();
        $my_events = [];
        
        foreach($my_tasks as $task)
        {
            $event_name = $task->name;
            $date = $task->date;
            $color = $task->color;
            $range = $task->range;
            $my_event = [
                "title" => $event_name,
                "start" => $date,
                "color" => $color,
                "description" => $range,
            ];
            array_push($my_events, $my_event);
        }
        
        return $my_events;
    }
}
