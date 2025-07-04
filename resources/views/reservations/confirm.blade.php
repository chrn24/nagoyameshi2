@extends('layouts.app')

@section('content')
<div class="container">
    <br>
    <h2 class="text-center display-6 reservation-title mb-4"><strong>予約内容確認画面</strong></h2>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <form method="POST" action="{{ route('reservations.store') }}" class="p-4 border rounded bg-light">
                @csrf
                <input type="hidden" name="shop_Id" value="{{ session('reservation_data.shopId') }}">

                <div class="mb-3">
                    <label class="form-label fw-bold">日付</label>
                    <p class="form-control-plaintext">{{ $data['reservation_date'] }}</p>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">時間</label>
                    <p class="form-control-plaintext">{{ $data['reservation_time'] }}</p>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">人数</label>
                    <p class="form-control-plaintext">{{ $data['number_of_people'] }}人</p>
                </div>
               <div class="d-flex justify-content-center mt-3">
                  <button type="submit" class="btn btn-success w-50">予約を確定する</button>
               </div>  
            </form>

            @php
                $shopId = session('reservation_data.shopId');
            @endphp

            <div class="d-flex justify-content-center mt-3">
               <a href="{{ route('reservations.create', ['shop' => $shopId]) }}" class="btn btn-secondary w-40">
                  予約内容を修正する
               </a>
            </div>
        </div>
    </div>
</div>
@endsection
