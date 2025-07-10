@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center mt-5">
    <div class="card" style="max-width: 600px; width: 100%;">
        <div class="card-body">
            <h2 class="card-title text-center mb-4">✏️ 登録情報の編集</h2>

            {{-- エラーメッセージ表示 --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('users.update') }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">名前</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                           id="name" name="name" value="{{ old('name', $user->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">メールアドレス</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                           id="email" name="email" value="{{ old('email', $user->email) }}" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="zip_code" class="form-label">郵便番号</label>
                    <input type="text" class="form-control @error('zip_code') is-invalid @enderror"
                           id="zip_code" name="zip_code" value="{{ old('zip_code', $user->zip_code) }}">
                    @error('zip_code')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">住所</label>
                    <input type="text" class="form-control @error('address') is-invalid @enderror"
                           id="address" name="address" value="{{ old('address', $user->address) }}">
                    @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="phone_number" class="form-label">電話番号</label>
                    <input type="text" class="form-control @error('phone_number') is-invalid @enderror"
                           id="phone_number" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}">
                    @error('phone_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="text-center">
                  <button type="submit" class="btn btn-primary">保存する</button>
                  <a href="{{ route('users.mypage') }}" class="btn btn-secondary ms-2 fw-bold">戻る</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
