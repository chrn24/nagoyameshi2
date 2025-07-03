<nav class="navbar navbar-expand-lg bg-white nagoyameshi-navbar px-4 py-2 border-bottom">
    <div class="container-fluid justify-content-between">

        {{-- 左：ロゴ --}}
        <a class="navbar-brand nav-logo" href="{{ route('top') }}"><strong>Nagoyameshi</strong></a>

        {{-- 右：認証系ナビ --}}
        <div class="d-flex align-items-center gap-3 nav-link-group">
            @auth
                <a href="{{ route('users.mypage') }}" class="nav-link-custom">マイページ</a>

                @if (app()->environment('local'))
                    @if (auth()->user()->isPremium())
                        <span class="nav-status premium">プレミアム会員（開発用）</span>
                    @elseif (auth()->user()->isFree())
                        <span class="nav-status free">無料会員（開発用）</span>
                    @endif
                @endif

                <form action="{{ route('logout') }}" method="POST" class="mb-0">
                    @csrf
                    <button type="submit" class="nav-link-custom border-0 bg-transparent p-0">ログアウト</button>
                </form>
            @else
                <a href="{{ route('register') }}" class="nav-link-custom">会員登録</a>
                <a href="{{ route('login') }}" class="nav-link-custom">ログイン</a>
            @endauth
        </div>
    </div>
</nav>
