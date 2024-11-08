@extends('layouts.logout')

@section('content')
    <!-- 適切なURLを入力してください -->
    {!! Form::open() !!}

    <h2 class=tittle3>新規ユーザー登録</h2>

    <ul class="error-text">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>

    <div class=input-field-new>
        <div class=input-field-into>
            {{ Form::label('ユーザー名', null, ['class' => 'item']) }}
            {{ Form::text('username', null, ['class' => 'text-box']) }}
        </div>
        <div class=input-field-into>
            {{ Form::label('メールアドレス', null, ['class' => 'item']) }}
            {{ Form::text('mail', null, ['class' => 'text-box']) }}
        </div>
        <div class=input-field-into>
            {{ Form::label('パスワード', null, ['class' => 'item']) }}
            {{ Form::password('password', ['class' => 'text-box']) }}
        </div>
        <div class=input-field-into>
            {{ Form::label('パスワード確認', null, ['class' => 'item']) }}
            {{ Form::password('password_confirmation', ['class' => 'text-box']) }}
        </div>
    </div>

    <div align="center" class="button-login">
        {{ Form::submit('新規登録') }}
    </div>

    <p class=new-login><a href="/login">ログイン画面へ戻る</a></p>

    {!! Form::close() !!}
@endsection
