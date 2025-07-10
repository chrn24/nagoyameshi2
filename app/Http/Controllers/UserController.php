<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function mypage()
{
    $user = auth()->user();
    
    return view('users.mypage', compact('user'));
}

public function show()
{
    $user = Auth::user();
    return view('users.show', compact('user'));
}

public function edit()
{
    $user = Auth::user();
    return view('users.edit', compact('user'));
}

public function update(Request $request)
{
    $user = Auth::user();

    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'zip_code' => 'nullable|string|max:10',
        'address' => 'nullable|string|max:255',
        'phone_number' => 'nullable|string|max:20',
    ]);

    $user->update($validated);

    return redirect()->route('users.show')->with('success', '登録情報を更新しました。');
}

public function favoriteShops()
{
    $user = auth()->user();
    $favoriteShops = $user->favorites()->with('reservations')->get();

    return view('users.favorite', compact('favoriteShops'));
}



}
