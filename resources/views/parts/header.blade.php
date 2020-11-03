<nav class="navbar blue-gradient">
    <a class="navbar-brand" href="{{ url('/') }}">
        立呑イベント
    </a>

    <div class="nav-wrapper"><!-- ②ナビゲーションメニュー -->
        <nav class="header-nav">
            <ul class="nav-list">
                @if(Auth::guard('user')->check())

                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            {{ Auth::guard('user')->user()->name }}　様
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('user.show', ['id' => Auth::guard('user')->user()->id]) }}">
                            マイページ
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('user.edit') }}">
                            プロフィール編集
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.password.request') }}">
                            パスワード再設定
                        </a>
                    </li>
                    <li class="nav-item">
                        <form class="nav-link" action="{{ route('user.logout') }}" method="POST">
                            @csrf
                            <button type="submit">ログアウト</button>
                        </form>
                    </li>

                @elseif(Auth::guard('admin')->check())

                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            {{ Auth::guard('admin')->user()->name }}　様
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            会員情報
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.event.create') }}">
                            イベントを作成する
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('top') }}">
                            イベントを検索する
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.index') }}">
                            管理者一覧
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.shop.index') }}">
                            登録店舗一覧
                        </a>
                    </li>
                    <li class="nav-item">
                        <form class="nav-link" action="{{ route('admin.logout') }}" method="POST">
                            @csrf
                            <button type="submit">ログアウト</button>
                        </form>
                    </li>

                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.login') }}">ログイン</a>
                    </li>
                    @if (Route::has('user.register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('user.register') }}">新規会員登録</a>
                        </li>
                    @endif

                @endif
            </ul>
        </nav>
    </div>

    <div id="burger-btn" class="open"><!-- ③ハンバーガーボタン -->
        <span class="bar bar_top"></span>
        <span class="bar bar_mid"></span>
        <span class="bar bar_bottom"></span>
    </div>
</nav>
<div id="nav-touch-background" class="off"></div>
