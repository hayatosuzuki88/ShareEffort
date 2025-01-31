<?php

namespace App\Http\Controllers;

use App\Models\Goal;
use App\Models\Plan;
use App\Models\Task;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    // プラン作成画面の表示　→　タスク管理画面に移動
    /*
    public function create(Plan $plan)
    {
        // 自分の未達成なゴール
        $not_achived_goals_of_mine = Goal::where([
            ['user_id', Auth::id()],
            ['achived', 0],
        ])->get();

        return view('Plan.create')->with(['not_achived_goals_of_mine' => $not_achived_goals_of_mine]);
    }
    */

    // プランの保存
    public function store(Request $request, Plan $plan)
    {
        // プランの保存
        $input = $request['plan'];
        $plan->fill($input)->save();

        // 日付として扱いやすくCarbonに
        $start = Carbon::parse($plan->start);
        $end = Carbon::parse($plan->end);

        // 一日のタスクの量を計算
        $period = $start->diffInDays($end);
        $interval = $plan->interval;
        $task_size = $period / $interval + 1;
        $task_range_per_day = round(($plan->range_end - $plan->range_start) / $task_size);
        $task_range_start = $plan->range_start - 1;

        // プランの情報からタスクを生成
        for ($task_i = 1; $task_i <= $task_size; $task_i++) {
            $task = new Task;
            $task->name = $plan->name.$task_i.'回目';

            if ($task_i == $task_size) { // 範囲の余りを最後に行う
                $task->range = ($task_range_start + 1).$plan->range_unit.'から'.$plan->range_end.$plan->range_unit;
            } else {
                $task->range = ($task_range_start + 1).$plan->range_unit.'から'.($task_range_start + $task_range_per_day).$plan->range_unit;
            }

            // 次のタスクの範囲の計算
            $task_range_start += $task_range_per_day;

            $task->duration = $plan->duration;
            $task->date = Carbon::parse($plan->start)->addDays(($task_i - 1) * $interval);
            $task->start = $plan->routine_time;
            $task->taken_time = 0;
            $task->plan_id = $plan->id;
            $task->save();
        }

        return redirect(route('task.manage'));
    }

    // プランとその関連のタスクの削除
    public function delete($plan_id)
    {
        // 指定のプラン
        $plan = new Plan;
        $target_plan = $plan->find($plan_id);

        // 指定プランのタスク
        $task = new Task;
        $target_tasks_of_plan = $task->getByPlanId($plan_id);

        // プランの削除
        $target_plan->delete();

        // タスクの削除
        foreach ($target_tasks_of_plan as $target_task) {
            $target_task->delete();
        }

        return redirect()->back();
    }
}
