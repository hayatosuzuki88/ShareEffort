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
            <div class='routines'>
                <h2>Task</h2>
                <div class='routine'>
                    <form action="/tasks/post" method="POST" enctype="multipart/form-data">
                        @csrf
                        <p>作業概要</p>
                        <input type="text" name="plan[name]"/><br>
                        <p>いつからいつまで？</p>
                        <input type="date" name="plan[start]"/>
                        <input type="date" name="plan[finish]"/><br>
                        <p>かかる時間は？</p>
                        <input type="integer" name="plan[time]"/><br>
                        <p>どこからどこまで</p>
                        <input type="text" name="plan[range]"/><br>
                        <input type="submit" value="保存" />
                    </form>
                </div>
            </div>
        
        </x-app-layout>
    </body>
</html>