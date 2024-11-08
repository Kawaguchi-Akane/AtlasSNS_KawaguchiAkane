<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <!--IEブラウザ対策-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="ページの内容を表す文章" />
    <title></title>
    <link rel="stylesheet" href="{{ asset('css/reset.css') }} ">
    <link rel="stylesheet" href="{{ asset('css/style.css') }} ">
    <!--スマホ,タブレット対応-->
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <!--サイトのアイコン指定-->
    <link rel="icon" href="画像URL" sizes="16x16" type="image/png" />
    <link rel="icon" href="画像URL" sizes="32x32" type="image/png" />
    <link rel="icon" href="画像URL" sizes="48x48" type="image/png" />
    <link rel="icon" href="画像URL" sizes="62x62" type="image/png" />
    <!--iphoneのアプリアイコン指定-->
    <link rel="apple-touch-icon-precomposed" href="画像のURL" />
    <!--OGPタグ/twitterカード-->
</head>

<body>
    <header>
        <div class = "head">
            <a class=logo-main href="/top"><img src="{{ asset('images/atlas.png') }} "></a>
            <p class="right login-icon"><img src="{{ asset('storage/' . Auth::user()->images) }}"></p>
            <!--アコーディオンメニュー-->
            <div class="right accordion">
                <button type="button" class="menu-btn">
                    <span class="inn"></span>
                </button>

                <nav class="menu">
                    <ul>
                        <li><a href="{{ asset('/top') }}">ホーム</a></li>
                        <li><a href="{{ Auth::user()->id }}/updateProfile">プロフィール編集</a></li>
                        <li><a href="{{ asset('/logout') }}">ログアウト</a></li>
                    </ul>
                </nav>
            </div>
            <p class="right header-name">{{ Auth::user()->username }}　さん</p>
        </div>
    </header>
    <div id="row">
        <div id="container">
            @yield('content')
        </div>
        <div id="side-bar">
            <div id="confirm">
                <p>{{ Auth::user()->username }}さんの</p>
                <div>
                    <p>フォロー数</p>
                    <p>{{ Auth::user()->following()->count() }}名</p>
                </div>
                <p class="btn"><a href="/follow-list">フォローリスト</a></p>
                <div>
                    <p>フォロワー数</p>
                    <p>{{ Auth::user()->followed()->count() }}名</p>
                </div>
                <p class="btn"><a href="/follower-list">フォロワーリスト</a></p>
            </div>
            <p class="btn"><a href="/search">ユーザー検索</a></p>
        </div>
    </div>
    <footer>
    </footer>
    <!-- JS記述は下のほうに持ってくる -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="{{ asset('./js/script.js') }}"></script>
</body>

</html>
