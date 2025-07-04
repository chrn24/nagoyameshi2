@extends('layouts.app')

@section('content')
<div class="container">
    <br>
    <h2 class="text-center display-6 reservation-title mb-4"><strong>予約画面</strong></h2>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <form method="POST" action="{{ route('reservations.confirm') }}" class="p-4 border rounded bg-light">
                @csrf

                <div class="mb-3">
                    <label class="form-label">日付</label>
                    <input type="date" name="reservation_date" class="form-control"
    value="{{ old('reservation_date', $data['reservation_date'] ?? '') }}"
    min="{{ \Carbon\Carbon::today()->toDateString() }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">時間</label>
                    <input type="time" name="reservation_time" class="form-control"
                        value="{{ old('reservation_time', $data['reservation_time'] ?? '') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">人数</label>
                    <input type="number" name="number_of_people" class="form-control"
                        value="{{ old('number_of_people', $data['number_of_people'] ?? '') }}">
                </div>
                <br>

                <div class="d-flex justify-content-center mt-3">

                 <button type="submit" class="btn btn-primary w-50">確認する</button>
                 <input type="hidden" name="shop_Id" value="{{ $shopId ?? '' }}">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
