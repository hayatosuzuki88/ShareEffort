<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LikeRoutine extends Model
{
    use HasFactory;

    protected $fillable = [
        'routine_id',
        'user_id',
    ];

    public function routine()
    {
        return $this->belongsTo(Routine::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function create($routine_id, $user_id)
    {
        LikeRoutine::create([
            'routine_id' => $routine_id,
            'user_id' => $user_id,
        ]);
    }
    
    public function getByRoutineAndUserId($routine_id, $user_id)
    {
        LikeRoutine::where('routine_id', $routine_id)->where('user_id', $user_id)->first();
    }
}
