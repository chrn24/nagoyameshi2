@extends('admin.layouts.app')

@section('content')
<h2>カテゴリ管理</h2>
<br>

{{-- 新規カテゴリ追加フォーム --}}
<div class="mb-4">
    <form id="create-category-form">
        @csrf
        <div class="input-group">
            <input type="text" name="name" class="form-control" placeholder="新しいカテゴリ名を入力" required maxlength="100">
            <button class="btn btn-success" type="submit">登録</button>
        </div>
        <div id="create-error" class="text-danger mt-2" style="display: none;"></div>
    </form>
</div>

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
                <button class="btn btn-sm btn-primary edit-btn" data-id="{{ $category->id }}">編集</button>
                <button class="btn btn-sm btn-danger delete-btn" data-id="{{ $category->id }}">削除</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    // 新規追加
    document.getElementById('create-category-form').addEventListener('submit', function (e) {
        e.preventDefault();
        const input = this.querySelector('input[name="name"]');
        const errorDiv = document.getElementById('create-error');
        fetch("{{ route('admin.categories.store') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": '{{ csrf_token() }}',
            },
            body: JSON.stringify({ name: input.value }),
        }).then(res => {
            if (!res.ok) return res.json().then(data => { throw data; });
            return res.json();
        }).then(() => location.reload())
        .catch(err => {
            errorDiv.style.display = 'block';
            errorDiv.textContent = err?.errors?.name?.[0] || 'エラーが発生しました';
        });
    });

    // 編集ボタン切り替え
    document.querySelectorAll('.edit-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            const id = this.dataset.id;
            document.querySelector(`.category-name[data-id="${id}"]`).classList.add('d-none');
            const input = document.querySelector(`.edit-input[data-id="${id}"]`);
            input.classList.remove('d-none');
            input.focus();
        });
    });

    // 編集確定（フォーカスが外れたら）
    document.querySelectorAll('.edit-input').forEach(input => {
        input.addEventListener('blur', function () {
            const id = this.dataset.id;
            const newName = this.value;
            const errorDiv = this.nextElementSibling;

            fetch(`/admin/categories/${id}`, {
                method: "PUT",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": '{{ csrf_token() }}',
                },
                body: JSON.stringify({ name: newName }),
            }).then(res => {
                if (!res.ok) return res.json().then(data => { throw data; });
                return res.json();
            }).then(() => location.reload())
            .catch(err => {
                errorDiv.style.display = 'block';
                errorDiv.textContent = err?.errors?.name?.[0] || '更新エラー';
            });
        });
    });

    // 削除
    document.querySelectorAll('.delete-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            if (!confirm('本当に削除してよろしいですか？')) return;
            const id = this.dataset.id;
            fetch(`/admin/categories/${id}`, {
                method: "DELETE",
                headers: {
                    "X-CSRF-TOKEN": '{{ csrf_token() }}',
                }
            }).then(() => location.reload());
        });
    });
});
</script>
@endsection
