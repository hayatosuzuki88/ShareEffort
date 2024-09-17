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
        Auth::User()->point += 1;
        Auth::User()->save();
       
        $input = $request["comment"];
        $comment->fill($input)->save();
        return redirect()->back();
   }

    public function destroy(Request $request)
    {
        Auth::User()->point -= 1;
        Auth::User()->save();
        
        $comment = CommentPost::find($request["comment_id"]);
        $comment->delete();
        return redirect()->back();
    }
    
    public function like($comment_id)
    {
        $comment = CommentPost::find($comment_id);
        if($comment->is_advise == 1) 
        {
            $comment += 8;
        } else {
            $comment->user->point += 5;
        }
        
        $comment->user->save();
        
        $comment->like = 1;
        $comment->save();
    }
}
