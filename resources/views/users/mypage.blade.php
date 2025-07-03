
@extends('layouts.app')

@section('content')
<h2>マイページ</h2>
<a href="{{ route('users.show') }}">登録情報を確認</a>

{{-- 無料会員のみ表示 --}}
@auth
    @if (auth()->user()->isFree())
        <a href="{{ route('users.upgrade') }}">有料会員へアップグレード</a>
    @endif
@endauth


{{-- 有料会員のみ表示 --}}
@auth
    @if  (auth()->user()->isPremium())
        <a href="{{ route('subscription.edit') }}">クレジットカード情報を編集する</a> 
        <a href="{{ route('subscription.cancel') }}">有料プランを解約する</a>
        <a href="{{ route('reservations.index') }}">予約一覧</a>
        <a href="{{ route('favorites.index') }}">お気に入り一覧</a>
    @endif
@endauth


@endsection