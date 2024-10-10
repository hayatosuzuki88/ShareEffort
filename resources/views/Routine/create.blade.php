<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>ShareEffort</title>
        <!-- Fonts -->
        <link rel="preload" href="https://fonts.googleapis.com/css?family=Nunito:200,600" as="style" onload="this.onload=null;this.rel='stylesheet'"/>
        <link rel="preload" href="/css/routine_create.css" as="style" onload="this.onload=null;this.rel='stylesheet'"/>

    </head>
    <body>
        <x-app-layout>
            <!-- ROUTINE作成画面 -->
            <div class="routines body">
                <!-- 入力フォーム -->
                <form id="routine_form" action="{{ route('routine.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <h2>ROUTINE作成</h2>
                    <ul>
                        <li>*何を頑張った？</li>
                        <input id="title_value" type="text" name="routine[name]" required="required"/><br>
                        <p id="title-error" class="error">タイトルが入力されていません。</p>
                            
                        <li>コメントを残そう！！</li>
                        <textarea id="body_value" name="routine[body]" rows="3" cols="30" placeholder="今日も頑張ったー！！"></textarea><br>
                            
                        <li>何分頑張った？</li>
                        <input type="number" id="minutes_value" name="routine[minutes]" /><br>
                        <p id="minutes-error" class="error">数字を入力してください。</p>
                            
                        <li>画像を選択</li>
                        <input type="file" id="image" name="image"><br>
                            
                        <input type="hidden" name="routine[user_id]" value="{{ Auth::id() }}"/>
                    </ul>
                    <input type="submit" value="保存" />
                </form>
                <br/>
                <br/>
                
                <!-- プレビュー画面 -->
                <div class="routine">
                    <div class="routine-container">
                        <img class="img" id="preview"/>
                        <div class="routine-header">
                            
                            <!-- ユーザ -->
                            <div class="user">
                                <div class="user_image">
                                    <img class="user_image" src="{{ Auth::User()->image_path }}" />
                                </div>
                                <strong class="user_name">　{{ Auth::User()->name }}</strong>
                            </div>
                            
                            <h2 id="title"></h2>
                        </div>
                        <div class="details">
                            <strong id="minutes">頑張った時間：0分間</strong>
                            <p id="body"></p>
                        </div>
                    </div>
                    <br/>
                    <div class="routine-footer">
                        <img class="good" src="/images/gooded.webp"><span>100</span>
                        <input type="text" name="comment[comment]" placeholder="頑張れー！！"><br>
                        <input type="submit" value="コメントを送信" />
                        <p class="created_at" >{{ \Carbon\Carbon::now() }}に投稿</p>
                    </div> 
                    
                </div>
            
            </div>
        </x-app-layout>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script defer src="\js\routine_show.js"></script>
        <script defer src="\js\routine_create.js"></script>
    </body>
</html>