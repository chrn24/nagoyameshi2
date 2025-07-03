@extends('admin.layouts.app')

@section('content')
<h2>登録内容確認</h2>

<form method="POST" action="{{ route('admin.shops.store') }}">
    @csrf
    <input type="hidden" name="category_id" value="{{ $input['category_id'] }}">
    <input type="hidden" name="imagePath" value="{{ $imagePath }}">
    <input type="hidden" name="name" value="{{ $input['name'] }}">
    <input type="hidden" name="description" value="{{ $input['description'] }}">
<input type="hidden" name="price_min" value="{{ $input['price_min'] }}">
<input type="hidden" name="price_max" value="{{ $input['price_max'] }}">
<input type="hidden" name="business_hours" value="{{ $input['business_hours'] }}">
<input type="hidden" name="business_period" value="{{ $input['business_period'] }}">
<input type="hidden" name="closed_day" value="{{ $input['closed_day'] }}">
<input type="hidden" name="zip_code" value="{{ $input['zip_code'] }}">
<input type="hidden" name="address" value="{{ $input['address'] }}">
<input type="hidden" name="phone_number" value="{{ $input['phone_number'] }}">
    <!-- 他のフィールドも同様に hidden で保持 -->

    <table class="table">
    <tbody>
        <tr><th>カテゴリ</th><td>{{ \App\Models\Category::find($input['category_id'])->name }}</td></tr>
        <tr><th>店舗名</th><td>{{ $input['name'] }}</td></tr>
        <tr><th>説明</th><td>{{ $input['description'] }}</td></tr>
        <tr><th>金額下限</th><td>{{ $input['price_min'] }} 円</td></tr>
        <tr><th>金額上限</th><td>{{ $input['price_max'] }} 円</td></tr>
        <tr><th>営業時間</th><td>{{ $input['business_hours'] }}</td></tr>
        <tr><th>営業期間</th><td>{{ $input['business_period'] }}</td></tr>
        <tr><th>店休日</th><td>{{ $input['closed_day'] }}</td></tr>
        <tr><th>郵便番号</th><td>{{ $input['zip_code'] }}</td></tr>
        <tr><th>住所</th><td>{{ $input['address'] }}</td></tr>
        <tr><th>電話番号</th><td>{{ $input['phone_number'] }}</td></tr>
       <tr><th>店舗画像</th><td>
        @if($imagePath)
            <img src="{{ asset('storage/' . $imagePath) }}" width="200">
        @else
            なし
        @endif
    </td>
</tr>
    </tbody>
</table>

    <button type="submit">この内容で登録する</button>
</form>

<form method="GET" action="{{ route('admin.shops.create') }}">
    @csrf
    <button type="submit">戻る</button>
</form>


@endsection
