<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Goal;

use Auth;

class GoalController extends Controller
{
    //
    public function create(Goal $goal)
    {
        return view('Goal.Gcreate');
    }
    
    public function store(Request $request, Goal $goal)
    {
        $input = $request['goal'];
        $user_id = Auth::user()->id;
        $input += ['user_id' => $user_id];
        $goal->fill($input)->save();
        return redirect('/plans/create');
    }
}
