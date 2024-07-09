<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Routine;

class RoutineController extends Controller
{
    //
    public function show(Routine $routine)
    {
        return view('ShareEffort.routine')->with(['routine' => $routine]);
    }
    
    public function home(Routine $routine)
    {
        return view('ShareEffort.home')->with(['Routine' => $routine->first()]);
    }
}
