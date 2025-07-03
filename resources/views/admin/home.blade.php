@extends('admin.layouts.app')

@section('title', 'ダッシュボード')

@section('content')
    <h2 class="mb-4">管理画面トップ</h2>
    <ul class="list-group">
        <li class="list-group-item"><a href="{{ route('admin.shops.index') }}">店舗一覧ページ</a></li>
        <li class="list-group-item"><a href="{{ route('admin.users.index') }}">会員一覧ページ</a></li>
        <li class="list-group-item"><a href="{{ route('admin.categories.index') }}">カテゴリ一覧ページ</a></li>
        <li class="list-group-item"><a href="{{ route('admin.subscriptions.index') }}">サブスク売上一覧ページ</a></li>
    </ul>
@endsection


