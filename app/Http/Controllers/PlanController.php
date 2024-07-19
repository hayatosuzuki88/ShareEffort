<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Plan;

use App\Models\Goal;

class PlanController extends Controller
{
    //
    
    public function create(Plan $plan)
    {
        $goals = Goal::where('achived', '=', 0)->get();
        return view('Plan.Pcreate')->with(['goals' => $goals]);
    }
    
    public function store(Request $request, Plan $plan)
    {
        $input = $request['plan'];
        $plan->fill($input)->save();
        return redirect('/home');
    }
    
}
