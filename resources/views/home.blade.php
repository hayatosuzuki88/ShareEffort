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
        　 
            </x-slot>
            <h1>ShareEffort</h1>
            <div class='routines'>
                <h2>今の目標</h2>
                @if (count($goals) == 0)
                    <p>今の目標はありません。</p>
                @else
                    @foreach ($goals as $goal)
                        <div class='my_goals'>
                                <h3 class='goal_name'> {{ $goal->goal }} </h3>
                                <p> {{ $goal->date }} </p>
                                @if ($goal->achived == 0)
                                    <p>未達成</p>
                                @else
                                    <p>達成</p>
                                @endif
                        <div>
                    @endforeach
                @endif
                <h2>Routines</h2>
                @if (count($routines) == 0)
                    <p>投稿がありません。</p>
                @else
                    @foreach ($routines as $routine)
                        <div class='routing_friend'>
                            <a href="/routines/{{ $routine->id }}">
                                <h3 class='user_name'> {{ $routine->user->name }}</h3>
                                <img class='img' src='{{ $routine->user->image_path }}' />
                            </a>
                        </div>
                    @endforeach
                @endif
            
            </div>
            <div class='tasks'>
                <h2>今日のタスク</h2>
                @if (count($today_tasks) == 0)
                    <p>今日のタスクはありません。</p>
                @else
                    @foreach($today_tasks as $task)
                        <div class='task'>
                            <h5 class='task_name'>{{ $task->name }}</h5>
                            @if ($task->finish == 0)
                                <p class='achive button'>未達成</p>
                            @else
                                <p class='achive button'>達成</p>
                            @endif
                            <p class='time'>{{ $task->time }}分</p>
                            <p class='content'>{{ $task->todo }}</p>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class='shares'>
                <h2>友達を応援する</h2>
                @if (count($posts) == 0)
                    <p>投稿がありません。</p>
                @else
                    @foreach ($posts as $post)
                        <div class='post'>
                            <a href='/posts/{{ $post->id }}'>
                                <h3 class='title'>{{ $post->title }}</h3>
                                <p>{{ $post->body }}</p>
                                <p>{{ $post->task->name }}</p>
                                <img class='img' src='{{ $post->image_path }}' alt="画像が読み込みません。" />
                                <p>{{ $post->user->name }}</p>
                                <p>{{ $post->created_at }}</p>
                            </a>
                        </div>
                    @endforeach
                @endif
            </div>
        </x-app-layout>
        
    </body>
</html>