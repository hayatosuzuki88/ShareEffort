<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Friend;
use Auth;

class UserController extends Controller
{
    // ユーザをフォロー
    public function follow($friend_id)
    {
        Friend::create([
            "followed" => $friend_id,
            "follow" => Auth::id(),
        ]);
            
        return redirect()->back();
    }
    
    // ユーザのフォローを取り消し
    public function removefollow($friend_id)
    {
        $like = Friend::where("followed", $friend_id)->where("follow", Auth::id())->first();
        $like->delete();
        
        return redirect()->back();
    }
    
    // ユーザの詳細画面を表示
    public function show($user_id)
    {
        $user = User::where("id", $user_id)->first();
        return view("profile.show")->with(["user" => $user]);
    }
}
