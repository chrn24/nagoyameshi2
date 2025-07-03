@extends('layouts.app')

@section('content')

<div id="carouselExampleIndicators" class="carousel slide mb-4" data-bs-ride="carousel" data-bs-interval="4000" data-bs-wrap="true">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3"></button>

  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="{{ asset('images/slide1.jpg') }}" class="d-block w-100" alt="スライド1">
    </div>
    <div class="carousel-item">
      <img src="{{ asset('images/slide2.jpg') }}" class="d-block w-100" alt="スライド2">
    </div>
    <div class="carousel-item">
      <img src="{{ asset('images/slide3.jpg') }}" class="d-block w-100" alt="スライド3">
    </div>

    <div class="carousel-item">
      <img src="{{ asset('images/slide4.jpg') }}" class="d-block w-100" alt="スライド4">
    </div>

  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
    <span class="carousel-control-next-icon"></span>
  </button>
</div>
<br>
<br>
<div class="container text-center">

  {{-- 検索フォーム --}}
  <form action="{{ route('shops.search') }}" method="GET" class="mb-4">
      <div class="input-group w-75 mx-auto">
          <input type="text" name="keyword" value="{{ request('keyword') }}" class="form-control search-input" placeholder="店舗名を入力">
          <button type="submit" class="btn btn-primary search-btn">検索</button>
      </div>
  </form>
  <br>

  {{-- カテゴリボタン --}}
  <div class="mb-4 d-flex flex-wrap justify-content-center gap-2">
      @foreach ($categories as $category)
          <a href="{{ route('shops.search', ['category_id' => $category->id]) }}" class="btn btn-outline-primary category-btn">
              #{{ $category->name }}
          </a>
      @endforeach
  </div>
  <br>
  <br>

  {{-- 人気のお店 --}}
  <h2 class="display-6 mb-4"><strong>人気のお店</strong></h2>
  <div class="row justify-content-center">
      @foreach ($popularShops as $shop)
          <div class="col-md-4 mb-4">
              <div class="card h-100 shadow-sm">
                  <a href="{{ route('shops.show', $shop->id) }}">
                      <img src="{{ asset($shop->image) }}" class="card-img-top" alt="{{ $shop->name }}" style="height: 200px; object-fit: cover;">
                  </a>
                  <div class="card-body text-start">
                      <p class="mb-1"><strong>カテゴリ:</strong> {{ $shop->category->name ?? '未分類' }}</p>
                      <h5 class="card-title">
                          <a href="{{ route('shops.show', $shop->id) }}" class="text-decoration-none text-dark">
                              <strong>店舗名:</strong>{{ $shop->name }}
                          </a>
                      </h5>
                      <p class="mb-1"><strong>価格帯:</strong> ¥{{ number_format($shop->price_min) }} ～ ¥{{ number_format($shop->price_max) }}</p>
                      <p class="mb-0"><strong>お気に入り: </strong>{{ $shop->favorites_count }}件</p>
                  </div>
              </div>
          </div>
      @endforeach
  </div>

</div>


@endsection


