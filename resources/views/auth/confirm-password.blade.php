@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-sm border-2">
                <div class="card-body">
                    <h4 class="card-title text-center mb-4 fs-4">パスワード確認</h4>

                    <p class="text-muted mb-4 text-sm text-center">
                        セキュリティ保護された操作です。続行するにはパスワードを入力してください。
                    </p>

                    <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf

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
