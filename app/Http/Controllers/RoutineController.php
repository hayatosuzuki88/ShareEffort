<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Routine;
use Carbon\Carbon;
use Cloudinary;
use Auth;

class RoutineController extends Controller
{
    //
    public function create(Routine $routine)
    {
        return view('Routine.create');
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
    
    public function home(Routine $routine)
    {
        $today_routine = Routine::whereDate('created_at', '>=', Carbon::today()->subDay())->get();
        return view('home')->with(['routines' => $today_routine]);
    }
}
