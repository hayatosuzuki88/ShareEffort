<?php

namespace App\Http\Controllers;

use App\Models\CommentPost;
use Auth;
use Illuminate\Http\Request;

class CommentPostController extends Controller
{
    // コメントの保存
    public function store(Request $request, CommentPost $comment)
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

        $comment_post = new CommentPost;
        $comment = $comment_post->find($request['comment_id']);
        $comment->delete();

        return redirect()->back();
    }

    // コメントにいいね
    public function like($comment_id)
    {
        $comment_post = new CommentPost;
        $comment = $comment_post->find($comment_id);

        // 投稿のポイント制度導入時の処理　廃止
        /*
        if($comment->is_advise == 1) {
            $comment += 8;
        } else {
            $comment->user->point += 5;
        }
        */

        $comment->user->save();

        $comment->like += 1;
        $comment->save();

        return redirect()->back();
    }
}
