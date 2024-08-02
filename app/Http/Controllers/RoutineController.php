<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Routine;
use App\Models\LikeRoutine;
use Cloudinary;
use Auth;

class RoutineController extends Controller
{
    //
    public function create(Routine $routine)
    {
        return view('Routine.Rcreate');
    }
    
    public function store(Request $request, Routine $routine)
    {
        $input = $request['routine'];
        $image_path = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
        $user_id = Auth::user()->id;
        $input += ['image_path' => $image_path];
        $input += ['user_id' => $user_id];
        $routine->fill($input)->save();
        return redirect('/routines/' . $routine->id);
    }
    
    public function show(Routine $routine)
    {
        return view('Routine.routine')->with(['routine' => $routine]);
    }
    
    public function like($id)
    {
        LikeRoutine::create([
            'routine_id' => $id,
            'user_id' => Auth::id(),
            ]);
            
        session()->flash('success', 'You Liked the Routine.');
        
        return redirect()->back();
    }
    
        
    public function unlike($id)
    {
        $like = LikeRoutine::where('routine_id', $id)->where('user_id', Auth::id())->first();
        $like->delete();
        
        session()->flash('success', 'You Unliked the Routine.');
        
        return redirect()->back();
    }
    
}
