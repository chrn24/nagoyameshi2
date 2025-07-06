@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">店舗情報編集</h2>

    <div class="col-md-8 mx-auto">
        <form method="POST" action="{{ route('admin.shops.update', $shop->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="category_id" class="form-label">カテゴリ：</label>
                <select name="category_id" id="category_id" class="form-select" required>
                    <option value="">-- カテゴリを選択 --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $shop->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">画像：</label>
                @if($shop->image)
                    <div class="mb-2">
                        <img src="{{ asset('storage/shops/' . $shop->image) }}" width="200" alt="店舗画像">
                    </div>
                @endif
                <input type="file" name="image" id="image" class="form-control">
                <small class="text-muted">※新しい画像を選択すると上書きされます</small>
            </div>

            <div class="mb-3">
                <label for="name" class="form-label">店舗名：</label>
                <input type="text" name="name" id="name" value="{{ old('name', $shop->name) }}" maxlength="100" class="form-control">
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">説明：</label>
                <textarea name="description" id="description" rows="3" class="form-control">{{ old('description', $shop->description) }}</textarea>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="price_min" class="form-label">金額下限：</label>
                    <input type="number" name="price_min" id="price_min" value="{{ old('price_min', $shop->price_min) }}" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="price_max" class="form-label">金額上限：</label>
                    <input type="number" name="price_max" id="price_max" value="{{ old('price_max', $shop->price_max) }}" class="form-control">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="business_hours" class="form-label">営業時間：</label>
                    <input type="text" name="business_hours" id="business_hours" value="{{ old('business_hours', $shop->business_hours) }}" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="business_period" class="form-label">営業期間：</label>
                    <input type="text" name="business_period" id="business_period" value="{{ old('business_period', $shop->business_period) }}" class="form-control">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="closed_day" class="form-label">店休日：</label>
                    <input type="text" name="closed_day" id="closed_day" value="{{ old('closed_day', $shop->closed_day) }}" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="phone_number" class="form-label">電話番号：</label>
                    <input type="text" name="phone_number" id="phone_number" value="{{ old('phone_number', $shop->phone_number) }}" class="form-control">
                </div>
            </div>

            <div class="mb-3">
                <label for="zip_code" class="form-label">郵便番号：</label>
                <input type="text" name="zip_code" id="zip_code" value="{{ old('zip_code', $shop->zip_code) }}" class="form-control">
            </div>

            <div class="mb-4">
                <label for="address" class="form-label">住所：</label>
                <input type="text" name="address" id="address" value="{{ old('address', $shop->address) }}" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary w-100">更新する</button>
        </form>
    </div>
</div>
@endsection
