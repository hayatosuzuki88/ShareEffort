<?php

namespace App\Http\Controllers;

use App\Models\LikeRoutine;
use App\Models\Routine;
use Auth;
use Cloudinary;
use Illuminate\Http\Request;

class RoutineController extends Controller
{
    // ルーティン作成画面の表示
    public function create(Routine $routine)
    {
        return view('Routine.create');
    }

    // ルーティンの保存
    public function store(Request $request, Routine $routine)
    {
        // 投稿のポイント制度導入時の処理　廃止
        /*
        Auth::User()->point += 3;
        Auth::User()->save();
        */

        $input = $request['routine'];

        // 画像の保存
        if ($request->file('image') == NULL){
            $image_path = NULL;
        } else {
            $image_path = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
        }
        $input += ['image_path' => $image_path];

        $routine->fill($input)->save();

        return redirect(route('routine.show', ['routine_id' => $routine->id]));
    }

    // ルーティンの詳細画面の表示
    public function show($routine_id)
    {
        $routine = new Routine;
        $target_routine = $routine->find($routine_id);

        return view('Routine.show')->with(['routine' => $target_routine]);
    }

    // ルーティンの削除
    public function delete($routine_id)
    {
        // 投稿のポイント制度導入時の処理　廃止
        /*
        Auth::User()->point -= 3;
        Auth::User()->save();
        */

        $routine = new Routine;
        $target_routine = $routine->find($routine_id);
        $target_routine->delete();

        return redirect()->back();
    }

    // ルーティンのいいね
    public function like($routine_id)
    {
        // 投稿のポイント制度導入時の処理　廃止
        /*
        Auth::User()->point+=1;
        Auth::User()->save();
        */

        $like_routine = new LikeRoutine;
        $like_routine->create($routine_id, Auth::id());
        
        return redirect()->back();
    }

    // ルーティンのいいね取り消し
    public function unlike($routine_id)
    {
        // 投稿のポイント制度導入時の処理　廃止
        /*
        Auth::User()->point -= 1;
        Auth::User()->save();
        */

        $like_routine = new LikeRoutine;
        $like = $like_routine->getByRoutineAndUserId($routine_id, Auth::id()); 
        $like->delete();

        return redirect()->back();
    }
}
