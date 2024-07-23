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
        　      ShareEffort
            </x-slot>
            <h1>ShareEffort</h1>
            <div class='user'>
                <h2>User</h2>
                <div class='user'>
                    <h3>{{ $user->name }}</h3>
                    <img class='img' src='{{ $user->image_path }}' />
                    @if ($user->is_followed_by_auth_user())
                        <a href="{{ route('removefollow', ['id' => $user->id]) }}" >remove follow</a>
                    @else
                        <a href="{{ route('follow', ['id' => $user->id]) }}" >follow</a>
                    @endif
                </div>
            </div>
        </x-app-layout>
        
    </body>
</html>