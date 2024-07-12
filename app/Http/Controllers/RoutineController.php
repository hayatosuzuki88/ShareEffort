<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Routine;
use Carbon\Carbon;

class RoutineController extends Controller
{
    //
    public function show(Routine $routine)
    {
        return view('ShareEffort.routine')->with(['routine' => $routine]);
    }
    
    public function home(Routine $routine)
    {
        $today_routine = Routine::whereDate('created_at', '<=', Carbon::today()->addDay())->get();
        return view('ShareEffort.home')->with(['routines' => $today_routine]);
    }
}
