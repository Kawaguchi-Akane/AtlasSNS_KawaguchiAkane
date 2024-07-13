@extends('layouts.login')

@section('content')
    <div class="container">
        <div class="update">
            {!! Form::open(['url' => '/profile/update', 'files' => true]) !!}
            @csrf
            {{ Form::hidden('id', Auth::user()->id) }}
            {{-- アイコン表示 --}}
            <div>
                <input type="image" name="images" value=""><img src="{{ asset('storage/' . Auth::user()->images) }}">
            </div>
            {{-- ユーザー名 --}}
            <div>
                <label class="profile-text" for="username">ユーザー名</label>
                <input id="username" type="text" class="form-name @error('username') is-invalid @enderror" name="username"
                    value="{{ old('username', Auth::user()->username) }}" required autocomplete="username" autofocus>
            </div>
            {{-- メールアドレス --}}
            <div>
                <label class="profile-text" for="mail">メールアドレス</label>
                <input id="mail" type="text" class="form-mail @error('mail') is-invalid @enderror" name="mail"
                    value="{{ old('mail', Auth::user()->mail) }}" required autocomplete="mail" autofocus>
            </div>
            {{-- パスワード --}}
            <div>
                <label class="profile-text" for="password">パスワード</label>
                <input type="password" nane="form-password @error('password') is-invalid @enderror" name="password"
                    value="">
            </div>
            {{-- パスワード確認 --}}
            <div>
                <label class="profile-text" for="password">パスワード確認</label>
                <input type="password" nane="password_confirmation @error('password_confirmation') is-invalid @enderror"
                    name="password_confirmation" value="">
            </div>
            {{-- 自己紹介 --}}
            <div>
                <label class="profile-bio" for="bio">自己紹介</label>
                <input id="bio" type="text" class="form-introduction @error('bio') is-invalid @enderror"
                    name="bio" value="{{ old('bio', Auth::user()->bio) }}">
            </div>
            {{-- アイコン画像 --}}
            <div>
                {{ Form::label('name', 'icon image', ['class' => 'label']) }}
                {{-- エラー文の表示 --}}
                @if ($errors->has('image'))
                    @foreach ($errors->get('image') as $message)
                        {{ $message }}<br>
                    @endforeach
                @endif
                <label class="from-control pro_file">
                    {{ Form::file('image', ['class' => 'file']) }}<p class="file_name">ファイルを選択</p>
                </label><br>
            </div>
            {{-- 更新ボタン --}}
            <div class="update-button">
                <form method="POST" action="/" enctype="multipart/form-data">
                    @csrf
                    <input type="submit" value="更新する"></input>
                </form>
            </div>
        </div>
    </div>
@endsection
