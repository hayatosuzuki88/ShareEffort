<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CommentPost;
use Auth;

class CommentPostController extends Controller
{
    //
    public function store(Request $request, CommentPost $comment)
   {
       $input = $request["comment"];
       $comment->fill($input)->save();
       return redirect()->back();
   }

    public function destroy(Request $request)
    {
        $comment = CommentPost::find($request["comment_id"]);
        $comment->delete();
        return redirect()->back();
    }
}
