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
            <div class='plans'>
                <h2>投稿作成</h2>
                <div class='plan'>
                    <form action="/posts/post" method="POST" enctype="multipart/form-data">
                        @csrf
                        <p>タイトル</p>
                        <input type="text" name="post[title]"/><br>
                        <p>本文</p>
                        <input type="text" name="post[body]"/>
                        <p>どのタスク？</p>
                        <select name="post[task_id]">
                            <option></option>
                        @foreach ($tasks as $task)
                            <option value="{{ $task->id }}">{{ $task->name }}</option>
                        @endforeach
                        </select><br>
                        <p>写真も載せよう！</p>
                        <input type="file" name="image"/><br>
                        <input type="submit" value="保存" />
                    </form>
                </div>
            </div>
        
        </x-app-layout>
    </body>
</html>