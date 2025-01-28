<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LikePost extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'user_id',
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function create($post_id, $user_id)
    {
        LikePost::create([
            'post_id' => $post_id,
            'user_id' => $user_id,
        ]);
    }
    
    public function getByPostAndUserId($post_id, $user_id)
    {
        return  LikePost::where('post_id', $post_id)->where('user_id', $user_id)->first();
    }
}
