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
        <x-app-layout id="home">
            <!-- ホーム画面 -->
            <div id="wrap" class="clearfix">
                <div class="content">
                    <aside class="sidebar">
                        
                        <!-- 現在の目標↓ -->
                        <section class="goals" id="my_goals">
                            <h1>現在の目標</h1>
                            <div class="goal_content">
                            @if (count($my_goals)==0)
                            <!-- 目標がない -->
                                <p>今の目標はありません。</p>
                            @else
                            <!-- 目標がある -->
                                <div class="button-space">
                                    <a class="button11 prev_goal_button"><</a>
                                </div>
                                <div class="my_goals">
                                @foreach ($my_goals as $goal)
                                <!-- ゴールごとに処理 -->
                                    <div class="my_goal">
                                        <h2 class="goal_name"> {{ $goal->goal }} </h2>
                                        <ul>
                                            <li> {{ \Carbon\Carbon::parse($goal->date)->format('Y年m月d日') }} </li>
                                            <li>あと<strong>{{ \Carbon\Carbon::parse($goal->date)->diffInDays(\Carbon\Carbon::today()) }}日</strong></li>
                                            @if ($goal->achived == 0)
                                            <li>未達成</li>
                                            @else
                                            <li>達成</li>
                                            @endif
                                        </ul>
                                    </div>
                                @endforeach
                        
                                </div>
                                <div class="button-space">
                                    <a class=" button11 next_goal_button">></a>
                                </div>
                            
                            @endif
                            </div>
                        </section>
                        <!-- 現在の目標↑ -->
                
                
                        <!-- 今日のタスク↓ -->
                        <section class="tasks">
                            <h1>今日のタスク</h1>
                            <div class="task-content">
                            
                            @if (count($today_tasks)==0)
                            <!-- 今日のタスクがない -->
                                <p>今日のタスクはありません。</p>
                            @else
                            <!-- 今日のタスクがある -->
                                <div class="button-space">
                                    <a class="button11 prev_task_button"><</a>
                                </div>
                                <div class="today_tasks">
                                @foreach($today_tasks as $task)
                                <!-- タスクごとに処理 -->
                                    <a class="today_task" href="{{ route('post.create') }}">
                                        <div>
                                            <h2 class="task_name">{{ $task->name }}</h2>
                                            <ul>
                                            @if ($task->time != null)
                                                <li class="time">{{ $task->time }}分</li>
                                            @endif
                                
                                            @if ($task->finish == 0)
                                                <li>未達成</li>
                                            @else
                                                <li>達成</li>
                                            @endif
                                            </ul>
                                            <p class="content">{{ $task->todo }}</p>
                                        </div>
                                    </a>
                                @endforeach
                                </div>
                                <div class="button-space">
                                    <a class="button11 next_task_button">></a>
                                </div>
                            </div>
                            @endif
                        </section>
                        <!-- 今日のタスク↑ -->
                    </aside>
                    <div class="main">
                        
                        <!-- 最近投稿されたROUTINE↓ -->
                        <section class="home-routine">
                            <h1>Routines</h1>
                            <div class="routine-content">
                                <div class="routing_friends">
                                    <div class="button-space">
                                        <a class="button11 prev_routing_button"><</a>
                                    </div>
                                <!-- 自分のルーティン -->
                                @if($my_today_routine->empty())
                                    <!-- 自分のルーティンを投稿していない -->
                                    <a class="routing_friend">
                                @else
                                <!-- 自分のルーティンを投稿している -->
                                    <a class="routing_friend" href="{{ route('routine.show', ['routine_id' => $my_today_routine->id ]) }}">
                                @endif
                                        <div>    
                                            <div class="routing_user_image">
                                                <img class="routing_user_image" src='{{ Auth::User()->image_path }}' alt='ユーザ画像'/>
                                                <!--<p> Auth::User)->continue }}</p>-->
                                            </div>
                                            <p class="routing_user_name"> {{ Auth::User()->name }}</p>
                                        </div>
                                    </a>
                    
                                <!-- 友達のルーティン -->
                                    @foreach ($today_routines_of_friends as $routine)
                                        <!-- ルーティンごとに処理 -->
                                        <a class="routing_friend" href="{{ route('routine.show', ['routine_id' => $routine->id ]) }}">
                                            <div>    
                                                <div class="routing_user_image">
                                                    <img class="routing_user_image" src='{{ $routine->user->image_path }}' alt='ユーザ画像'/>
                                                    <p>{{ $routine->user->continue }}</p>
                                                </div>
                                                <p class="routing_user_name"> {{ $routine->user->name }}</p>
                                            </div>
                                        </a>
                                
                                    @endforeach
                                    
                                    <div class="button-space">
                                        <a class="button11 next_routing_button">></a>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <!-- 最近投稿されたROUTINE↑ -->
            

                        <!-- 友達の投稿↓ -->
                        <section class="shares">
                            <h1>友達を応援する</h1>
                
                            @if (count($posts_of_friends)==0)
                                <!-- 友達の投稿がない -->
                                <p>投稿がありません。</p>
                            @else
                                <!-- 友達の投稿がある -->
                
                                @foreach ($posts_of_friends as $post)
                                    <article class="post">
                                        <div class="post_header">
                                            <!-- ユーザ -->
                                            @if ($post->user->id == Auth::id())
                                                <!-- 投稿者がユーザ -->
                                            <a class="user" href="{{ route('profile.edit') }}">
                                            @else
                                                <!-- 投稿者がユーザ以外 -->
                                            <a class="user" href="{{ route('user.show', ['user_id' => $post->user->id ]) }}">
                                            @endif
                                                <div class="user_image">
                                                    <img class="user_image" src="{{ $post->user->image_path }}" alt='ユーザ画像'/>
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
                                    
                                        <!-- 投稿画像 -->
                                        <a class="image_post" href="{{ route('post.show', ['post_id' => $post->id ]) }}">
                                            @if($post->image_path != null)
                                            <img class="post_image" src="{{ $post->image_path }}" alt="投稿画像" />
                                            <div class="post_goal">
                                                <h2 class="goal_name"> {{ $post->task->plan->goal->goal }} </h2>
                                                <ul>
                                                    <li> {{ \Carbon\Carbon::parse($post->task->plan->goal->date)->format('Y年m月d日') }} </li>
                                                    <li>あと<strong>{{ \Carbon\Carbon::parse($post->task->plan->goal->date)->diffInDays(\Carbon\Carbon::today()) }}日</strong></li>
                                                </ul>
                                            </div>
                                            @endif
                                        
                                        <!-- フッター -->
                                            <div class="post_footer">
                                                <p>{{ $post->body }}</p>
                                            @if ($post->is_liked_by_auth_user())
                                                <a href="{{ route('post.unlike', ['post_id' => $post->id]) }}" >
                                                    <img class="good" src="{{ asset('/images/gooded.webp') }}" alt="いいね済"><span>{{ $post->like_posts->count() }}</span>
                                                </a>
                                            @else
                                                <a href="{{ route('post.like', ['post_id' => $post->id]) }}" >
                                                    <img class="good" src="{{ asset('/images/good.webp') }}" alt="いいね未"><span>{{ $post->like_posts->count() }}</span>
                                                </a>
                                            @endif
                                        
                                                <!-- コメント -->
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
                                                                    <img class="user_image" src="{{ $comment->user->image_path }}" alt="ユーザ画像"/>
                                                                </div>
                                                                <p class="comment_user_name" >{{ $comment->user->name }}</p>
                                                            </a>
                                                        </div>
                                                        <p>{{ $comment->comment }}</p>
                                
                                                        @if ($comment->user->id == Auth::id())
                                                        <a href="posts/comments/{{ $comment->id }}/like">いいね</a>
                                                        <a class="delete-comment" data-remote="true" rel="nofollow" data-method="delete" href="/posts/comments/{{ $comment->id }}">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                                                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                                            </svg>
                                                        </a>
                                                        @endif
                            
                                                    </div>
                                                @endforeach
                                                </div>
                                                <small class="created_at" >{{ $post->created_at }}に投稿</small>
                                            </div>
                                        </a>
                                    </article>
                
                        
                                @endforeach
                    
                            @endif
                
                        </section>
                        <!-- 友達の投稿↑ -->
                    </div>        
                </div>
            </div>
            <footer>
                <small>by Hayato Suzuki</small>
            </footer>
        </x-app-layout>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src="{{ asset('js/home.js') }}"></script>
    </body>
</html>