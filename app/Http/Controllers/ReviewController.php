<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{
    public function create($shopId)
{
    return view('reviews.create', compact('shopId'));
}

public function edit(Review $review)
{
    return view('reviews.edit', compact('review'));
}

public function destroy(Review $review)
{
    $review->delete();
    return redirect()->back()->with('message', 'レビューを削除しました');
}


}
