@extends('layouts.app')

@section('content')
<h2>登録情報の確認</h2>
<table>
    <tr><th>名前</th><td>{{ $user->name }}</td></tr>
    <tr><th>メールアドレス</th><td>{{ $user->email }}</td></tr>
    <tr><th>パスワード</th><td>セキュリティのため表示しません</td></tr>
    <tr><th>郵便番号</th><td>{{ $user->postal_code ?? '未設定' }}</td></tr>
    <tr><th>住所</th><td>{{ $user->address ?? '未設定' }}</td></tr>
    <tr><th>電話</th><td>{{ $user->phone ?? '未設定' }}</td></tr>
</table>

<a href="{{ route('users.edit') }}">編集する</a>

@endsection