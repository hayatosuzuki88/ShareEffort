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
        　      Home
            </x-slot>
            
            <!--現在の目標-->
            <div class="goals">
                <h1>今の目標</h1>
                @if (empty($my_goals))
                    <p>今の目標はありません。</p>
                @else
                    @foreach ($my_goals as $goal)
                        <div class="my_goals">
                                <h3 class="goal_name"> {{ $goal->goal }} </h3>
                                <p> {{ $goal->date }} </p>
                                @if ($goal->achived == 0)
                                    <p>未達成</p>
                                @else
                                    <p>達成</p>
                                @endif
                        <div>
                    @endforeach
                @endif
            </div>
            
            <!--最近投稿されたROUTINE-->
            <div class="routines">
                <h1>Routines</h1>
                
                @if (empty($today_routines))
                    <p>投稿がありません。</p>
                @else
                
                    @foreach ($today_routines as $routine)
                        <div class="routing_friend">
                            <a href="{{ route('routine.show', ['routine_id' => $routine->id ]) }}">
                                <h3 class="user_name"> {{ $routine->user->name }}</h3>
                                <img class="img" src="{{ $routine->user->image_path }}" />
                            </a>
                        </div>
                    @endforeach
                    
                @endif
            </div>
            
            <!--今日のタスク-->
            <div class="tasks">
                <h2>今日のタスク</h2>
                
                @if (empty($today_tasks))
                    <p>今日のタスクはありません。</p>
                @else
                
                    @foreach($today_tasks as $task)
                        <div class="task">
                            <h5 class="task_name">{{ $task->name }}</h5>
                            
                            @if ($task->finish == 0)
                                <p class="achive button">未達成</p>
                            @else
                                <p class="achive button">達成</p>
                            @endif
                            
                            <p class="time">{{ $task->time }}分</p>
                            <p class="content">{{ $task->todo }}</p>
                        </div>
                    @endforeach
                    
                @endif
                
            </div>
            
            <!--友達の投稿-->
            <div class="shares">
                <h2>友達を応援する</h2>
                
                @if (empty($all_posts))
                    <p>投稿がありません。</p>
                @else
                
                    @foreach ($all_posts as $post)
                        <div class="post">
                            <a href="{{ route('post.show', ['post_id' => $post->id ]) }}">
                                <h3 class="title">{{ $post->title }}</h3>
                                <p>{{ $post->body }}</p>
                                <p>{{ $post->task->name }}</p>
                                
                                @if($post->image_path != null)
                                <img class="img" src="{{ $post->image_path }}" alt="画像が読み込みません。" />
                                @endif
                                
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