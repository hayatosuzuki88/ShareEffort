<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>ShareEffort</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <x-app-layout>
            
            <div class="plans">
                <h2>プランの作成</h2>
                <div class="plan">
                    <form action="{{ route('plan.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <p>作業概要</p>
                        <input type="text" name="plan[name]" required="required"/><br>
                        <p>いつからいつまで？</p>
                        <input type="date" name="plan[start]" required="required"/>
                        <input type="date" name="plan[end]" required="required"/><br>
                        <p>かかる時間は？</p>
                        <input type="integer" name="plan[duration]"/><br>
                        <p>どこからどこまで</p>
                        <input type="text" name="plan[range]"/><br>
                        <p>何時に取り組む？</p>
                        <input type="time" name="plan[routine_time]"/><br>
                        <p>何日ごと？</p>
                        <input type="integer" name="plan[interval]" required="required"/><br>
                        <p>どのゴールのため？？</p>
                        <select name="plan[goal_id]" required="required">
                            <option></option>
                            
                            @foreach ($not_achived_goals_of_mine as $goal)
                                <option value="{{ $goal->id }}">{{ $goal->goal }}</option>
                            @endforeach
                            
                        </select><br>
                        <input type="submit" value="保存" />
                    </form>
                </div>
            </div>
        
        </x-app-layout>
    </body>
</html>