{{-- resources/views/admin/users/index.blade.php --}}
@extends('admin.layouts.app')

@section('content')
<h2>会員一覧</h2>

<!-- メール検索フォーム -->
<form method="GET" action="{{ route('admin.users.index') }}" class="mb-3">
    <div class="input-group">
        <input type="text" name="email" class="form-control" placeholder="メールアドレスで検索" value="{{ request('email') }}">
        <button type="submit" class="btn btn-primary">検索</button>
    </div>
</form>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ユーザー名</th>
            <th>Email</th>
            <th>登録日</th>
            <th>会員ステータス</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ \Carbon\Carbon::parse($user->created_at)->format('Y/m/d') }}</td>
            <td>{{ $user->membership_status }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
