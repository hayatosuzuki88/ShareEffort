<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    use HasFactory;

    protected $fillable = [
        'goal',
        'date',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function plans()
    {
        return $this->hasMany(Plan::class);
    }
    
    public function find($goal_id)
    {
        return $this->find($goal_id);
    }
    
    public function getByUserId($user_id)
    {
        return Goal::where('user_id', '=', $user_id)->get();
    }
    
    public function getNotAchiveByUserId($user_id)
    {
        return Goal::where([
            ['user_id', $user_id],
            ['achived', 0],
        ])->get();
    }
}
