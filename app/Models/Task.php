<?php

namespace App\Models;

use Auth;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function user($task)
    {
        return $task->plan->goal->user;
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'followed');
    }

    // 自分のタスクを取得
    public function get_my_tasks()
    {
        $my_tasks = Task::whereHas('plan', function ($query1) {
            $query1->whereHas('goal', function ($query2) {
                $query2->whereHas('user', function ($query3) {
                    $query3->where('id', Auth::id());
                });
            });
        })->get();

        return $my_tasks;
    }

    // 今日のタスクを取得
    public function get_today_tasks()
    {
        $today = Carbon::today();

        $today_tasks = Task::whereHas('plan', function ($query1) {
            $query1->whereHas('goal', function ($query2) {
                $query2->whereHas('user', function ($query3) {
                    $query3->where('id', Auth::id());
                });
            });
        })->where('date', '=', $today)->get();

        return $today_tasks;
    }

    // タスクを達成状況にする
    public function achive($minutes)
    {
        $this->finish = 1;
        $this->taken_time = $minutes;
        $this->save();

        return $this;
    }

    // 一つ前のタスクが達成状況になっているか
    public function previous_task_is_achived()
    {
        $task_table = Task::whereHas('plan', function ($query1) {
            $query1->whereHas('goal', function ($query2) {
                $query2->whereHas('user', function ($query3) {
                    $query3->where('id', Auth::id());
                });
            });
        })->orderBy('date')->get();

        $specified_id = $this->id;

        $index = $task_table->search(function ($task_table) use ($specified_id) {
            return $task_table->id == $specified_id;
        });

        // 一つ前の行を取得
        $previousRow = $index > 0 ? $rows[$index - 1] : null;

        if ($previousRow == null) {
            return 0;
        }

        if ($previousRow->achived == 1) {
            return 1;
        } else {
            return 0;
        }
    }
}
