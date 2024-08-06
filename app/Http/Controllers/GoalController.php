<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Goal;
use Auth;

class GoalController extends Controller
{
    
    public function create(Goal $goal)
    {
        return view("Goal.create");
    }
    
    public function store(Request $request, Goal $goal)
    {
        $input = $request["goal"];
        $goal->fill($input)->save();
        return redirect(route("plan.create"));
    }
}
