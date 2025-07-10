@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row mb-4">
        {{-- 左カラム：画像 --}}
        <div class="col-md-5">
            <img src="data:image/png;base64,{{ $shop->image }}" alt="{{ $shop->name }}" class="img-fluid rounded shadow-sm">
            
        </div>

        {{-- 右カラム：店舗情報 --}}
        <div class="col-md-7">
            <h2 class=" display-6 mb-3"><strong>{{ $shop->name }}</strong></h2>
            <p class="mb-1"><strong>カテゴリ:</strong> {{ $shop->category->name ?? 'なし' }}</p>
            <p class="mb-1"><strong>価格帯:</strong> ¥{{ number_format($shop->price_min) }} ～ ¥{{ number_format($shop->price_max) }}</p>
            <p class="mb-1"><strong>営業時間:</strong> {{ $shop->business_hours }}</p>
            <p class="mb-1"><strong>店休日:</strong> {{ $shop->closed_day }}</p>
            <p class="mb-1"><strong>住所:</strong> 〒{{ $shop->zip_code }} {{ $shop->address }}</p>
            <p class="mb-3"><strong>電話番号:</strong> {{ $shop->phone_number }}</p>

            <p class="mb-2"><strong>お気に入り数:</strong> {{ $shop->favorites->count() }}</p>

            {{-- 店舗説明 --}}
            <div class="mb-3">
                <h5 class="fw-bold">店舗説明</h5>
                <p>{{ $shop->description }}</p>
            </div>

            {{-- ボタン類：お気に入り＋予約 --}}
            <div class="d-flex flex-wrap gap-2 mb-3">
                @auth
                    @if (auth()->user()->isPremium())
                        @if ($favorited)
                            <form action="{{ route('favorites.destroy', $shop->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-favorite">♥ お気に入り解除</button>
                            </form>
                        @else
                            <form action="{{ route('favorites.store', $shop->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-favorite">♡ お気に入りに追加</button>
                            </form>
                        @endif
                        <a href="{{ route('reservations.create', ['shop' => $shop->id]) }}" class="btn btn-reservation">予約する</a>
                    @else
                        <a href="{{ route('users.upgrade') }}" class="btn btn-favorite">♡ お気に入りに追加</a>
                        <a href="{{ route('users.upgrade') }}" class="btn btn-reservation">予約する</a>
                    @endif
                @else
                    <a href="{{ route('users.upgrade') }}" class="btn btn-favorite">♡ お気に入りに追加</a>
                    <a href="{{ route('users.upgrade') }}" class="btn btn-reservation">予約する</a>
                @endauth
            </div>
        </div>
    </div>

    <hr class="my-4">

  <div class="mb-4">
    @auth
        @if (auth()->user()->isPremium())
            <a href="{{ route('reviews.create', ['shop' => $shop->id]) }}"
               class="review-post-box text-decoration-none hover-highlight"
               style="color: #333;">
                <div class="d-flex align-items-center">
                    <i class="bi bi-pencil-square fs-3 me-3 text-primary"></i>
                    <div>
                        <h5 class="mb-1">レビューを投稿する</h5>
                    </div>
                </div>
            </a>
        @else
            <a href="{{ route('users.upgrade') }}"
               class="review-post-box text-decoration-none hover-highlight"
               style="color: #666;">
                <div class="d-flex align-items-center">
                    <i class="bi bi-lock fs-3 me-3 text-secondary"></i>
                    <div>
                        <h5 class="mb-1">レビューを投稿する</h5>
                    </div>
                </div>
            </a>
        @endif
    @else
        <a href="{{ route('users.upgrade') }}"
           class="review-post-box text-decoration-none hover-highlight"
           style="color: #666;">
            <div class="d-flex align-items-center">
                <i class="bi bi-person-circle fs-3 me-3 text-secondary"></i>
                <div>
                    <h5 class="mb-1">レビューを投稿する</h5>
                </div>
            </div>
        </a>
    @endauth
</div>



   {{-- レビュー一覧 --}}
<div class="mb-5">
    <h4 class="mb-3"><strong>レビュー一覧</strong></h4>
    @forelse ($shop->reviews as $review)
    <div class="review-item py-3 d-flex justify-content-between align-items-start">
        <div>
            <p class="mb-1"><strong>評価:</strong> {{ $review->rating }}</p>
            <p class="mb-2">{{ $review->comment }}</p>
        </div>

        @auth
            @if (auth()->id() === $review->user_id && auth()->user()->isPremium())
                <div class="ms-3 text-end">
                    <a href="{{ route('reviews.edit', ['review' => $review->id]) }}" class="review-link me-2">編集</a>

                    <form action="{{ route('reviews.destroy', $review->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="review-link btn btn-link p-0">削除</button>
                    </form>
                </div>
            @endif
        @endauth
    </div>
@empty
    <p>まだレビューはありません。</p>
@endforelse
</div>

    {{-- トップページに戻るボタン --}}

    <div class="text-center">
        <a href="{{ route('top') }}" class="btn btn-secondary">トップページに戻る</a>
    </div>
</div>
@endsection
