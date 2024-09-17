<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\LikeRoutine;
use App\Models\User;
use App\Models\CommentRoutine;
use Carbon\Carbon;
use Auth;

class Routine extends Model
{
    use HasFactory;
    
    protected $fillable = [
        "name",
        "minutes",
        "body",
        "image_path",
        "user_id",
    ];
        
    public function user(){
        return $this->belongsTo(User::class, "user_id");
    }
    
    public function like_routines()
    {
        return $this->hasMany(LikeRoutine::class, "routine_id");
    }
    
    public function comment_routines()
    {
        return $this->hasMany(CommentRoutine::class, "routine_id");
    }
    
    public function is_liked_by_auth_user()
    {
        $my_id = Auth::id();
        
        $likers = array();
        
        foreach($this->like_routines as $like) {
            $liker = $like->user_id;
            array_push($likers, $liker);
        }
        
        if (in_array($my_id, $likers)) {
            return true;
        } else {
            return false;
        }
        
    }
    
    public function get_today_routines_of_friends ()
    {
        $user = Auth::User();
        
        $yesterday = Carbon::now()->subDay();
        
        $my_friends = Friend::where('follow', Auth::id())->pluck("followed");
        
        $today_routines_of_friends = Routine::whereDate("created_at", ">=", $yesterday)->whereIn("user_id", $my_friends)->get();
    
        return $today_routines_of_friends;
    
    }
    
}
