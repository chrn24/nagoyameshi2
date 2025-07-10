@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="text-center mb-4">📅 予約一覧</h2>

    @if ($reservations->isEmpty())
        <p class="text-center">現在、予約はありません。</p>
    @else
        <div class="row justify-content-center">
            @foreach ($reservations as $reservation)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <a href="{{ route('shops.show', $reservation->shop->id) }}">
                            <img src="{{ asset('storage/' . $reservation->shop->image) }}"
                                 class="card-img-top"
                                 alt="{{ $reservation->shop->name }}"
                                 style="height: 200px; object-fit: cover;">
                        </a>
                        <div class="card-body text-start">
                            <h5 class="card-title">
                                <strong>店舗名：</strong>
                                <a href="{{ route('shops.show', $reservation->shop->id) }}" class="shop-name-link">
                                    {{ $reservation->shop->name }}
                                </a>
                            </h5>
                            <p class="mb-1"><strong>予約日時:</strong> {{ \Carbon\Carbon::parse($reservation->reservation_date)->format('Y年m月d日 H:i') }}</p>
                            <p class="mb-0"><strong>人数:</strong> {{ $reservation->number_of_people }} 名</p>

                            <div class="text-center mt-2">

                             <form action="{{ route('reservations.cancel', $reservation->id) }}" method="POST" class="mt-2">
                             @csrf
                             @method('DELETE')
                             <button type="submit" class="btn btn-primary btn-sm" onclick="return confirm('本当にキャンセルしますか？');">キャンセル</button>
                             </form>
                           </div>
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
