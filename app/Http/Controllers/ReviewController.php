<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\Review;
use App\Models\Shop;

class ReviewController extends Controller
{
    public function create(Shop $shop)
    {
        return view('reviews.create', compact('shop'));
    }

    public function confirm(Request $request)
    {
        $validated = $request->validate([
            'shop_id' => 'required|exists:shops,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        return view('reviews.confirm', ['review' => $validated]);
    }

    public function store(Request $request)
    {
        if ($request->has('back')) {
            return redirect()->route('reviews.create', ['shop' => $request->shop_id])
                             ->withInput();
        }

        Review::create([
            'user_id' => Auth::id(),
            'shop_id' => $request->shop_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return redirect()->route('shops.show', $request->shop_id)->with('message', 'レビューを投稿しました！');
    }


    public function edit(Review $review)
{
    // 認可チェック（オプション）
    if (Auth::id() !== $review->user_id) {
        abort(403);
    }

    return view('reviews.edit', compact('review'));
}

public function updateConfirm(Request $request)
{
    $validated = $request->validate([
        'review_id' => 'required|exists:reviews,id',
        'rating' => 'required|integer|min:1|max:5',
        'comment' => 'nullable|string|max:1000',
    ]);

    $review = Review::findOrFail($validated['review_id']);

    if (Auth::id() !== $review->user_id) {
        abort(403);
    }

    return view('reviews.editconfirm', [
        'review' => $review,
        'input' => $validated,
    ]);
}


public function update(Request $request)
{
    if ($request->has('back')) {
        return redirect()->route('reviews.edit', ['review' => $request->review_id])->withInput();
    }

    $review = Review::findOrFail($request->review_id);

    if (Auth::id() !== $review->user_id) {
        abort(403);
    }

    $review->update([
        'rating' => $request->rating,
        'comment' => $request->comment,
    ]);

    return redirect()->route('shops.show', $review->shop_id)->with('message', 'レビューを更新しました！');
}


    public function destroy(Review $review)
   {
     $review->delete();
     return redirect()->back()->with('message', 'レビューを削除しました');
 }


}
