<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\TaskController;
use App\Models\Plan;
use App\Models\Post;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Task extends Model
{
    use HasFactory;
    
    
    public function plan(){
        return $this->belongsTo(Plan::class);
    }
    
    public function user($task)
    {
        return $task->plan->goal->user;
    }
    
    public function posts()
    {
        return $this->hasMany(Post::class, "followed");
    }
    
    public function get_my_tasks()
    {
        $my_tasks = Task::whereHas("plan", function ($query1) {
            $query1->whereHas("goal", function ($query2) {
                $query2->whereHas("user", function ($query3) {
                    $query3->where("id", Auth::id());    
                });
            });
        })->get();
        
        return $my_tasks;
    }
    
    public function get_today_tasks()
    {
        $today = Carbon::today();
        
        $today_tasks = Task::whereHas("plan", function ($query1) {
            $query1->whereHas("goal", function ($query2) {
                $query2->whereHas("user", function ($query3) {
                    $query3->where("id", Auth::id());    
                });
            });
        })->where("date", "=", $today)->get();
        
        return $today_tasks;
    }
    
    public function achive($minutes)
    {
        $this->finish = 1;
        $this->taken_time = $minutes;
        $this->save();
        
        return $this;
    }
    
    public function previous_task_is_achived()
    {
        $task_table = DB::table('tasks')->orderBy('date')->where('user', Auth::id())->get();
        
        $specified_id = $this->id;
        
        $index = $task_table->search(function ($task_table) use ($specified_id) {
            return $task_table->id == $specified_id;
        });

        // 一つ前の行を取得
        $previousRow = $index > 0 ? $rows[$index - 1] : null;
        
        if ($previousRow == null)
        {
            return 0;
        }
        
        if ($previousRow->achived == 1){
            return 1;
        }else {
            return 0;
        }
    }
}
