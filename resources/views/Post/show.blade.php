<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>ShareEffort</title>
        <!-- Fonts -->
        <link rel="preload" href="https://fonts.googleapis.com/css?family=Nunito:200,600" as="style" onload="this.onload=null;this.rel='stylesheet'"/>
    
    </head>
    <body>
        <x-app-layout>
            <!-- 投稿詳細画面 -->
            <div id="wrap" class="sns routines">
                <article class="post">
                    <!-- 削除機能 -->
                    <form action="{{ route('post.delete', ['post_id' => $post->id ]) }}" id="form_{{ $post->id }}" method="post">
                        @csrf
                        @method("DELETE")
                        @if ($post->user->id == Auth::id())
                        <button type="button" onclick="deletePost({{ $post->id }})">×</button>
                        @endif
                    </form>
                    
                    <div class="post_header">
                        
                        <!-- ユーザ -->
                        @if ($post->user->id == Auth::id())
                        <a class="user" href="{{ route('profile.edit') }}">
                        @else
                        <a class="user" href="{{ route('user.show', ['user_id' => $post->user->id ]) }}">
                        @endif
                            <div class="user_image">
                                <img class="user_image" src="{{ $post->user->image_path }}" alt="ユーザ画像"/>
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
                        <img class="post_image" src="{{ $post->image_path }}" alt="投稿画像" />
                        <!-- ゴール -->
                        <div class="post_goal">
                            <h2 class="goal_name"> {{ $post->task->plan->goal->goal }} </h2>
                            <p> {{ \Carbon\Carbon::parse($post->task->plan->goal->date)->format('Y年m月d日') }} </p>
                            <p>あと<strong>{{ \Carbon\Carbon::parse($post->task->plan->goal->date)->diffInDays(\Carbon\Carbon::today()) }}日</strong></p>
                        </div>
                    @endif
                    
                        <div class="post_footer">
                            <p>{{ $post->body }}</p>
                            <br/>
                            
                        <!-- いいね機能 -->
                        @if ($post->is_liked_by_auth_user())
                            <a href="{{ route('post.unlike', ['post_id' => $post->id]) }}" >
                                <img class="good" src="{{ asset('/images/gooded.webp') }}" alt="いいね済"><span>{{ $post->like_posts->count() }}</span>
                            </a>
                        @else
                            <a href="{{ route('post.like', ['post_id' => $post->id]) }}" >
                                <img class="good" src="{{ asset('/images/good.webp') }}" alt="いいね未"><span>{{ $post->like_posts->count() }}</span>
                            </a>
                        @endif
                            
                            <!-- コメント機能 -->
                            <div class="comment">
                                <!-- コメント送信 -->
                                <form class="comment_send" action="{{ route('post.comment.store', ['post_id' => $post->id ]) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                    <input type="text" name="comment[comment]" placeholder="頑張れー！！"><br>
                                    <input type="hidden" name="comment[post_id]" value="{{ $post->id }}">
                                    <input type="hidden" name="comment[user_id]" value="{{ Auth::id() }}">
                                    <input type="checkbox" name="comment[is_advice]" value="1">アドバイス
                                    <input class="button" type="submit" value="コメントを送信" />
                                </form>
                        
                                <!-- コメント一覧 -->
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
                            
                            <small class="created_at" >{{ $post->created_at }}に投稿</small>
                            
                        </div>
                    </a>
                </article>
            </div>
            
            <footer>
                <small>by Hayato Suzuki</small>
            </footer>
        </x-app-layout>
        <script defer>
            function deletePost(id){
                'use strict'
                
                if (confirm('削除すると復元できません。\n本当に削除しますか？')){
                    document.getElementById(`form_${id}`).submit();
                }
            }
        </script>
    </body>
</html>