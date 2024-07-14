<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    
}
