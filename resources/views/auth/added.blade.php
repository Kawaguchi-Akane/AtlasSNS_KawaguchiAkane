@extends('layouts.logout')

@section('content')
    <p class=clear1>{{ session('username') }}さん</p>
    <p class=clear2>ようこそ！AtlasSNSへ</p>
    <p class=clear3>ユーザー登録が完了しました。</p>
    <p class=clear4>早速ログインをしてみましょう。</p>

    <div align="center" class="button-login-2">
        <p><a href="/login">ログイン画面へ</a></p>
    </div>
@endsection
