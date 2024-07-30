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
            <x-slot name="header">
        　  （ヘッダー名）
            </x-slot>
            <h1>ShareEffort</h1>
            <div class='goals'>
                <h2>目標設定</h2>
                <div class='goal'>
                    <form action="/goals/post" method="POST" enctype="multipart/form-data">
                        @csrf
                        <p>あなたの目標は？？</p>
                        <input type="text" name="goal[goal]"/><br>
                        <p>いつまで？</p>
                        <input type="date" name="goal[date]"/><br>
                        <input type="submit" value="保存" />
                    </form>
                </div>
            </div>
        
        </x-app-layout>
    </body>
</html>