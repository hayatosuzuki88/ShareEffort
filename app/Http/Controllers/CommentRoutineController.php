<?php

namespace App\Http\Controllers;

use App\Models\CommentRoutine;
use Auth;
use Illuminate\Http\Request;

class CommentRoutineController extends Controller
{
    // コメントの保存
    public function store(Request $request, CommentRoutine $comment)
    {
        // 投稿のポイント制度導入時の処理　廃止
        /*
        Auth::User()->point += 1;
        Auth::User()->save();
        */

        $input = $request['comment'];
        $comment->fill($input)->save();

        return redirect()->back();
    }

    // コメントの削除
    public function destroy(Request $request)
    {
        // 投稿のポイント制度導入時の処理　廃止
        /*
        Auth::User()->point -= 1;
        Auth::User()->save();
        */

        $comment_routine = new CommentRoutine;
        $comment = $comment_routine->find($request['comment_id']);
        $comment->delete();

        return redirect()->back();
    }

    // コメントにいいね
    public function like($comment_id)
    {
        // 投稿のポイント制度導入時の処理　廃止
        /*
        $comment->user->point += 5;
        $comment->user->save();
        */

        $comment_routine = new CommentRoutine;
        $comment = $comment_routine->find($comment_id);
        $comment->like += 1;
        $comment->save();
    }
}
