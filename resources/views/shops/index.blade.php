@extends('layouts.app')
@section('content')
<h1>店舗一覧</h1>

<a href="{{ route('top', ['keyword' => $keyword]) }}" style="...">トップページに戻る</a>

@if ($categoryId)
    <p>カテゴリで絞り込み中: 
        {{ \App\Models\Category::find($categoryId)->name }}
    </p>
@endif

<h2>検索結果：{{ $shops->count() }}件</h2>

@forelse ($shops as $shop)
    <div style="margin-bottom: 20px;">
        <p><strong>カテゴリ:</strong> {{ $shop->category->name ?? 'なし' }}</p>
        <a href="{{ route('shops.show', $shop->id) }}">
         <img src="{{ asset($shop->image) }}" alt="{{ $shop->name }}" style="max-width: 300px;">
       </a>
       <h3>
         <a href="{{ route('shops.show', $shop->id) }}">{{ $shop->name }}</a>
       </h3>
        <p>{{ $shop->description }}</p>
        <p>お気に入り数: {{ $shop->favorites->count() }}</p>
        <p>価格帯: ¥{{ number_format($shop->price_min) }} ～ ¥{{ number_format($shop->price_max) }}</p>
    </div>
@empty
    <p>該当する店舗は見つかりませんでした。</p>
@endforelse
@endsection