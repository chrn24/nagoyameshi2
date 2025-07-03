@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-center mt-5">
    <div class="card text-center" style="max-width: 600px; width: 100%;">
        <div class="card-body">
            <h2 class="card-title">💎<strong>有料会員へアップグレードのご案内</strong>💎</h2>
            <strong>（月額300円）</strong>
            <br><br>
            <p class="card-text">
                レビュー投稿・編集・削除、お気に入り登録、予約機能など<br>
                <strong>便利な機能がすべて使い放題！</strong><br><br>
                気になるお店を見つけたら、その場でお気に入り＆予約もOK！<br>
                今すぐアップグレードして、<strong>ワンランク上のグルメ体験</strong>をはじめましょう ✨
            </p>
            <br>
            <a href="{{ route('subscription.create') }}" class="btn btn-primary">
                有料会員にアップグレードする
            </a>
        </div>
    </div>
</div>

@endsection