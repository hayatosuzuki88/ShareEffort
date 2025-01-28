<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    use HasFactory;

    protected $fillable = [
        'follow',
        'followed',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function create($friend_id, $user_id)
    {
        Friend::create([
            'followed' => $friend_id,
            'follow' => $user_id,
        ]);
    }
    
    public function getByFriendAndUserId($friend_id, $user_id)
    {
        return Friend::where('followed', $friend_id)->where('follow', Auth::id())->first();
    }
}
