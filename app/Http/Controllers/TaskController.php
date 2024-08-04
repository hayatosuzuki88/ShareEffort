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
    
    public function create(Task $task)
    {
        return view('Task.Tcreate');
    }
    
    public function getEvents()
    {
        $tmp_task = new Task;
        $tasks_of_user = $tmp_task->get_task_of_auth_user();
        $events = [];
        $count = 0;
        foreach($tasks_of_user as $task)
        {
            $count += 1;
            $count_string = (string) $count;
            $title = $task->name;
            $start = $task->start;
            $event = [
                'title' => $title,
                'start' => $start,
                'color' => '#ff44cc',
            ];
            array_push($events, $event);
        }
        return $events;
    }
}
