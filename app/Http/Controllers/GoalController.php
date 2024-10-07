<?php

namespace App\Http\Controllers;

use App\Models\Goal;
use App\Models\Plan;
use App\Models\Task;
use Illuminate\Http\Request;

class GoalController extends Controller
{
    // ゴール作成画面の表示
    public function create(Goal $goal)
    {
        return view('Goal.create');
    }

    // ゴールの保存
    public function store(Request $request, Goal $goal)
    {
        $input = $request['goal'];
        $goal->fill($input)->save();

        return redirect(route('task.manage'));
    }

    // ゴールとそれに関連するプランとタスクの削除
    public function delete($goal_id)
    {
        // 指定のゴール
        $goal = Goal::find($goal_id);

        // 指定ゴールのプラン
        $plans_of_goal = Plan::where('goal_id', '=', $goal_id)->get();

        // 指定ゴールのタスク
        $tasks_of_goal = Task::whereHas('plan', function ($query1) use ($goal_id) {
            $query1->where('goal_id', '=', $goal_id);
        })->get();

        // ゴールの削除
        $goal->delete();

        // プランの削除
        foreach ($plans_of_goal as $plan) {
            $plan->delete();
        }

        // タスクの削除
        foreach ($tasks_of_goal as $task) {
            $task->delete();
        }

        return redirect()->back();
    }
}
