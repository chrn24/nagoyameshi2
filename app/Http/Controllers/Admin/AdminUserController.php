<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index(Request $request)
{
     // ベースクエリ：subscriptionを事前ロード
    $query = User::with('subscriptions');

    // メールアドレスで絞り込み
    if ($request->filled('email')) {
        $query->where('email', 'like', '%' . $request->email . '%');
    }

    // クエリを実行してユーザー一覧を取得
    $users = $query->get();

    $users = $users->map(function ($user) {
        $latestSub = $user->subscriptions->sortByDesc('created_at')->first();
        $user->membership_status = match (true) {
            !$latestSub => '無料会員',
            $latestSub->stripe_status === 'active' => '有料会員',
            default => '無料会員'
        };
        return $user;
    });

    return view('admin.users.index', compact('users'));
}
}
