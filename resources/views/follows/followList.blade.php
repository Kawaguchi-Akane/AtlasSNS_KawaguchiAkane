@extends('layouts.login')

@section('content')
    {{-- フォロワーアイコン --}}
    @foreach ($followeds_users as $followed_user)
        {{-- $userから$followed_userを抽出 --}}
        <div>
            <img src=" {{ asset('storage/' . $followed_user->images) }}">
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
