@extends('layouts.app')

@section('content')

<div class="container py-4">
    <h2 class="text-center mb-4">⭐ お気に入り店舗一覧</h2>

    @if ($favoriteShops->isEmpty())
        <p class="text-center">現在、お気に入り店舗はありません。</p>
    @else
        <div class="row justify-content-center">
            @foreach ($favoriteShops as $shop)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <a href="{{ route('shops.show', $shop->id) }}">
                            <img src="data:image/png;base64,{{ $shop->image }}"
                                 class="card-img-top"
                                 alt="{{ $shop->name }}"
                                 style="height: 200px; object-fit: cover;">
                        </a>
                        
                         
                        <div class="card-body text-start">
                            <h5 class="card-title">
                                <p class="mb-1"><strong>カテゴリ:</strong> {{ $shop->category->name ?? '未分類' }}</p>
                                <strong>店舗名：</strong>
                                <a href="{{ route('shops.show', $shop->id) }}" class="shop-name-link">
                                    {{ $shop->name }}
                                </a>
                            </h5>
                           
                            <p class="mb-1"><strong>価格帯:</strong> ¥{{ number_format($shop->price_min) }} ～ ¥{{ number_format($shop->price_max) }}</p>
                            <p class="mb-1"><strong>電話番号:</strong>{{ $shop->phone_number }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <div class="text-center mt-4">
        <a href="{{ route('users.mypage') }}" class="btn btn-secondary">マイページに戻る</a>
    </div>
</div>
@endsection
