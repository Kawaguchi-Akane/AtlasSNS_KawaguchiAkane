@extends('layouts.login')

@section('content')
    {{-- フォロワーアイコン --}}
    @foreach ($followings_users as $following_user)
        {{-- $userから$followed_userを抽出 --}}
        <div>
            <a href="/top">
                <img src=" {{ asset('storage/' . $following_user->images) }}">
            </a>
        </div>
    @endforeach
    {{-- フォロワーリスト --}}
    @foreach ($posts as $post)
        <div>
            <p>名前：{{ $post->user->username }}</p>
            <p>投稿内容：{{ $post->post }}</p>
        </div>
    @endforeach
@endsection
