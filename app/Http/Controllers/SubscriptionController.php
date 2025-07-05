<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
  
    public function create()
{
    $intent = Auth::user()->createSetupIntent();

    return view('subscription.create', [
        'intent' => $intent,
    ]);
}

public function store(Request $request)
{
    $user = $request->user();
    $priceId = 'price_1ReV1jD5Qlq0dVs6KhZZsjqz';

    // Stripeのサブスクリプションを作成
    $user->newSubscription('premium_plan',  $priceId) 
         ->create($request->input('paymentMethodId'));

    //  Stripeからprice情報を取得
    \Stripe\Stripe::setApiKey(config('services.stripe.secret'));
    $price = \Stripe\Price::retrieve($priceId);
    $amountYen = $price->unit_amount / 100; 


    // フラッシュメッセージとともにトップページへリダイレクト
    return redirect('/')
        ->with('flash_message', '有料プランへの登録が完了しました。');
}

public function edit()



{
    $user = Auth::user();
    $intent = $user->createSetupIntent();

    return view('subscription.edit', [
        'user' => $user,
        'intent' => $intent,
    ]);
}

public function update(Request $request)
{
    $user = $request->user();

    // 新しい支払い方法でデフォルトを更新
    $user->updateDefaultPaymentMethod($request->paymentMethodId);

    // フラッシュメッセージをつけてトップページにリダイレクト
    return redirect('/')
        ->with('flash_message', 'お支払い方法を変更しました。');
}

public function cancel()
{
    return view('subscription.cancel');
}

public function destroy(Request $request)
{
    $user = $request->user();

    // 'premium_plan' という名前のサブスクリプションを即時キャンセル
    $user->subscription('premium_plan')->cancelNow();

    return redirect('/')
        ->with('flash_message', '有料プランを解約しました。');
}


}
