@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-sm border-2">
                <div class="card-body">
                    <h4 class="card-title text-center mb-4 fs-4">新規会員登録</h4>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- 名前 -->
                        <div class="mb-3">
                            <label for="name" class="form-label">名前</label>
                            <input type="text" name="name" id="name"
                                   class="form-control @error('name') is-invalid @enderror"
                                   value="{{ old('name') }}" required autofocus autocomplete="name">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- メールアドレス -->
                        <div class="mb-3">
                            <label for="email" class="form-label">メールアドレス</label>
                            <input type="email" name="email" id="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   value="{{ old('email') }}" required autocomplete="username">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- パスワード -->
                        <div class="mb-3">
                            <label for="password" class="form-label">パスワード</label>
                            <input type="password" name="password" id="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   required autocomplete="new-password">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- パスワード（確認） -->
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">パスワード（確認）</label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                   class="form-control @error('password_confirmation') is-invalid @enderror"
                                   required autocomplete="new-password">
                            @error('password_confirmation')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- 送信ボタン -->
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <a href="{{ route('login') }}" class="nav-link-custom small">すでに登録済みの方はこちら</a>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">登録</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
