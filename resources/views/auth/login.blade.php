@extends('layouts.logout')

@section('content')
    <!-- 適切なURLを入力してください -->
    <div class=main>
        {!! Form::open(['url' => '/login']) !!}
        <p class=tittle3>AtlasSNSへようこそ</p>


        <div class=input-field>
            <div class=input-field-into>
                {{ Form::label('メールアドレス', null, ['class' => 'item']) }}<br></br>
                {{ Form::text('mail', null, ['class' => 'text-box']) }}<br></br>
            </div>
            <div class=input-field-into>
                {{ Form::label('パスワード', null, ['class' => 'item']) }}<br></br>
                {{ Form::password('password', ['class' => 'text-box']) }}
            </div>
        </div>
        <div align="center" class="button-login">
            {{ Form::submit('ログイン') }}
        </div>


        <p class=new-login><a href="/register">新規ユーザーの方はこちら</a></p>
        {!! Form::close() !!}
    </div>
@endsection
