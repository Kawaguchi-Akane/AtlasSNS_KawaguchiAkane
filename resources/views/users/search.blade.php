@extends('layouts.login')

@section('content')
        <form action="/search" method="get">
        @csrf
        <input type="text" name="keyword" class="form" placeholder="ユーザ名">
        <button type="submit" class="btn btn-success">検索</button>
        </form>

        @foreach ($users as $user)
        <tr>
                <td>{{ $user->username }}</td>
        </tr>
@endforeach

@endsection
