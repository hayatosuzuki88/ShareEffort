<?php

namespace App\Http\Controllers;

use App\Models\Goal;
use App\Models\Plan;
use App\Models\Task;
use Auth;

class TaskController extends Controller
{
    // タスク管理画面の表示
    public function manage(Task $task)
    {
        $my_id = Auth::id();
        // 自分のゴール
        $goal = new Goal;
        $my_goals = $goal->getByUserId($my_id);

        // 自分のプラン
        $plan = new Plan;
        $my_plans = $plan->getByUserId($my_id);

        // 未達成な自分のゴール
        $not_achived_goals_of_mine = $goal->getNotAchiveByUserId($my_id)
        

        return view('Task.manage')->with([
            'my_goals' => $my_goals,
            'my_plans' => $my_plans,
            'not_achived_goals_of_mine' => $not_achived_goals_of_mine,
        ]);
    }

    // JSのカレンダー用のコードがタスクを取得
    public function getEvents()
    {
        // 自分のタスクを取得
        $Task = new Task;
        $my_tasks = $Task->getMyTasks();

        $my_events = [];

        foreach ($my_tasks as $task) { // タスクからカレンダーに表示されるイベントを作成
            $event_name = $task->name;
            $date = $task->date;
            $color = $task->color;
            $range = $task->range;
            $my_event = [
                'title' => $event_name,
                'start' => $date,
                'color' => $color,
                'description' => $range,
            ];
            array_push($my_events, $my_event);
        }

        return $my_events;
    }
}
