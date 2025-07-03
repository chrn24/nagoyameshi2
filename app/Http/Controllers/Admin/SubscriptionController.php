<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserSubscription;

class SubscriptionController extends Controller
{
    public function index()
    {
         $subscriptions = UserSubscription::with('user')
        ->where('stripe_status', 'active')
        ->get();
        $totalRevenue = $subscriptions->sum('price_amount');

        return view('admin.subscriptions.index', compact('subscriptions', 'totalRevenue'));
    }
}
