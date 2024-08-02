<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Routine;
use App\Models\User;

class CommentRoutine extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'routine_id',
        'comment',
        'user_id',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function routine()
    {
        return $this->belongsTo(Routine::class);
    }
}
