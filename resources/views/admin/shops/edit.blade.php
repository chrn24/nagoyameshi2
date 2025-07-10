@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">店舗情報編集</h2>

    <div class="container">
    <h2 class="mb-4">店舗情報新規登録</h2>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="col-md-8 mx-auto">
        <form method="POST" action="{{ route('admin.shops.editconfirm', $shop->id) }}" enctype="multipart/form-data">
            @csrf
            @method('POST')

            <div class="mb-3">
                <label for="category_id" class="form-label">カテゴリ：</label>
                <select name="category_id" id="category_id" class="form-select" required>
                    <option value="">-- カテゴリを選択 --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ (old('category_id', $shop->category_id) == $category->id) ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                 <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                
                @if($shop->image)
                    <div class="mt-2">
                        <p>現在の画像：</p>
                        <img src="data:image/png;base64,{{ $shop->image }}" width="200">
                        
                    </div>
                @endif

                <label for="image" class="form-label">画像：</label>
                <input type="file" name="image" id="image" class="form-control">

                @error('image')
                 <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="name" class="form-label">店舗名：</label>
                <input type="text" name="name" id="name" value="{{ old('name', $shop->name) }}" maxlength="100" class="form-control">
                @error('name')
                 <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">説明：</label>
                <textarea name="description" id="description" rows="3" class="form-control">{{ old('description', $shop->description) }}</textarea>
                @error('description')
                 <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="price_min" class="form-label">金額下限：</label>
                    <input type="number" name="price_min" id="price_min" value="{{ old('price_min', $shop->price_min) }}" class="form-control">
                    @error('price_min')
                     <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="price_max" class="form-label">金額上限：</label>
                    <input type="number" name="price_max" id="price_max" value="{{ old('price_max', $shop->price_max) }}" class="form-control">
                    @error('price_max')
                     <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="business_hours" class="form-label">営業時間：</label>
                    <input type="text" name="business_hours" id="business_hours" maxlength="100" value="{{ old('business_hours', $shop->business_hours) }}" class="form-control">
                    @error('business_hours')
                     <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="business_period" class="form-label">営業期間：</label>
                    <input type="text" name="business_period" id="business_period" maxlength="100" value="{{ old('business_period', $shop->business_period) }}" class="form-control">
                    @error('business_period')
                     <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="closed_day" class="form-label">店休日：</label>
                    <input type="text" name="closed_day" id="closed_day" maxlength="100" value="{{ old('closed_day', $shop->closed_day) }}" class="form-control">
                    @error('closed_day')
                     <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="phone_number" class="form-label">電話番号：</label>
                    <input type="text" name="phone_number" id="phone_number" maxlength="20" value="{{ old('phone_number', $shop->phone_number) }}" class="form-control">
                    @error('phone_number')
                     <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="zip_code" class="form-label">郵便番号：</label>
                <input type="text" name="zip_code" id="zip_code" maxlength="10" value="{{ old('zip_code', $shop->zip_code) }}" class="form-control">
                @error('zip_code')
                 <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="address" class="form-label">住所：</label>
                <input type="text" name="address" id="address" value="{{ old('address', $shop->address) }}" class="form-control">
                @error('address')
                 <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary w-100">店舗情報を更新する</button>
        </form>
    </div>
</div>
@endsection
