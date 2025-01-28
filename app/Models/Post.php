<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
        'task_id',
        'image_path',
        'user_id',
    ];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function commentPosts()
    {
        return $this->hasMany(CommentPost::class, 'post_id');
    }

    public function likePosts()
    {
        return $this->hasMany(LikePost::class, 'post_id');
    }
    
    public function all()
    {
        return Post::all();
    }

    // 投稿がログインユーザにいいねされているか
    public function isLikedByAuthUser()
    {
        $my_id = Auth::id();

        // 投稿をいいねしているユーザの配列
        $likers = [];
        foreach ($this->likePosts as $like) {
            $liker = $like->user_id;
            array_push($likers, $liker);
        }

        if (in_array($my_id, $likers)) { // いいねしているユーザにログインユーザが含まれているか
            return true;
        } else {
            return false;
        }

    }

    // 友達の投稿を返す
    public function getPostsOfFriends()
    {
        $user = Auth::User();

        $my_friends = Friend::where('follow', Auth::id())->pluck('followed');

        $posts_of_friends = Post::whereIn('user_id', $my_friends)->get();

        return $posts_of_friends;
    }
}
