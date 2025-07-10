@extends('admin.layouts.app')

@section('content')

<h2>店舗一覧</h2>

<a href="{{ route('admin.shops.create') }}" class="btn btn-primary mb-3">＋ 店舗登録</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>カテゴリ</th>
            <th>画像</th>
            <th>店舗名</th>
            <th>説明</th>
            <th>金額下限</th>
            <th>金額上限</th>
            <th>営業時間</th>
            <th>店休日</th>
            <th>郵便番号</th>
            <th>住所</th>
            <th>電話番号</th>
            <th>操作</th>
        </tr>
    </thead>
    <tbody>
        @foreach($shops as $shop)
        <tr>
            <td>{{ $shop->category->name ?? '未設定' }}</td>
            <td>
                @if($shop->image)
                 <img src="data:image/png;base64,{{ $shop->image }}" style="max-width: 150px;">
                @else
                 <img src="{{ asset($shop->image) }}" alt="..." style="max-width: 150px;">
                @endif

            </td>
            <td>{{ $shop->name }}</td>
            <td class="description-cell">{{ $shop->description }}</td>
            <td>{{ $shop->price_min }}</td>
            <td>{{ $shop->price_max }}</td>
            <td>{{ $shop->business_hours }}</td>
            <td>{{ $shop->closed_day }}</td>
            <td>{{ $shop->zip_code }}</td>
            <td>{{ $shop->address }}</td>
            <td>{{ $shop->phone_number }}</td>
            <td>
                <a href="{{ route('admin.shops.edit', $shop->id) }}" class="btn btn-sm btn-info">編集</a>
                <form action="{{ route('admin.shops.destroy', $shop->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('本当に削除しますか？');">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger">削除</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection
