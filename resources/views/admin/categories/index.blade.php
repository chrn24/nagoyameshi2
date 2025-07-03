@extends('admin.layouts.app')

@section('content')
<h2>カテゴリ管理</h2>
<br>

{{-- 新規カテゴリ追加フォーム --}}
<a href="{{ route('admin.categories.create') }}" class="btn btn-success mb-3">＋ 新規カテゴリ追加</a>


{{-- カテゴリ一覧テーブル --}}
<table class="table table-bordered">
    <thead>
        <tr>
            <th>カテゴリ名</th>
            <th>操作</th>
        </tr>
    </thead>
    <tbody id="category-table-body">
        @foreach ($categories as $category)
        <tr id="category-{{ $category->id }}">
            <td>
                <span class="category-name" data-id="{{ $category->id }}">{{ $category->name }}</span>
                <input type="text" class="form-control d-none edit-input" data-id="{{ $category->id }}" value="{{ $category->name }}">
                <div class="text-danger edit-error mt-1" style="display: none;"></div>
            </td>
            <td>
                <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-sm btn-primary">編集</a>

                <form method="POST" action="{{ route('admin.categories.destroy', $category->id) }}" onsubmit="return confirm('本当に削除してよろしいですか？');" class="d-inline">
                 @csrf
                 @method('DELETE')
                 <button type="submit" class="btn btn-sm btn-danger">削除</button> 
               </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection


