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
        　      Post
            </x-slot>
            
            <div class="posts">
                <h2>投稿作成</h2>
                <div class="posts">
                    <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <p>タイトル</p>
                        <input type="text" name="post[title]" required="required"/><br>
                        <p>本文</p>
                        <input type="text" name="post[body]"/>
                        <p>どのタスク？</p>
                        <select name="post[task_id]" required="required">
                            <option></option>
                            
                            @foreach ($my_tasks as $task)
                                <option value="{{ $task->id }}">{{ $task->name }}</option>
                            @endforeach
                            
                        </select><br>
                        <p>写真も載せよう！</p>
                        <input type="file" name="image"/><br>
                        <input type="hidden" name="post[user_id]" value="{{ Auth::id() }}"/>
                        <input type="submit" value="保存" />
                    </form>
                </div>
            </div>
        
        </x-app-layout>
    </body>
</html>