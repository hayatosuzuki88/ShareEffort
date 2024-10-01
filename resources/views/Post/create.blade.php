<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>ShareEffort</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <script src="https://...jquery.min.js"></script>
    </head>
    <body>
        <x-app-layout>
            <!-- 投稿作成画面 -->
            <div class="posts body">
                <h2>投稿作成</h2>
                <div class="posts">
                    <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <p>タイトル</p>
                        <input type="text" name="post[title]" required="required"/><br>
                        <p>本文</p>
                        <input type="text" name="post[body]"/>
                        <p>どのタスク？</p>
                        <!-- 達成したタスクの選択 -->
                        <select name="post[task_id]" required="required">
                            <option></option>
                            
                            @foreach ($my_today_tasks as $task)
                            <option value="{{ $task->id }}">{{ $task->name }}</option>
                            @endforeach
                            
                        </select><br>
                        <p>何分頑張った？</p>
                        <input type="number" id="minutes_value" name="minutes" required="required" value="0" /><br>
                        <p>写真も載せよう！</p>
                        <input type="file" name="image"/><br>
                        <input type="hidden" name="post[user_id]" value="{{ Auth::id() }}"/>
                        <input type="submit" value="保存" />
                    </form>
                </div>
            </div>
            <!-- 投稿のプレビュー -->
            <div class="post">
                <div class="post_header">
                    <!-- ユーザ -->
                    <div class="user">
                        <img class="user_image" src="{{ Auth::User()->image_path }}" />
                        <p>{{ Auth::User()->name }}</p>
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
        <script src="/js/post_show.js"></script>
    </body>
</html>