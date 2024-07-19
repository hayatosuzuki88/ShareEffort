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
                                <!--<img class='img' src=' $routine->user->image_path }}' />-->
                            </a>
                        </div>
                    @endforeach
                @endif
            
            </div>
            <div class='tasks'>
                <h2>今日のタスク</h2>
                    <p>今日のタスクはありません。</p>
            <!--
            foreach
                <div class='goal'>
                    <h4 class='goal_name'>
                        
                    </h4>
                </div>
                foreach
                    <div class='task'>
                        <h5 class='task_name'></h5>
                        <p class='achive button'></p>
                        <p class='time'></p>
                        <p class='content'></p>
                        <p class='comment'></p>
                    </div>
                <p>Share Effort</p>
            -->
            </div>
            <div class='shares'>
                <h2>友達を応援する</h2>
                    <p>投稿がありません。</p>
            <!--
            foreach
                <div class='friend'>
                    
                </div>
                <div class='post'>
                    <div class='effort'>
                        foreach
                            <div class='friend_task'>
                                <div
                            </div>
                    </div>
                </div>
            -->
            </div>
        </x-app-layout>
        
    </body>
</html>