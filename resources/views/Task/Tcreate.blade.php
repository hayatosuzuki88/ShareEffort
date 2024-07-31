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
                <h2>Task</h2>
                <div class='task'>
                    <div id="calendar" class="calendar-wrap">
                    </div>
                </div>
            </div>
        
        </x-app-layout>
    </body>
    <script src="{{ asset('js/calendar.js') }}"></script>
</html>