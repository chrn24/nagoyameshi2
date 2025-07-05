<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Invoice;

class SubscriptionController extends Controller
{
  public function index()
    {
        // StripeのAPIキー設定
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        // 最新50件の請求情報を取得
        $invoiceList = \Stripe\Invoice::all(['limit' => 50]);

        // 支払済みの請求のみを抽出
        $filteredInvoices = collect($invoiceList->data)->filter(function ($invoice) {
            return $invoice->amount_paid ; 
        });

        // 売上合計
        $totalAmount = $filteredInvoices->sum(function ($invoice) {
            return $invoice->amount_paid; 
        });

        return view('admin.subscriptions.index', [
            'invoices' => $filteredInvoices,
            'totalAmount' => $totalAmount
        ]);
    }
    

 }

