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
        　  （ヘッダー名）
            </x-slot>
            <h1>ShareEffort</h1>
            <div class='routines'>
                <h2>Routines</h2>
                <div class='routine'>
                    <form action="/routines/post" method="POST" enctype="multipart/form-data">
                        @csrf
                        <p>何分頑張った？</p>
                        <input type="number" name="routine[minutes]"/><br>
                        <p>コメントを残そう！！</p>
                        <textarea name="routine[body]" placeholder="今日も頑張ったー！！"></textarea><br>
                        <input type="file" name="image"><br>
                        <input type="submit" value="保存" />
                    </form>
                </div>
            </div>
        
        </x-app-layout>
    </body>
</html>