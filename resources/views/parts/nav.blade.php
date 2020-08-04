<nav class="navbar navbar-expand navbar-dark blue-gradient">

    <a class="navbar-brand" href="/"><i class="far fa-sticky-note mr-1"></i>立呑イベント</a>
    
    <ul class="navbar-nav ml-auto">


        <!-- ゲスト用ナビバー -->
        @if (!(Auth::guard('user')->check()) && !(Auth::guard('admin')->check()))
        <li class="nav-item">
            <a class="nav-link" href="{{ route('user.register') }}">ユーザー登録</a>
        </li>
        
        <li class="nav-item">
            <a class="nav-link" href="{{ route('user.login') }}">ログイン</a>
        </li>
    

        <!-- 一般ユーザー用ナビバー -->
        @elseif (Auth::guard('user')->check())
            <li class="nav-item">
                <a class="nav-link" href=""><i class="fas fa-pen mr-1"></i>投稿する</a>
            </li>
            
            <!-- Dropdown -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-user-circle"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
                    <button class="dropdown-item" type="button" onclick="location.href='{{ route('user.show', ['id' => Auth::guard('user')->user()->id]) }}'">
                        マイページ
                    </button>
                    <div class="dropdown-divider"></div>
                    <button class="dropdown-item" type="button" onclick="location.href='{{ route('user.edit') }}'">
                        プロフィール編集
                    </button>
                    <div class="dropdown-divider"></div>
                    <button form="logout-button" class="dropdown-item" type="submit">
                        ログアウト
                    </button>
                </div>
            </li>
            <form id="logout-button" method="POST" action="{{ route('user.logout') }}">
                @csrf
            </form>
            <!-- Dropdown -->


        <!-- 管理ユーザー用ナビバー -->
        @elseif (Auth::guard('admin')->check())
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.event.create') }}"><i class="fas fa-pen mr-1"></i>イベントを作成する</a>
            </li>
            
            <!-- Dropdown -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-user-circle"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
                    <button class="dropdown-item" type="button" onclick="location.href=''">
                        {{ Auth::guard('admin')->user()->name }}
                    </button>
                    <div class="dropdown-divider"></div>
                    <button onclick="location.href='{{ route('top') }}'" class="dropdown-item">イベントを検索する</button>
                    <div class="dropdown-divider"></div>
                    <button onclick="location.href='{{ route('admin.index') }}'" class="dropdown-item">管理者一覧</button>
                    <div class="dropdown-divider"></div>
                    <button onclick="location.href='{{ route('admin.shop.index') }}'" class="dropdown-item">登録店舗一覧</button>
                    <div class="dropdown-divider"></div>
                    <button form="logout-button" class="dropdown-item" type="submit">
                        ログアウト
                    </button>
                </div>
            </li>
            <form id="logout-button" method="POST" action="{{ route('admin.logout') }}">
                @csrf
            </form>
        @endif

    </ul>

</nav>