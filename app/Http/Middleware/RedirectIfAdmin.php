<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAdmin
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        // 管理者ならリダイレクト
        if ($user && $user->is_admin) {
            return redirect('/'); // または管理者専用ページなど
        }

        return $next($request);
    }
}
