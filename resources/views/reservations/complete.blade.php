@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="text-center display-6 reservation-title mb-4"><strong>予約が完了しました</strong></h2>

    <div class="row justify-content-center">
        <div class="col-md-6 text-center">
            <p class="mb-4">ご来店を心よりお待ちしております。</p>
            <a href="{{ route('top') }}" class="btn btn-primary w-30">トップページへ戻る</a>
        </div>
    </div>
</div>
@endsection