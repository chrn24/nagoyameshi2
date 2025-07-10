@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center mt-5">
    <div class="card" style="max-width: 600px; width: 100%;">
        <div class="card-body">
            <h2 class="card-title text-center mb-4">👤 <strong>登録情報の確認</strong></h2>
            <table class="table table-bordered">
                <tr>
                    <th scope="row">名前</th>
                    <td>{{ $user->name }}</td>
                </tr>
                <tr>
                    <th scope="row">メールアドレス</th>
                    <td>{{ $user->email }}</td>
                </tr>
                <tr>
                    <th scope="row">郵便番号</th>
                    <td>{{ $user->zip_code ?? '未設定' }}</td>
                </tr>
                <tr>
                    <th scope="row">住所</th>
                    <td>{{ $user->address ?? '未設定' }}</td>
                </tr>
                <tr>
                    <th scope="row">電話</th>
                    <td>{{ $user->phone_number ?? '未設定' }}</td>
                </tr>
            </table>
            <div class="text-center mt-4">
                <a href="{{ route('users.edit') }}" class="btn btn-primary">編集する</a>
            </div>
        </div>
    </div>
</div>
@endsection
