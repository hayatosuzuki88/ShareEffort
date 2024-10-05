<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>ShareEffort</title>
        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,600" />
        <link rel="stylesheet" href="{{ asset('/css/home.css') }}" />
        
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
                    <div class="routing_friends">
                        <a class="button11 prev_routing_button"><</a>
                    @if($my_today_routine->empty())
                        <a class="routing_friend">
                    @else
                        <a class="routing_friend" href="{{ route('routine.show', ['routine_id' => $my_today_routine->id ]) }}">
                    @endif
                            <div>    
                                <div class="user_image">
                                    <img class="routing_user_image" src='{{ Auth::User()->image_path }}' />
                                    <!--<p> Auth::User)->continue }}</p>-->
                                </div>
                                <p class="routing_user_name"> {{ Auth::User()->name }}</p>
                            </div>
                        </a>
                    
                        
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
                            <!-- ユーザ -->
                        @if ($post->user->id == Auth::id())
                        <a class="user" href="{{ route('profile.edit') }}">
                        @else
                        <a class="user" href="{{ route('user.show', ['user_id' => $post->user->id ]) }}">
                        @endif
                            <div class="user_image">
                                <img class="user_image" src="{{ $post->user->image_path }}" />
                            </div>
                            <p class="user_name" >　{{ $post->user->name }}</p>
                        </a>
                        
                        <!-- 達成したタスク -->
                        <p>{{ $post->task->name }}</p>
                        <h2 class="post_title">{{ $post->title }}</h2>
                        
                    </div>
                        
                    <!-- todo 要改善　レスポンシブデザイン用のヘッダー2段目 -->    
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
                                        <!-- フッター -->
                        <div class="post_footer">
                            <p>{{ $post->body }}</p>
                            <br/>
                        @if ($post->is_liked_by_auth_user())
                            <a href="{{ route('post.unlike', ['post_id' => $post->id]) }}" >
                                <img class="good" src="/images/gooded.webp"><span>{{ $post->like_posts->count() }}</span>
                            </a>
                        @else
                            <a href="{{ route('post.like', ['post_id' => $post->id]) }}" >
                                <img class="good" src="/images/good.webp"><span>{{ $post->like_posts->count() }}</span>
                            </a>
                        @endif
                    
                            <div class="comment">
                                <form class="comment_send" action="{{ route('post.comment.store', ['post_id' => $post->id ]) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                    <input type="text" name="comment[comment]" placeholder="頑張れー！！"><br>
                                    <input type="hidden" name="comment[post_id]" value="{{ $post->id }}">
                                    <input type="hidden" name="comment[user_id]" value="{{ Auth::id() }}">
                                    <input type="checkbox" name="comment[is_advice]" value="1">アドバイス
                                    <input class="button" type="submit" value="コメントを送信" />
                                </form>
                        
                                @foreach ($post->comment_posts as $comment)
                                <div class="mb-2 sent_comment">
                                    
                                <!-- コメントユーザ -->
                                    <div class="user_comment">
                                    @if ($post->user->id == Auth::id())
                                        <a class="user" href="{{ route('profile.edit') }}">
                                    @else
                                        <a class="user" href="{{ route('user.show', ['user_id' => $comment->user->id ]) }}">
                                    @endif
                                            <div class="user_image">
                                                <img class="user_image" src="{{ $comment->user->image_path }}" />
                                            </div>
                                            <p class="comment_user_name" >　{{ $comment->user->name }}</p>
                                        </a>
                                    </div>
                                    <span>　{{ $comment->comment }}</span>
                            
                                    @if ($comment->user->id == Auth::id())
                                    <a href="posts/comments/{{ $comment->id }}/like">　いいね</a>
                                    <a class="delete-comment" data-remote="true" rel="nofollow" data-method="delete" href="/posts/comments/{{ $comment->id }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                        </svg>
                                    </a>
                                    @endif
                            
                                </div>
                                @endforeach
                            </div>
                            
                            <p class="created_at" >{{ $post->created_at }}に投稿</p>
                            
                        </div>
                                </a>
                            </div>
                            </br>
                        
                        @endforeach
                    
                    @endif
                
                </div>
        
            </div>
        </x-app-layout>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src="js/home.js"></script>
    </body>
</html>