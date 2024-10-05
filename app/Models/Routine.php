<?php

namespace App\Models;

use Auth;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Routine extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'minutes',
        'body',
        'image_path',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function like_routines()
    {
        return $this->hasMany(LikeRoutine::class, 'routine_id');
    }

    public function comment_routines()
    {
        return $this->hasMany(CommentRoutine::class, 'routine_id');
    }

    // ルーティンがログインユーザにいいねされているか
    public function is_liked_by_auth_user()
    {
        $my_id = Auth::id();

        // ルーティンをいいねしているユーザの配列
        $likers = [];
        foreach ($this->like_routines as $like) {
            $liker = $like->user_id;
            array_push($likers, $liker);
        }

        if (in_array($my_id, $likers)) { // いいねしているユーザにログインユーザが含まれているか
            return true;
        } else {
            return false;
        }

    }

    // 今日のルーティンをしている友達
    public function get_today_routines_of_friends()
    {
        $user = Auth::User();

        $yesterday = Carbon::now()->subDay();

        $my_friends = Friend::where('follow', Auth::id())->pluck('followed');

        // 一日以内のルーティン
        $today_routines_of_friends = Routine::whereDate('created_at', '>=', $yesterday)->whereIn('user_id', $my_friends)->get();

        return $today_routines_of_friends;

    }

    public function get_my_today_routine()
    {

        $yesterday = Carbon::now()->subDay();

        // 一日以内のルーティン
        $my_today_routine = Routine::whereDate('created_at', '>=', $yesterday)->where('user_id', Auth::id())->get();

        return $my_today_routine;
    }
}
