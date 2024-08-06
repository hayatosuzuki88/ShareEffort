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
        return view("Task.manage");
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
            $my_event = [
                "title" => $event_name,
                "start" => $date,
                "color" => "#ff44cc",
            ];
            array_push($my_events, $my_event);
        }
        
        return $my_events;
    }
}
