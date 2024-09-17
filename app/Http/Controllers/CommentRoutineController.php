<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CommentRoutine;
use Auth;

class CommentRoutineController extends Controller
{

   public function store(Request $request, CommentRoutine $comment)
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
        
        $comment = CommentRoutine::find($request["comment_id"]);
        $comment->delete();
        return redirect()->back();
    }
    
    public function like($comment_id)
    {
        $comment = CommentRoutine::find($comment_id);
        
        $comment->user->point += 5;
        $comment->user->save();
        
        $comment->like = 1;
        $comment->save();
    }
}

