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
            <div class="routines body">
                <div class="routine">
                    <form id="routine_form" action="{{ route('routine.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <p>何を頑張った？</p>
                        <input type="text" name="routine[name]" required="required"/><br>
                        <p>何分頑張った？</p>
                        <input type="number" id="minutes_value" name="routine[minutes]" required="required" value="0" /><br>
                        <p>コメントを残そう！！</p>
                        <textarea id="body_value" name="routine[body]" rows="3" cols="30" placeholder="今日も頑張ったー！！"></textarea><br>
                        <input type="file" id="input" name="image"><br>
                        <input type="hidden" name="routine[user_id]" value="{{ Auth::id() }}"/>
                        <input type="submit" value="保存" />
                    </form>
                </div>
            </div>
            
            <div class="routines">
                <div class="routine">
                        
                    <!-- ユーザ -->
                    <div class="user">
                        <div class="user_image">
                            <img class="user_image" src="{{ Auth::User()->image_path }}" />
                        </div>
                        <p>　{{ Auth::User()->name }}</p>
                    </div>
                        
                    <p id="minutes">頑張った時間：0分間</p>
                    <p id="body"></p>
                    
                    <img class="img" id="img" src="" alt="画像が読み込みません。" />
                    <div class="preview"></div>
                    <input type="text" name="comment[comment]" placeholder="頑張れー！！"><br>
                    <input type="submit" value="コメントを送信" />
                    
                    
                    <p class="created_at" >{{ \Carbon\Carbon::now() }}に投稿</p>
                    
                    
                    
                </div>
            </div>
        
        </x-app-layout>
        <script defer src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script defer src="\js\routine_show.js"></script>
    </body>
</html>