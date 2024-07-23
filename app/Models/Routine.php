<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\LikeRoutine;
use App\Models\User;
use Auth;

class Routine extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'minutes',
        'body',
        'image_path',
        'user_id',
    ];
        
    public function user(){
        return $this->belongsTo(User::class);
    }
    
    public function like_routines()
    {
        return $this->hasMany(LikeRoutine::class, 'routine_id');
    }
    
    public function is_liked_by_auth_user()
    {
        $id = Auth::id();
        
        $likers = array();
        foreach($this->like_routines as $like) {
            array_push($likers, $like->user_id);
        }
        
        if (in_array($id, $likers)) {
            return true;
        } else {
            return false;
        }
    }
    
}
