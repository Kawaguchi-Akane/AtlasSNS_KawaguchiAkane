@extends('layouts.logout')

@section('content')

<div id="clear">
  //セッションを利用して新規登録後の画面に登録したユーザ名を表示する
  <p>{{session('addname')}}さん</p>
  <p>ようこそ！AtlasSNSへ！</p>
  <p>ユーザー登録が完了しました。</p>
  <p>早速ログインをしてみましょう。</p>

  <p class="btn"><a href="/login">ログイン画面へ</a></p>
</div>

@endsection
