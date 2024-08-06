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
        　      Routine
            </x-slot>
            
            <div class="routines">
                <div class="routine">
                        
                    @if ($routine->user->id == Auth::id())
                        <a class="user_name" href="{{ route('profile.edit') }}">{{ $routine->user->name }}</a>
                    @else
                        <a class="user_name" href="{{ route('user.show', ['user_id' => $routine->user->id ]) }}">{{ $routine->user->name }}</a>
                    @endif
                        
                    <p class="minutes">頑張った時間：{{ $routine->minutes }}分間</p>
                    <p class="body">{{ $routine->body }}</p>
                        
                    @if($routine->image_path != null)
                        <img class="img" src="{{ $routine->image_path }}" alt="画像が読み込みません。" />
                    @endif
                        
                        
                    @if ($routine->is_liked_by_auth_user())
                        <a href="{{ route('routine.unlike', ['routine_id' => $routine->id]) }}" >
                            いいね<span>{{ $routine->like_routines->count() }}</span>
                        </a>
                    @else
                        <a href="{{ route('routine.like', ['routine_id' => $routine->id]) }}" >
                            いいね<span>{{ $routine->like_routines->count() }}</span>
                        </a>
                    @endif
                
                        
                    <form action="{{ route('routine.comment.store', ['routine_id' => $routine->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="text" name="comment[comment]" placeholder="頑張れー！！"><br>
                        <input type="hidden" name="comment[routine_id]" value="{{ $routine->id }}">
                        <input type="hidden" name="comment[user_id]" value="{{ Auth::id() }}">
                        <input type="submit" value="コメントを送信" />
                    </form>
                    
                    
                    <p class="created_at" >{{ $routine->created_at }}に投稿</p>
                    
                    
                    @foreach ($routine->comment_routines as $comment)
                        <div class="mb-2">
                            <span>
                                <strong>
                                    <a class="no-text-decoration black-color" href="{{ route('user.show', ['user_id' => $comment->user->id]) }}">{{ $comment->user->name }}</a>
                                </strong>
                            </span>
                            <span>{{ $comment->comment }}</span>
                            
                            @if ($comment->user->id == Auth::id())
                                <a class="delete-comment" data-remote="true" rel="nofollow" data-method="delete" href="/comments/{{ $comment->id }}">
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