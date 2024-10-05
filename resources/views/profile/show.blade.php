<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>ShareEffort</title>
        <!-- Fonts -->
        <link rel="preload" href="https://fonts.googleapis.com/css?family=Nunito:200,600" as="style" onload="this.onload=null;this.rel='stylesheet'"/>
        <link rel="preload" href="/css/profile.css" as="style" onload="this.onload=null;this.rel='stylesheet'"/>
    </head>
    <body>
        <x-app-layout>
            
            <div class="user body">
                <div class="profile">
                    <img class="img" src="{{ $profiled_user->image_path }}" />
                    
                    <h3>{{ $profiled_user->name }}</h3>
                    
                    @if ($profiled_user->is_followed_by_auth_user())
                        <a class="button" href="{{ route('user.follow.remove', ['user_id' => $profiled_user->id]) }}" >フォローをやめる</a>
                    @else
                        <a class="button" href="{{ route('user.follow', ['user_id' => $profiled_user->id]) }}" >フォローする</a>
                    @endif
                    
                    <a>フォロワー：{{ $followed_user->count() }}</a>
                    @foreach($followed_user as $user)
                        <div class="friend">
                            <a class="user" href="{{ route('user.show', ['user_id' => $user->id ]) }}">
                                <div class="user_image">
                                    <img class="user_image" src="{{ $user->image_path }}" />
                                </div>
                                <p>{{ $user->name }}　</p>
                            </a>
                        @if ($user->is_followed_by_auth_user())
                            <a class="button" href="{{ route('user.follow.remove', ['user_id' => $user->id]) }}" >フォローをやめる</a>
                        @else
                            <a class="button" href="{{ route('user.follow', ['user_id' => $user->id]) }}" >フォローする</a>
                        @endif
                        </div>
                    @endforeach
                    <br/>
                    <a>フォロー中：{{ $following_user->count() }}</a>
                    @foreach($following_user as $user)
                        <div class="friend">
                            <a class="user" href="{{ route('user.show', ['user_id' => $user->id ]) }}">
                                <div class="user_image">
                                    <img class="user_image" src="{{ $user->image_path }}" />
                                </div>
                                <p>{{ $user->name }}　</p>
                            </a>
                        @if ($user->is_followed_by_auth_user())
                            <a class="button" href="{{ route('user.follow.remove', ['user_id' => $user->id]) }}" >フォローをやめる</a>
                        @else
                            <a class="button" href="{{ route('user.follow', ['user_id' => $user->id]) }}" >フォローする</a>
                        @endif
                        </div>
                    @endforeach
                </div>
            </div>
            
        </x-app-layout>
        
    </body>
</html>