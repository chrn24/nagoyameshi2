@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-sm border-2">
                <div class="card-body">
                    <h4 class="card-title text-center mb-4 fs-4">パスワード再設定</h4>

                    <p class="text-muted mb-4 text-sm text-center">
                        パスワードをお忘れですか？ 登録済みのメールアドレスを入力いただければ、パスワード再設定用リンクをお送りします。
                    </p>

                    <!-- セッションステータス -->
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <!-- メールアドレス -->
                        <div class="mb-3">
                            <label for="email" class="form-label">メールアドレス</label>
                            <input type="email" id="email" name="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   value="{{ old('email') }}" required autofocus>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- ボタン -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                パスワード再設定リンクを送信
                            </button>
                        </div>
                    </form>

                    <div class="mt-3 text-center">
                        <a href="{{ route('login') }}" class="nav-link-custom">ログイン画面に戻る</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
