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
                {{-- フォローボタン --}}
                <p class="btn btn-primary" onclick="location.href='/{{ $user->id }}/following'"><a>フォロー</a></p>
                {{-- フォロー解除ボタン --}}
                {{-- <p class="btn btn-primary" onclick="location.href='/{{ $user->id }}/unfollow'"><a>フォロー解除</a></p> --}}
            </tr>
        @endforeach
    </div>
@endsection
