<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Routine;
use App\Models\LikeRoutine;
use Cloudinary;
use Auth;

class RoutineController extends Controller
{
    
    public function create(Routine $routine)
    {
        return view("Routine.create");
    }
    
    public function store(Request $request, Routine $routine)
    {
        /*Auth::User()->point += 3;
        Auth::User()->save();*/
        
        $input = $request["routine"];
        if ($request->file("image") == null)
        {
            $image_path = null;
        } else {
            $image_path = Cloudinary::upload($request->file("image")->getRealPath())->getSecurePath();
        }
        
        $input += ["image_path" => $image_path];
        $routine->fill($input)->save();
        
        return redirect(route("routine.show", ["routine_id" => $routine->id]));
    }
    
    public function show($routine_id)
    {
        $routine = Routine::find($routine_id);
        return view("Routine.show")->with(["routine" => $routine]);
    }
    
    public function delete($routine_id)
    {
        /*Auth::User()->point -= 3;
        Auth::User()->save();*/
       
        $routine = Routine::find($routine_id);
        $routine->delete();
        return redirect("/");
    }
    
    public function like($routine_id)
    {
        /*Auth::User()->point+=1;
        Auth::User()->save();*/
        
        LikeRoutine::create([
            "routine_id" => $routine_id,
            "user_id" => Auth::id(),
            ]);
            
        return redirect()->back();
    }
    
        
    public function unlike($routine_id)
    {
        /*Auth::User()->point -= 1;
        Auth::User()->save();*/
        
        $like = LikeRoutine::where("routine_id", $routine_id)->where("user_id", Auth::id())->first();
        $like->delete();

        return redirect()->back();
    }
    
}
