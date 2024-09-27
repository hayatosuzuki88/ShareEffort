<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>ShareEffort</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('/css/home.css') }}" />
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    </head>
    <body>
        <x-app-layout>
            <div class="home body">
            
                <!--現在の目標-->
                <div class="goals" id="my_goals">
                    <h1>現在の目標</h1>
                    @if (count($my_goals)==0)
                        <p>今の目標はありません。</p>
                    @else
                        <div class="my_goals">
                            <a class="button11 prev_goal_button"><</a>
                        @foreach ($my_goals as $goal)
                            <div class="my_goal">
                                    <h2 class="goal_name"> {{ $goal->goal }} </h2>
                                    <p> {{ \Carbon\Carbon::parse($goal->date)->format('Y年m月d日') }} </p>
                                    <p>あと<strong>{{ \Carbon\Carbon::parse($goal->date)->diffInDays(\Carbon\Carbon::today()) }}日</strong></p>
                                    @if ($goal->achived == 0)
                                        <p>未達成</p>
                                    @else
                                        <p>達成</p>
                                    @endif
                            </div>
                        @endforeach
                        
                            <a class=" button11 next_goal_button">></a>
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
                            <a class="button11 prev_task_button"><</a>
                        @foreach($today_tasks as $task)
                            <a class="today_task" href="{{ route('post.create') }}">
                                <div>
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
                            </a>
                        @endforeach
                        <a class="button11 next_task_button">></a>
                        </div>
                    
                    @endif
                
                </div>
                </br>
            
                <!--最近投稿されたROUTINE-->
                <div class="home-routine">
                    <h1>Routines</h1>
                    
                    @if (count($today_routines_of_friends)==0)
                        <p>投稿がありません。</p>
                    @else
                        <div class="routing_friends">
                            <a class="button11 prev_routing_button"><</a>
                        @foreach ($today_routines_of_friends as $routine)
                        
                            <a class="routing_friend" href="{{ route('routine.show', ['routine_id' => $routine->id ]) }}">
                                <div>    
                                    <div class="user_image">
                                        <img class="routing_user_image" src='{{ $routine->user->image_path }}' />
                                        <p>{{ $routine->user->continue }}</p>
                                    </div>
                                    <p class="routing_user_name"> {{ $routine->user->name }}</p>
                                </div>
                            </a>
                            
                        @endforeach
                            <a class="button11 next_routing_button">></a>
                        </div>
                        
                    @endif
                </div>
                </br>

                <!--友達の投稿-->
                <div class="shares">
                    <h1>友達を応援する</h1>
                
                    @if (count($posts_of_friends)==0)
                        <p>投稿がありません。</p>
                    @else
                
                        @foreach ($posts_of_friends as $post)
                            <div class="post">
                                <div class="post_header">
                                    @if ($post->user->id == Auth::id())
                                    <a class="post_user" href="{{ route('profile.edit') }}">
                                    @else
                                    <a class="post_user" href="{{ route('user.show', ['user_id' => $post->user->id ]) }}">
                                    @endif
                                        
                                        <div class="user_image">
                                            <img  src='{{ $post->user->image_path }}' />
                                            <p>{{ $post->user->continue }}</p>
                                        </div>
                                        <p class="user_name" >{{ $post->user->name }}</p>
                    
                                    </a>
                                    <p>タスク：{{ $post->task->name }}</p>
                                    <h2 class="post_title">{{ $post->title }}</h2>
                                </div>
                                <div class="post_header2">
                                    <h2 class="post_title2">{{ $post->title }}</h2>
                                </div>
                                    
                                <a class="image_post" href="{{ route('post.show', ['post_id' => $post->id ]) }}">
                                    @if($post->image_path != null)
                                        <img class="post_image" src="{{ $post->image_path }}" alt="画像が読み込みません。" />
                                        <div class="post_goal">
                                            <h2 class="goal_name"> {{ $post->task->plan->goal->goal }} </h2>
                                            <p> {{ \Carbon\Carbon::parse($post->task->plan->goal->date)->format('Y年m月d日') }} </p>
                                            <p>あと<strong>{{ \Carbon\Carbon::parse($post->task->plan->goal->date)->diffInDays(\Carbon\Carbon::today()) }}日</strong></p>
                                        </div>
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
        <script src="js/home.js"></script>
        <script>
            $(function(){
                let display_size = 0;
                if (window.matchMedia('(max-width: 768px)').matches) {
                    //スマホ処理
                    display_size = 1;
                } else if (window.matchMedia('(max-width: 1200px)').matches) {
                
                    display_size = 2;
                } else {
                    //PC処理
                    display_size = 4;
                }
                
                const my_goal_size = $('.my_goal').length;
                for(let i=0;i<my_goal_size && i<display_size;i++){
                    $('.my_goal').eq(i).addClass('goal_active');
                }
                
                if (my_goal_size < display_size){
                    $('.next_goal_button').css('display', 'none');
                }
                if (my_goal_size==0){
                    $('.next_goal_button').css('display', 'none');
                    $('.prev_goal_button').css('display', 'none');
                }

                
                $('.next_goal_button').click(function(){
                    $('.goal_active').eq(display_size-1).next().addClass('goal_active');
                    $('.goal_active').eq(0).removeClass('goal_active');
                    
                    if($('.my_goal').eq(my_goal_size-1).hasClass('goal_active')){
                        $('.next_goal_button').css('display', 'none');
                    }
                    if(!$('.my_goal').eq(0).hasClass('goal_active')){
                        $('.prev_goal_button').css('display', 'block');
                    }
                });
                
                $('.prev_goal_button').click(function(){
                    $('.goal_active').eq(0).prev().addClass('goal_active');
                    $('.goal_active').eq(display_size).removeClass('goal_active');
                    
                    if($('.my_goal').eq(0).hasClass('goal_active')){
                        $('.prev_goal_button').css('display', 'none');
                    }
                    if(!$('.my_goal').eq(my_goal_size-1).hasClass('goal_active')){
                        $('.next_goal_button').css('display', 'block');
                    }
                });
                
                
                const today_task_size = $('.today_task').length;
                for(let i=0;i<today_task_size && i<display_size;i++){
                    $('.today_task').eq(i).addClass('task_active');
                }
                
                if (today_task_size < display_size){
                    $('.next_task_button').css('display', 'none');
                }
                if (today_task_size==0){
                    $('.next_task_button').css('display', 'none');
                    $('.prev_task_button').css('display', 'none');
                }

                
                $('.next_task_button').click(function(){
                    $('.task_active').eq(display_size-1).next().addClass('task_active');
                    $('.task_active').eq(0).removeClass('task_active');
                    
                    if($('.today_task').eq(today_task_size-1).hasClass('task_active')){
                        $('.next_task_button').css('display', 'none');
                    }
                    if(!$('.today_task').eq(0).hasClass('task_active')){
                        $('.prev_task_button').css('display', 'block');
                    }
                });
                
                $('.prev_task_button').click(function(){
                    $('.task_active').eq(0).prev().addClass('task_active');
                    $('.task_active').eq(display_size).removeClass('task_active');
                    
                    if($('.today_task').eq(0).hasClass('task_active')){
                        $('.prev_task_button').css('display', 'none');
                    }
                    if(!$('.today_task').eq(today_task_size-1).hasClass('task_active')){
                        $('.next_task_button').css('display', 'block')
                    }
                });
                
                
                
                const routing_friend_size = $('.routing_friend').length;
                for(let i=0;i<routing_friend_size && i<display_size;i++){
                    $('.routing_friend').eq(i).addClass('routing_active');
                }
                
                if (routing_friend_size < display_size){
                    $('.next_routing_button').css('display', 'none');
                }
                if (routing_friend_size==0){
                    $('.next_routing_button').css('display', 'none');
                    $('.prev_routing_button').css('display', 'none');
                }

                
                $('.next_routing_button').click(function(){
                    $('.routing_active').eq(display_size-1).next().addClass('routing_active');
                    $('.routing_active').eq(0).removeClass('routing_active');
                    
                    if($('.routing_task').eq(routing_friend_size-1).hasClass('routing_active')){
                        $('.next_routing_button').css('display', 'none');
                    }
                    if(!$('.routing_friend').eq(0).hasClass('routing_active')){
                        $('.prev_routing_button').css('display', 'block');
                    }
                });
                
                $('.prev_routing_button').click(function(){
                    $('.routing_active').eq(0).prev().addClass('routing_active');
                    $('.routing_active').eq(display_size).removeClass('routing_active');
                    
                    if($('.routing_task').eq(0).hasClass('routing_active')){
                        $('.prev_routing_button').css('display', 'none');
                    }
                    if(!$('.routing_friend').eq(routing_friend_size-1).hasClass('routing_active')){
                        $('.next_routing_button').css('display', 'block')
                    }
                });
            });
        </script>
    </body>
</html>