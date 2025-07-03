@extends('layouts.app')
@section('content')
<h1>予約内容確認画面</h1>

<form method="POST" action="{{ route('reservations.store') }}" class="p-4">
    @csrf
    <p>日付：{{ $data['reservation_date'] }}</p>
    <p>時間：{{ $data['reservation_time'] }}</p>
    <p>人数：{{ $data['number_of_people'] }}人</p>

    <button type="submit" class="btn btn-success">予約を確定する</button>
</form>

@php
    $shopId = session('reservation_data.shopId');
@endphp

<a href="{{ route('reservations.create', ['shop' => $shopId]) }}" class="btn btn-secondary mt-3">戻って修正する</a>

@endsection