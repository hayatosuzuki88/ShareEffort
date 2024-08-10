<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>ShareEffort</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('/css/home.css') }}" />
    </head>
    <body>
        <x-app-layout>
            <div class="home">
            
                <!--現在の目標-->
                <div class="goals">
                    <h1 class="item">現在の目標</h1>
                    @if (count($my_goals)==0)
                        <p>今の目標はありません。</p>
                    @else
                        <div class="my_goals">
                        @foreach ($my_goals as $goal)
                            <div class="my_goal">
                                    <h2 class="goal_name"> {{ $goal->goal }} </h2>
                                    <p> {{ \Carbon\Carbon::parse($goal->date)->format('Y年m月d日') }} </p>
                                    @if ($goal->achived == 0)
                                        <p>未達成</p>
                                    @else
                                        <p>達成</p>
                                    @endif
                            </div>
                        @endforeach
                        </div>
                    @endif
                </div>
                </br>            
                
                <!--今日のタスク-->
                <div class="tasks">
                    <h1>今日のタスク</h1>
                    
                    @if (count($today_tasks)==0)
                        <p>今日のタスクはありません。</p>
                    @else
                
                        <div class="today_tasks">
                        @foreach($today_tasks as $task)
                            <div class="today_task">
                                <h2 class="task_name">{{ $task->name }}</h2>
                            
                                @if ($task->time != null)
                                    <p class="time">{{ $task->time }}分</p>
                                @endif
                            
                                @if ($task->finish == 0)
                                    <p class="achive button">未達成</p>
                                @else
                                    <p class="achive button">達成</p>
                                @endif
                            
                                <p class="content">{{ $task->todo }}</p>
                            </div>
                        @endforeach
                        </div>
                    
                    @endif
                
                </div>
                </br>
            
                <!--最近投稿されたROUTINE-->
                <div class="routines">
                    <h1>Routines</h1>
                    
                    @if (count($today_routines)==0)
                        <p>投稿がありません。</p>
                    @else
                        <div class="routing_friends">
                        @foreach ($today_routines as $routine)
                        
                            <a href="{{ route('routine.show', ['routine_id' => $routine->id ]) }}">
                                <div class="routing_friend">    
                                    <img class="routing_user_image" src="{{ $routine->user->image_path }}" />
                                    <p class="routing_user_name"> {{ $routine->user->name }}</p>
                                </div>
                        
                            </a>
                        @endforeach
                        </div>
                        
                    @endif
                </div>
                </br>

                <!--友達の投稿-->
                <div class="shares">
                    <h1>友達を応援する</h1>
                
                    @if (count($all_posts)==0)
                        <p>投稿がありません。</p>
                    @else
                
                        @foreach ($all_posts as $post)
                            <div class="post">
                                <a href="{{ route('post.show', ['post_id' => $post->id ]) }}">
                                    <div class="post_header">
                                        <div class="user">
                                            <img class="user_image" src="{{ $post->user->image_path }}" />
                                            <p>{{ $post->user->name }}</p>
                                        </div>
                                        <p>タスク：{{ $post->task->name }}</p>
                                        <h2 class="post_title">{{ $post->title }}</h2>
                                    </div>
                                
                                    @if($post->image_path != null)
                                        <img class="post_image" src="{{ $post->image_path }}" alt="画像が読み込みません。" />
                                    @endif
                                    <div class="post_footer">
                                        <p>{{ $post->body }}</p>
                                        <p>{{ $post->created_at }}に投稿</p>
                                    </div>
                                </a>
                            </div>
                            </br>
                        
                        @endforeach
                    
                    @endif
                
                </div>
        
            </div>
        </x-app-layout>
    </body>
</html>