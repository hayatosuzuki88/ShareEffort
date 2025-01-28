<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use App\Models\User;
use Auth;

class UserController extends Controller
{
    // ユーザをフォロー
    public function follow($friend_id)
    {
        $friend = new Friend;
        $friend->create($friend_id, Auth::id());

        return redirect()->back();
    }

    // ユーザのフォローを取り消し
    public function removeFollow($friend_id)
    {
        $friend = new Friend;
        $like = $friend->getByFriendAndUserId($friend_id, Auth::id()); 
        $like->delete();

        return redirect()->back();
    }

    // ユーザの詳細画面を表示
    public function show($user_id)
    {
        $user = new User;
        $profiled_user = $user->find($user_id);

        $following_user = $profiled_user->getFollowingUser();
        
        $followed_user = $profiled_user->getFollowedUser();

        return view('profile.show')->with([
            'profiled_user' => $profiled_user,
            'following_user' => $following_user,
            'followed_user' => $followed_user,
        ]);
    }
}
