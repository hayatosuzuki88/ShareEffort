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
        $profiled_user = User::where("id", $user_id)->first();
        
        $following_user_id = Friend::where("follow", $profiled_user->id)->pluck("followed");
        $following_user = User::whereIn("id", $following_user_id)->get();
        
        $followed_user_id = Friend::where("followed", $profiled_user->id)->pluck("follow");
        $followed_user = User::whereIn("id", $followed_user_id)->get();
        
        return view("profile.show")->with([
            "profiled_user" => $profiled_user,
            "following_user" => $following_user,
            "followed_user" => $followed_user,
        ]);
    }
}
