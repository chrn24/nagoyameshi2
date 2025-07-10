@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="text-center display-6 mb-4"><strong>マイページ</strong></h2>

    <div class="row justify-content-center w-50 mx-auto">
        <div class="col-md-8">
            
                <ul class="list-group">
                    {{-- ユーザー名 --}}

                    {{-- 共通リンク --}}
                    <li class="list-group-item">
                        <a href="{{ route('users.show') }}" class="text-decoration-none">登録情報を確認</a>
                    </li>

                    {{-- 無料会員リンク --}}
                    @auth
                        @if (auth()->user()->isFree())
                            <li class="list-group-item">
                                <a href="{{ route('users.upgrade') }}" class="text-decoration-none">有料会員へアップグレード</a>
                            </li>
                        @endif
                    @endauth

                    {{-- 有料会員リンク --}}
                    @auth
                        @if (auth()->user()->isPremium())

                            <li class="list-group-item">
                                <a href="{{ route('reservations.index') }}" class="text-decoration-none">予約一覧</a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{ route('users.favorites') }}" class="text-decoration-none">お気に入り一覧</a>
                            </li>

                            <li class="list-group-item">
                                <a href="{{ route('subscription.edit') }}" class="text-decoration-none">クレジットカード情報を編集する</a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{ route('subscription.cancel') }}" class="text-decoration-none link-danger">有料プランを解約する</a>
                            </li>
                            
                        @endif
                    @endauth

                </ul>
            
        </div>
    </div>

    <div class="text-center mt-4">
        <a href="{{ route('top') }}" class="btn btn-primary">トップページに戻る</a>
    </div>
</div>
@endsection
