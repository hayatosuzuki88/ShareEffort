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
                    <form action="{{ route('routine.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <p>何を頑張った？</p>
                        <input type="text" name="routine[name]" required="required"/><br>
                        <p>何分頑張った？</p>
                        <input type="number" name="routine[minutes]" required="required"/><br>
                        <p>コメントを残そう！！</p>
                        <textarea name="routine[body]" placeholder="今日も頑張ったー！！"></textarea><br>
                        <input type="file" name="image"><br>
                        <input type="hidden" name="routine[user_id]" value="{{ Auth::id() }}"/>
                        <input type="submit" value="保存" />
                    </form>
                </div>
            </div>
        
        </x-app-layout>
    </body>
</html>