@extends('layouts.login')

@section('content')
    <div class="container">

        {!! Form::open(['url' => '/post/create']) !!}
        {{ Form::token() }}
        <div class="form-group">
            {{-- アイコン画像を表示させる --}}
            <input type="image" name="images" value=""><img src="{{ asset('storage/' . Auth::user()->images) }}">
            {{ Form::input('text', 'newPost', null, ['class' => 'form-control', 'placeholder' => '投稿内容を入力してください']) }}
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <button type="submit" class="btn btn-success pull-right"><img src="images/post.png" alt="送信"></button>
        {!! Form::close() !!}
    </div>
    <div>
        @foreach ($list as $list)
            <tr>
                <td>{{ $list->user->username }}</td>
                <td>{{ $list->post }}</td>
                <td>{{ $list->create_at }}</td>
            </tr>

    </div>
    <div class="content">
        <!-- 投稿の編集ボタン -->
        <a class="js-modal-open" href="images/edit.png" post="{{ $list->post }}" post_id="{{ $list->id }}"><img
                src="images/edit.png" alt=編集></a>
        <!-- 投稿の削除ボタン -->
        <a class="btn btn-delete" href="/post/{{ $list->id }}/delete"
            onclick="return confirm('こちらの投稿を削除してもよろしいでしょうか？')"><img src="images/trash.png" alt=削除></a>
    </div>
    <!-- モーダルの中身 -->
    <div class="modal js-modal">
        <div class="modal__bg js-modal-close"></div>
        <div class="modal__content">
            <form action="/post/update" method="post">
                <textarea name="post_update" class="modal_post"></textarea>
                <input type="hidden" name="user_id" class="modal_id" value="">
                <input type="submit" value="更新">
                {{ csrf_field() }}
            </form>
            <a class="js-modal-close" href="">閉じる</a>
        </div>
    </div>
    @endforeach
@endsection
