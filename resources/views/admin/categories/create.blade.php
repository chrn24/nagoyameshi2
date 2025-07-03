@extends('admin.layouts.app')

@section('content')
<h2>カテゴリ追加</h2>
<br>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('admin.categories.store') }}">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">カテゴリ名</label>
        <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required maxlength="100">
    </div>

    <button type="submit" class="btn btn-success">登録する</button>
    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">一覧に戻る</a>
</form>
@endsection
