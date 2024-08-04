<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\CommentPost;
use Auth;

class CommentPostController extends Controller
{
    //
    public function store(Request $request)
   {
       $comment = new CommentPost();
       $comment->comment = $request->comment;
       $comment->post_id = $request->post_id;
       $comment->user_id = Auth::user()->id;
       $comment->save();

       return redirect()->back();
   }

    public function destroy(Request $request)
    {
        $comment = CommentPost::find($request->comment_id);
        $comment->delete();
        return redirect()->back();
    }
}
