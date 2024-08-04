<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Plan;

use App\Models\Goal;

use App\Models\Task;

use Carbon\Carbon;

class PlanController extends Controller
{
    //
    
    public function create(Plan $plan)
    {
        $goals = Goal::where('achived', '=', 0)->get();
        return view('Plan.Pcreate')->with(['goals' => $goals]);
    }
    
    public function store(Request $request, Plan $plan)
    {
        $input = $request['plan'];
        $plan->fill($input)->save();
        $start = Carbon::parse($plan->start);
        $finish = Carbon::parse($plan->finish);
        $period = $start->diffInDays($finish);
        $task_size = $period / $plan->period;
        for($task_i=1; $task_i <= $task_size; $task_i++)
        {
            $task = new Task;
            $task->name = $plan->name .$task_i . '回目';
            $task->todo = $plan->details;
            $task->time = $plan->time;
            $task->start = Carbon::parse($plan->start)->addDays($task_i);
            $task->end = Carbon::parse($plan->start)->addDays($task_i + 1);
            $task->finish = 0;
            $task->plan_id = $plan->id;
            $task->save();
        }
        return redirect('/home');
    }
    
}
