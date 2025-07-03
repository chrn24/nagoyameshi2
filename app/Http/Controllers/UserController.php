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

}
