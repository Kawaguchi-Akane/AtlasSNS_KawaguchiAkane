@extends('layouts.login')

@section('content')
    {{-- フォロワーアイコン --}}
    @foreach ($followings_users as $following_user)
        {{-- $userから$following_userを抽出 --}}
        <div>
            <a href="/profile/{{ $following_user->id }}"><img src=" {{ asset('storage/' . $following_user->images) }}"></a>
        </div>
    @endforeach
    {{-- フォロワーリスト --}}
    @foreach ($posts as $post)
        <div>
            <p>名前：{{ $post->user->username }}</p>
            <p>投稿内容：{{ $post->post }}</p>
            <p>{{ $post->updated_at }}</p>
        </div>
    @endforeach
@endsection
