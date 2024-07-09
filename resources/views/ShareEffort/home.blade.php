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
            <!--
            @foreach ($routines as $routine)
                <div class='routing_friend'>
                    <h3 class='user_name'>{{ $routine->user_id }}</h3>
                    <img class='img' src='{{ $routine->user_id->image_path }}' />
                </div>
            -->
        </div>
        <div class='tasks'>
            <h2>今日のタスク</h2>
            <!--
            @foreach
                <div class='goal'>
                    <h4 class='goal_name'>
                        
                    </h4>
                </div>
                @foreach
                    <div class='task'>
                        <h5 class='task_name'></h5>
                        <p class='achive button'></p>
                        <p class='time'></p>
                        <p class='content'></p>
                        <p class='comment'></p>
                    </div>
                <p>Share Effort</p>
            -->
        </div>
        <div class='shares'>
            <h2>友達を応援する</h2>
            <!--
            @foreach
                <div class='friend'>
                    
                </div>
                <div class='post'>
                    <div class='effort'>
                        @foreach
                            <div class='friend_task'>
                                <div
                            </div>
                    </div>
                </div>
            -->
        </div>
    </body>
</html>