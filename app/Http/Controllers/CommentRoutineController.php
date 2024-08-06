<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CommentRoutine;
use Auth;

class CommentRoutineController extends Controller
{

   public function store(Request $request, CommentRoutine $comment)
   {
       $input = $request["comment"];
       $comment->fill($input)->save();
       return redirect()->back();
   }

    public function destroy(Request $request)
    {
        $comment = CommentRoutine::find($request["comment_id"]);
        $comment->delete();
        return redirect()->back();
    }
}

