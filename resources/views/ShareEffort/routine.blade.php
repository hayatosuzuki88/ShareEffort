<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>ShareEffort</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <h1>ShareEffort</h1>
        <div class='routines'>
            <h2>Routines</h2>
            <div class='routine'>
                <h3 class='user_name'>{{ $routine->user_id }}</h3>
                <p class='minutes'>頑張った時間：{{ $routine->minutes }}分間</p>
                <p class='body'>{{ $routine->body }}</p>
                <img class='img' src='{{ $routine->image_path }}' />
                <p class='created_at' >{{ $routine->created_at }}に投稿</p>
            </div>
        </div>
    </body>
</html>