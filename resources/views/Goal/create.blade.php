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
            <!-- ゴールの作成画面 -->
            <div class="goals body">
                <h2>目標設定</h2>
                <div class="goal">
                    <form action="{{ route('goal.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <p>あなたの目標は？？</p>
                        <input type="text" name="goal[goal]" required="required"/><br>
                        <p>いつまで？</p>
                        <input type="date" name="goal[date]" required="required"/><br>
                        <input type="hidden" name="goal[user_id]" value="{{ Auth::id() }}"/>
                        <input type="submit" value="保存" />
                    </form>
                </div>
            </div>
        
        </x-app-layout>
    </body>
</html>