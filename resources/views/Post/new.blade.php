<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>ShareEffort</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('/css/home.css') }}" />
        <script src="https://...jquery.min.js"></script>
    </head>
    <body>
        <x-app-layout>
            <div class="home body">
            
                @foreach ($all_posts as $post)
                    <div class="post">
                        <div class="post_header">
                        @if ($post->user->id == Auth::id())
                            <a class="user_name" href="{{ route('profile.edit') }}">
                        @else
                            <a class="user_name" href="{{ route('user.show', ['user_id' => $post->user->id ]) }}">
                        @endif
                            <div class="user">
                                <img class="user_image" src="{{ $post->user->image_path }}" />
                                <p>{{ $post->user->name }}</p>
                            </div>
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
                    
        
            </div>
        </x-app-layout>
        <script src="js/home.js"></script>
    </body>
</html>