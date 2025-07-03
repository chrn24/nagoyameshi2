@extends('layouts.app')
@section('content')
<h1>予約画面</h1>

<form method="POST" action="{{ route('reservations.confirm') }}" class="p-4">
    @csrf
    <div class="mb-3">
        <label>日付</label>
        <input type="date" name="reservation_date" class="form-control"
               value="{{ old('reservation_date', $data['reservation_date'] ?? '') }}">
    </div>

    <div class="mb-3">
        <label>時間</label>
        <input type="time" name="reservation_time" class="form-control"
               value="{{ old('reservation_time', $data['reservation_time'] ?? '') }}">
    </div>

    <div class="mb-3">
        <label>人数</label>
        <input type="number" name="number_of_people" class="form-control"
               value="{{ old('number_of_people', $data['number_of_people'] ?? '') }}">
    </div>

    <button type="submit" class="btn btn-primary">確認する</button>

</form>

@endsection