<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'start',
        'end',
        'duration',
        'range_start',
        'range_end',
        'range_unit',
        'routine_time',
        'interval',
        'goal_id',
    ];

    public function goal()
    {
        return $this->belongsTo(Goal::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
    
    public function getByGoalId($goal_id)
    {
        return Plan::where('goal_id', '=', $goal_id)->get();
    }
    
    public function getByUserId($user_id)
    {
        $goals_id = Goal::where('user_id', '=', $user_id)->pluck('id');
        $my_plans = Plan::whereIn('goal_id', $goals_id)->get();
        
        return $my_plans;
    }
}
