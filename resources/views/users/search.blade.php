@extends('layouts.login')

@section('content')
    <form action="/search" method="get">
        @csrf
        <input type="text" name="keyword" class="form" placeholder="ユーザ名">
        <button type="submit" class="btn btn-success">検索</button>
    </form>

    @if (!empty($keyword))
        <p>検索ワード：{{ $keyword }}</p>
    @else
        <td></td>
    @endif
    <div class=search-result>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->username }}</td>
                {{-- フォロー解除ボタン --}}
                @if (auth()->user()->isFollowing($user->id))
                    <p class="btn unfollow_btn" onclick="location.href='/{{ $user->id }}/unfollow'"><a>フォロー解除</a></p>
                @else
                    {{-- フォローボタン --}}
                    <p class="btn follow_btn" onclick="location.href='/{{ $user->id }}/following'"><a>フォロー</a></p>
                @endif
            </tr>
        @endforeach
    </div>
@endsection
