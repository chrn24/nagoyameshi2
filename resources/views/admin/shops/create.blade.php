@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">店舗情報新規登録</h2>

    <div class="col-md-8 mx-auto">
        <form method="POST" action="{{ route('admin.shops.confirm') }}" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="category_id" class="form-label">カテゴリ：</label>
                <select name="category_id" id="category_id" class="form-select" required>
                    <option value="">-- カテゴリを選択 --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">画像：</label>
                <input type="file" name="image" id="image" class="form-control">
            </div>

            <div class="mb-3">
                <label for="name" class="form-label">店舗名：</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" maxlength="100" class="form-control">
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">説明：</label>
                <textarea name="description" id="description" rows="3" class="form-control">{{ old('description') }}</textarea>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="price_min" class="form-label">金額下限：</label>
                    <input type="number" name="price_min" id="price_min" value="{{ old('price_min') }}" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="price_max" class="form-label">金額上限：</label>
                    <input type="number" name="price_max" id="price_max" value="{{ old('price_max') }}" class="form-control">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="business_hours" class="form-label">営業時間：</label>
                    <input type="text" name="business_hours" id="business_hours" maxlength="100" value="{{ old('business_hours') }}" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="business_period" class="form-label">営業期間：</label>
                    <input type="text" name="business_period" id="business_period" maxlength="100" value="{{ old('business_period') }}" class="form-control">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="closed_day" class="form-label">店休日：</label>
                    <input type="text" name="closed_day" id="closed_day" maxlength="100" value="{{ old('closed_day') }}" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="phone_number" class="form-label">電話番号：</label>
                    <input type="text" name="phone_number" id="phone_number" maxlength="20" value="{{ old('phone_number') }}" class="form-control">
                </div>
            </div>

            <div class="mb-3">
                <label for="zip_code" class="form-label">郵便番号：</label>
                <input type="text" name="zip_code" id="zip_code" maxlength="10" value="{{ old('zip_code') }}" class="form-control">
            </div>

            <div class="mb-4">
                <label for="address" class="form-label">住所：</label>
                <input type="text" name="address" id="address" value="{{ old('address') }}" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary w-100">登録内容を確認</button>
        </form>
    </div>
</div>
@endsection
