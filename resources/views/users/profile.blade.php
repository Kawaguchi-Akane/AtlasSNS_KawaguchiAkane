@extends('layouts.login')

@section('content')
    @if (Auth::user()->images == null)
        <img src="image/icon1.png">
    @else
        <img src=" {{ asset('storage/images/' . Auth::user()->images) }}">
    @endif
    <p>ユーザー名 {{ $users->username }}</p>
    <p>自己紹介 {{ $users->bio }}</p>

    {{-- フォロー解除ボタン --}}
    @if (auth()->user()->isFollowing($users->id))
        <p class="btn unfollow_btn" onclick="location.href='/{{ $users->id }}/unfollow'"><a>フォロー解除</a></p>
    @else
        {{-- フォローボタン --}}
        <p class="btn follow_btn" onclick="location.href='/{{ $users->id }}/following'"><a>フォロー</a></p>
    @endif

    @foreach ($lists as $list)
        <a href="/profile/{{ $list->user_id }}"><img src="{{ asset('storage/' . $list->user->images) }}"></a>
        <tr>
            <td>{{ $list->user->username }}</td>
            <td>{{ $list->post }}</td>
            <td>{{ $list->updated_at }}</td>
        </tr>
    @endforeach
@endsection
