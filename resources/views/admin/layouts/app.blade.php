<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Admin | @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

     <link rel="stylesheet" href="{{ asset('css/adminnagoyameshi.css') }}">
</head>
<body class="bg-light">
    {{-- ヘッダーを共通化 --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand text-white px-3" href="{{ route('admin.home') }}">Admin nagoyameshi</a>

            @if(Auth::guard('admin')->check())
                <div class="ms-auto me-3">
                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                    <a href="{{ route('admin.logout') }}"
                       class="btn btn-outline-light"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        ログアウト
                    </a>
                </div>
            @endif
        </div>
    </nav>

    <div class="container-fluid custom-container mt-4 ">
        @yield('content')
    </div>
    @yield('scripts')

</body>
</html>
