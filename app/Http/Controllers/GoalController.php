<?php

namespace App\Http\Controllers;

use App\Models\Goal;
use App\Models\Plan;
use App\Models\Task;
use Illuminate\Http\Request;

class GoalController extends Controller
{
    // ゴール作成画面の表示　→　タスク管理画面に移動
    /*
    public function create(Goal $goal)
    {
        return view('Goal.create');
    }
    */

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
        $goal = new Goal;
        $target_goal = $goal->find($goal_id);

        // 指定ゴールのプラン
        $plan = new Plan;
        $target_plans_of_goal = $plan->getByGoalId($goal_id);

        // 指定ゴールのタスク
        $task = new Task;
        $target_tasks_of_goal = $task->getByGoalId($goal_id); 

        // ゴールの削除
        $target_goal->delete();

        // プランの削除
        foreach ($target_plans_of_goal as $target_plan) {
            $target_plan->delete();
        }

        // タスクの削除
        foreach ($target_tasks_of_goal as $target_task) {
            $target_task->delete();
        }

        return redirect()->back();
    }
}
