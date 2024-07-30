<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\TaskController;
use App\Models\Plan;

class Task extends Model
{
    use HasFactory;
    
    
    public function plan(){
        return $this->belongsTo(Plan::class);
    }
}
