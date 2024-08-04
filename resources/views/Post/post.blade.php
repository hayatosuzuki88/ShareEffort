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
        　      ShareEffort
            </x-slot>
            <h1>ShareEffort</h1>
            <div class='routines'>
                <h2>Post</h2>
                    <div class='post'>
                        @if ($post->user->id == Auth::user()->id)
                            <a class='user_name' href="{{ route('profile.edit') }}">{{ $post->user->name }}</a>
                        @else
                            <a class='user_name' href="{{ route('user.show', ['id' => $post->user->id ]) }}">{{ $post->user->name }}</a>
                        @endif
                        <p class='body'>{{ $post->body }}</p>
                        <p class='task'>{{ $post->task->name }}</p>
                        <img class='img' src='{{ $post->image_path }}' alt="画像が読み込みません。" />
                        @if ($post->is_liked_by_auth_user())
                            <a href="{{ route('Punlike', ['id' => $post->id]) }}" >いいね<span>{{ $post->like_posts->count() }}</span></a>
                        @else
                            <a href="{{ route('Plike', ['id' => $post->id]) }}" >いいね<span>{{ $post->like_posts->count() }}</span></a>
                        @endif
                        <form action="/posts/{{ $post->id }}/comments" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="text" name="comment" placeholder="頑張れー！！"><br>
                            <input value="{{ $post->id }}" type="hidden" name="post_id">
                            <input value="{{ Auth::User()->id }}" type="hidden" name="user_id">
                            <input type="submit" value="コメントを送信" />
                        </form>
                        <p class='created_at' >{{ $post->created_at }}に投稿</p>
                        @foreach ($post->comment_posts as $comment)
                            <div class="mb-2">
                                <span>
                                    <strong>
                                        <a class="no-text-decoration black-color" href="{{ route('user.show', ['id' => $comment->user->id]) }}"> $comment->user->name }}</a>
                                    </strong>
                                </span>
                                <span> $comment->comment }}</span>
                                @if ($comment->user->id == Auth::id())
                                    <a class="delete-comment" data-remote="true" rel="nofollow" data-method="delete" href="/posts/comments/{{ $comment->id }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                        </svg>
                                    </a>
                                @endif
                            </div>
                        @endforeach

                    </div>
            </div>
        </x-app-layout>
        
    </body>
</html>