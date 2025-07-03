@extends('admin.layouts.app')

@section('content')
<h2>カテゴリ編集</h2>
<br>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('admin.categories.update', $category->id) }}">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="name" class="form-label">カテゴリ名</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ old('name') !== null && old('name') !== '' ? old('name') : $category->name }}" maxlength="100">
    </div>

    <button type="submit" class="btn btn-primary">更新する</button>
    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">戻る</a>
</form>
@endsection
