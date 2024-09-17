<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\LikePost;
use App\Models\Task;
use App\Models\User;
use App\Models\CommentPost;
use Auth;

class Post extends Model
{
    
    use HasFactory;
    
    protected $fillable = [
        "title",
        "body",
        "task_id",
        "image_path",
        "user_id",
    ];
    
    public function task(){
        return $this->belongsTo(Task::class);
    }
    
    public function user(){
        return $this->belongsTo(User::class);
    }
    
    public function comment_posts()
    {
        return $this->hasMany(CommentPost::class, "post_id");
    }
    
    public function like_posts()
    {
        return $this->hasMany(LikePost::class, "post_id");
    }
    
    public function is_liked_by_auth_user()
    {
        $my_id = Auth::id();
        
        $likers = array();
        
        foreach($this->like_posts as $like) {
            $liker = $like->user_id;
            array_push($likers, $liker);
        }
        
        if (in_array($my_id, $likers)) {
            return true;
        } else {
            return false;
        }
        
    }
    
    public function get_posts_of_friends()
    {
        $user = Auth::User();
        
        $my_friends = Friend::where('follow', Auth::id())->pluck("followed");
        
        $posts_of_friends = Post::whereIn("user_id", $my_friends)->get();
        
        return $posts_of_friends;
    }
}
