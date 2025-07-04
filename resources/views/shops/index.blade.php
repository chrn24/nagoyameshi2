@extends('layouts.app')

@section('content')
<div class="container py-4">

    <h2 class="text-center display-6 reservation-title mb-4"><strong>店舗一覧</strong></h2>

    @if ($categoryId)
        <p class="text-center">カテゴリで絞り込み中: 
            <strong>{{ \App\Models\Category::find($categoryId)->name }}</strong>
        </p>
    @endif

    <h5 class="text-center mb-4">検索結果：{{ $shops->count() }}件</h5>

    <div class="row justify-content-center">
        @forelse ($shops as $shop)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <a href="{{ route('shops.show', $shop->id) }}">
                        <img src="{{ asset($shop->image) }}" class="card-img-top" alt="{{ $shop->name }}" style="height: 200px; object-fit: cover;">
                    </a>
                    <div class="card-body text-start">
                        <p class="mb-1"><strong>カテゴリ:</strong> {{ $shop->category->name ?? 'なし' }}</p>
                        <h5 class="card-title"><strong>店舗名:</strong> 
                            <a href="{{ route('shops.show', $shop->id) }}" class="shop-name-link">{{ $shop->name }}</a>
                        </h5>
                        <p class="mb-1">{{ $shop->description }}</p>
                        <p class="mb-1"><strong>お気に入り:</strong> {{ $shop->favorites->count() }}件</p>
                        <p class="mb-0"><strong>価格帯:</strong> ¥{{ number_format($shop->price_min) }} ～ ¥{{ number_format($shop->price_max) }}</p>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center">該当する店舗は見つかりませんでした。</p>
        @endforelse

        <br>
        <br>
          <div class="text-center">
             <a href="{{ route('top') }}" class="btn btn-secondary">トップページに戻る</a>
          </div>
    </div>
</div>
@endsection
