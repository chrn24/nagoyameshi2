@extends('admin.layouts.app')

@section('content')
<h2>サブスク売上一覧</h2>
<br>
<div class="mb-3">
    <h3><strong>売上合計：</strong> ¥{{ number_format($totalRevenue) }}</h3>
</div>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ユーザー名</th>
            <th>プラン名</th>
            <th>金額</th>
            <th>決済日</th>
            <th>ステータス</th>
        </tr>
    </thead>
    <tbody>
        @foreach($subscriptions as $subscription)
        <tr>
            <td>{{ $subscription->user->name ?? '不明' }}</td>
            <td>{{ $subscription->name }}</td>
            <td>¥{{ number_format($subscription->price_amount ?? 0) }}</td>
            <td>{{ \Carbon\Carbon::parse($subscription->created_at)->format('Y/m/d') }}</td>
            <td>{{ $subscription->stripe_status }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
