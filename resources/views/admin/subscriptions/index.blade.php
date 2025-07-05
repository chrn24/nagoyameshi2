@extends('admin.layouts.app') 

@section('content')
<h2>サブスクリプション売上一覧</h2>

<div class="mb-3">
    <strong>売上合計：¥{{ number_format($totalAmount) }}</strong>
</div>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>顧客メール</th>
            <th>金額</th>
            <th>支払い状況</th>
            <th>請求日</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($invoices as $invoice)
            <tr>
                <td>{{ $invoice->customer_email ?? 'N/A' }}</td>
                <td>¥{{ number_format($invoice->amount_paid) }}</td>
                <td>{{ ucfirst($invoice->status) }}</td>
                <td>{{ \Carbon\Carbon::createFromTimestamp($invoice->created)->toDateTimeString() }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
