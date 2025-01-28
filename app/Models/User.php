<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'image_path',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function routines()
    {
        return $this->hasMany(Routine::class);
    }

    public function goals()
    {
        return $this->hasMany(Goal::class);
    }

    public function likeRoutines()
    {
        return $this->hasMany(LikeRoutine::class, 'routine_id');
    }

    public function friends()
    {
        return $this->hasMany(Friend::class, 'follow');
    }

    public function commentRoutines()
    {
        return $this->hasMany(CommentRoutine::class, 'user_id');
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'followed');
    }

    public function likePosts()
    {
        return $this->hasMany(LikePost::class, 'post_id');
    }
    
    public function find($user_id)
    {
        return User::find($user_id);
    }
    
    public function getFollowingUser()
    {
        $following_user_id = Friend::where('follow', $this->id)->pluck('followed');
        $following_user = User::whereIn('id', $following_user_id)->get();
        return $following_user;
    }
    
    public function getFollowedUser()
    {
        $followed_user_id = Friend::where('followed', $this->id)->pluck('follow');
        $followed_user = User::whereIn('id', $followed_user_id)->get();
        return $followed_user;
    }

    // ユーザがログインユーザにフォローされているか
    public function isFollowedByAuthUser()
    {
        $my_id = Auth::id();

        // フォローしているユーザの配列
        $my_friends = Friend::where('follow', '=', $my_id)->get()->pluck('followed');

        if ($my_friends->contains($this->id)) { // フォローしているユーザにログインユーザが含まれているか
            return true;
        } else {
            return false;
        }
    }
}
