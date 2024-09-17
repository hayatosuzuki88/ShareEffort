<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Goal;
use App\Models\Plan;
use App\Models\Task;
use Carbon\Carbon;
use Auth;

class PlanController extends Controller
{
    
    public function create(Plan $plan)
    {
        $not_achived_goals_of_mine = Goal::where([
            ["user_id", Auth::id()],
            ["achived", 0],
            ])->get();
        return view("Plan.create")->with(["not_achived_goals_of_mine" => $not_achived_goals_of_mine]);
    }
    
    public function store(Request $request, Plan $plan)
    {
        $input = $request["plan"];
        $plan->fill($input)->save();
        
        $start = Carbon::parse($plan->start);
        $end = Carbon::parse($plan->end);
        
        $period = $start->diffInDays($end);
        $interval = $plan->interval;
        $task_size = $period / $interval;
        $task_range_per_day = round(($plan->rangeE - $plan->rangeS) / $task_size);
        $task_range_start = $plan->rangeS - 1;
        
        for($task_i=1; $task_i <= $task_size; $task_i++)
        {
            $task = new Task;
            $task->name = $plan->name . $task_i . "回目";
            if($task_i == $task_size){
                $task->range = ($task_range_start + 1) . $plan->rangeUnit ."から". $plan->rangeE . $plan->rangeUnit;
            }else {
            $task->range = ($task_range_start + 1) . $plan->rangeUnit ."から". ($task_range_start + $task_range_per_day) . $plan->rangeUnit;
            }
            $task_range_start += $task_range_per_day;
            $task->duration = $plan->duration;
            $task->date = Carbon::parse($plan->start)->addDays(($task_i - 1) * $interval);
            $task->start = $plan->routine_time;
            $task->taken_time = 0;
            $task->plan_id = $plan->id;
            $task->save();
        }
        return redirect(route("task.manage"));
    }
    
}
