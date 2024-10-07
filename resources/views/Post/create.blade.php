<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>ShareEffort</title>
        <!-- Fonts -->
        <link rel="preload" href="https://fonts.googleapis.com/css?family=Nunito:200,600" as="style" onload="this.onload=null;this.rel='stylesheet'"/>
        <link rel="preload" href="/css/post_create.css" as="style" onload="this.onload=null;this.rel='stylesheet'"/>

    </head>
    <body>
        <x-app-layout>
            <!-- 投稿作成画面 -->
            <div class="posts body">
                <h2>投稿作成</h2>
                <div class="posts">
                    <form id="form" action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <ul>
                            <li>*タイトル</li>
                            <input id="title" type="text" name="post[title]" required="required"/><br>
                            <p id="title-error" class="error">タイトルが入力されていません。</p>
                            
                            <li>本文</li>
                            <textarea name="post[body]" rows="3" cols="30" placeholder="今日も頑張ったー！！"></textarea>
                            
                            <li>*どのタスク？</li>
                            <!-- 達成したタスクの選択 -->
                            <select id="task" name="post[task_id]" required="required">
                                <option></option>
                                @foreach ($my_today_tasks as $task)
                                <option value="{{ $task->id }}">{{ $task->name }}</option>
                                @endforeach
                            
                            </select><br>
                            <p id="task-error" class="error">タスクが選択されていません。</p>
                            
                            <li>*何分頑張った？</li>
                            <input id="minutes" type="number" id="minutes_value" name="minutes" required="required" value="0" /><br>
                            <p id="minutes-error" class="error"></p>
                            
                            <li>*写真も載せよう！</li>
                            <input id="image" type="file" name="image" required="required"/><br>
                            <p id="image-error" class="error">写真が選択されていません。</p>
                            
                            <input type="hidden" name="post[user_id]" value="{{ Auth::id() }}"/>
                            
                        </ul>
                        <input type="submit" value="保存" />
                    </form>
                </div>
            </div>
            <!-- 投稿のプレビュー -->
            <div class="post">
                <div class="post_header">
                    <!-- ユーザ -->
                    <div class="user">
                        <div class="user_image">
                            <img class="user_image" src="{{ Auth::User()->image_path }}" />
                        </div>
                        <p>　{{ Auth::User()->name }}</p>
                    </div>
                    
                    <!-- 達成したタスク -->
                    <p>タスク：</p>
                    <h2 class="post_title"></h2>
                    
                </div>
                                    
                <img class="post_image" src="" alt="画像が読み込みません。" />
                
                <!-- 投稿時間 -->
                <div class="post_footer">
                    <p></p>
                    <p>{{ \Carbon\Carbon::now() }}に投稿</p>
                </div>
                
            </div>
            </br>
        
        </x-app-layout>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script defer src="/js/post_show.js"></script>
        <script defer src="/js/post_create.js"></script>
    </body>
</html>