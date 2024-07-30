<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Goal;
use App\Models\Task;

class Plan extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'start',
        'finish',
        'time',
        'range',
        'goal_id',
    ];
    
    public function goal(){
        return $this->belongsTo(Goal::class);
    }
    
    public function tasks(){
        return $this->hasMany(Task::class);
    }
}
