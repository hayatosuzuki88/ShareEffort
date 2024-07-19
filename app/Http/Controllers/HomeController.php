<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Routine;
use App\Models\Goal;
use App\Models\Plan;
use Carbon\Carbon;
use Auth;

class HomeController extends Controller
{
    //
                                                    
    public function home(Routine $routine)
    {
        $goals = Goal::where('user_id', '=', Auth::user()->id)->get();
        $today_routine = Routine::whereDate('created_at', '>=', Carbon::today()->subDay())->get();
        return view('home')->with(['routines' => $today_routine, 'goals' => $goals]);
    }
}
