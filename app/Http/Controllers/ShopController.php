<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Category;


class ShopController extends Controller
{
    
     public function top()
    {
         $categories = Category::all(); 
         $popularShops = Shop::with('category')
        ->withCount('favorites')
        ->orderByDesc('favorites_count')
        ->take(6)
        ->get();


         return view('index', compact('categories', 'popularShops'));
         
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $categoryId = $request->input('category_id');

        $shops = Shop::with('category')           // カテゴリ取得
                     ->withCount('favorites')     // お気に入り数取得
                     ->when($keyword, function ($query, $keyword) {
                         $query->where('name', 'like', "%{$keyword}%");
                     })
                     ->when($categoryId, function ($q) use ($categoryId) {
                         $q->where('category_id', $categoryId);
                     })
                     ->get();

        return view('shops.index', compact('shops', 'keyword','categoryId'));
    }

    public function show(Shop $shop)
   {
      $shop->load(['category', 'favorites', 'reviews']);

      // ユーザーがお気に入り登録済みかをチェック
    $favorited = false;
    if (auth()->check()) {
        $favorited = auth()->user()
            ->favorite_shops()
            ->where('shop_id', $shop->id)
            ->exists();
    }
      return view('shops.show', compact('shop', 'favorited'));
   }
}
