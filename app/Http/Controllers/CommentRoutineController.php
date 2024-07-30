<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\CommentRoutine;
use Auth;

class CommentRoutineController extends Controller
{

   public function store(Request $request)
   {
       $comment = new CommentRoutine();
       $comment->comment = $request->comment;
       $comment->routine_id = $request->routine_id;
       $comment->user_id = Auth::user()->id;
       $comment->save();

       return redirect()->back();
   }

    public function destroy(Request $request)
    {
        $comment = CommentRoutine::find($request->comment_id);
        $comment->delete();
        return redirect()->back();
    }
}

