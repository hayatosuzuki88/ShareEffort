<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Friend;
use App\Models\Routine;
use App\Models\Goal;
use App\Models\CommentRoutine;
use Auth;

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
        /*
        'preference',
        'birth',
        */
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
    
    public function routines(){
        return $this->hasMany(Routine::class);
    }
    
    public function goals(){
        return $this->hasMany(Goal::class);
    }
    
    public function like_routines()
    {
        return $this->hasMany(LikeRoutine::class, 'routine_id');
    }
    
    public function friends()
    {
        return $this->hasMany(Friend::class, 'followed');
    }
    
    public function comment_routines()
    {
        return $this->hasMany(CommentRoutine::class, 'user_id');
    }
    
    
    public function is_followed_by_auth_user()
    {
        $id = Auth::id();
        
        $friends = array();
        foreach($this->friends as $friend) {
            array_push($friends, $friend->follow);
        }
        
        if (in_array($id, $friends)) {
            return true;
        } else {
            return false;
        }
    }

}


