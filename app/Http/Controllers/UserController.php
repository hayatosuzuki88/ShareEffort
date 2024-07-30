<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Friend;
use Auth;

class UserController extends Controller
{
    //
    
    
    public function follow($id)
    {
        Friend::create([
            'followed' => $id,
            'follow' => Auth::id(),
            ]);
            
        session()->flash('success', 'You Followed the User.');
        
        return redirect()->back();
    }
    
    
    public function removefollow($id)
    {
        $like = Friend::where('followed', $id)->where('follow', Auth::id())->first();
        $like->delete();
        
        session()->flash('success', 'You Remove Following the User.');
        
        return redirect()->back();
    }
    
    public function show($id)
    {
        $user = User::where('id', $id)->first();
        return view('profile.show')->with(['user' => $user]);
    }
}
