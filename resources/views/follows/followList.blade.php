@extends('layouts.login')

@section('content')
    {{-- フォローアイコン --}}
    @foreach ($followeds_users as $followed_user)
        {{-- $userから$followed_userを抽出 --}}
        <div>
            <a href="/profile/{{ $followed_user->id }}"><img src=" {{ asset('storage/' . $followed_user->images) }}"></a>
        </div>
    @endforeach
    {{-- フォローリスト --}}
    @foreach ($posts as $post)
        <div>
            <p>名前：{{ $post->user->username }}</p>
            <p>投稿内容：{{ $post->post }}</p>
            <p>{{ $post->updated_at }}</p>
        </div>
    @endforeach
@endsection
