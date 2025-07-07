@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-sm border-2">
                <div class="card-body">
                    <h4 class="card-title text-center mb-4 fs-4">ログイン</h4>

                    <!-- セッションステータス -->
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- メールアドレス -->
                        <div class="mb-3">
                            <label for="email" class="form-label">メールアドレス</label>
                            <input type="email" name="email" id="email"
                                class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email') }}" required autofocus autocomplete="username">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- パスワード -->
                        <div class="mb-3">
                            <label for="password" class="form-label">パスワード</label>
                            <input type="password" name="password" id="password"
                                class="form-control @error('password') is-invalid @enderror"
                                required autocomplete="current-password">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Remember Me -->
                        <div class="form-check mb-3">
                            <input type="checkbox" name="remember" id="remember_me" class="form-check-input">
                            <label class="form-check-label" for="remember_me">ログイン状態を保持する</label>
                        </div>

                        <!-- ボタン＆リンク -->
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="nav-link-custom small">パスワードを忘れた方はこちら</a>
                            @endif
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">ログイン</button>
                        </div>
                    </form>

                    <div class="mt-3 text-center">
                        <a href="{{ route('register') }}" class="nav-link-custom">新規会員登録はこちら</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
