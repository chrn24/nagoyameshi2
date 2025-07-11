<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Category;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
         $keyword = $request->input('keyword');

         $shops = Shop::with('category')
         ->when($keyword, function($query, $keyword) {
            $query->where('name', 'like', '%' . $keyword . '%');
         })
         ->get();

        return view('admin.shops.index', compact('shops', 'keyword'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.shops.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $validated = $request->validate([
        'category_id' => 'required|exists:categories,id',
        'name' => 'required|string|max:100',
        'imagePath' => 'nullable|string',
        'description' => 'nullable|string',
        'price_min' => 'nullable|integer',
        'price_max' => 'nullable|integer',
        'business_hours' => 'nullable|string|max:100',
        'business_period' => 'nullable|string|max:100',
        'closed_day' => 'nullable|string|max:100',
        'zip_code' => 'nullable|string|max:10',
        'address' => 'nullable|string',
        'phone_number' => 'nullable|string|max:20',
    ]);

   $validated['image'] = $request->input('imagePath');

    // if ($imagePath && \Storage::disk('public')->exists($imagePath)) {
    //     // 保存先パスを決める（例：shops/ フォルダ）
    //     $finalPath = 'shops/' . basename($imagePath);
    //     \Storage::disk('public')->move($imagePath, $finalPath);
    //     $validated['image'] = $finalPath; // 画像パスをDB保存用にセット
    // }

    Shop::create($validated);
    return redirect()->route('admin.shops.index')->with('success', '店舗を登録しました');
    }

    public function confirm(Request $request)
{
    $request->flash(); // oldデータ保持
    $validated = $request->validate([
        'category_id' => 'required|exists:categories,id',
        'image' => 'nullable|image|max:45',
        'name' => 'required|string|max:100',
        'description' => 'nullable|string',
        'price_min' => 'nullable|integer',
        'price_max' => 'nullable|integer',
        'business_hours' => 'nullable|string|max:100',
        'business_period' => 'nullable|string|max:100',
        'closed_day' => 'nullable|string|max:100',
        'zip_code' => 'nullable|string|max:10',
        'address' => 'nullable|string',
        'phone_number' => 'nullable|string|max:20',
    ]);
    $imagePath = null;

    // 画像一時保存
    if ($request->hasFile('image')) {
        // $imagePath = $request->file('image')->store('temp', 'public');
        $imagePath = base64_encode(file_get_contents($request->image->getRealPath()));
    }

    return view('admin.shops.confirm', [
        'input' => $validated,
        'imagePath' => $imagePath,
    ]);
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $shop = Shop::findOrFail($id);
        $categories = Category::all();
        return view('admin.shops.edit', compact('shop', 'categories'));
    }

    public function editConfirm(Request $request, $id)
{
    $shop = Shop::findOrFail($id);

    $validated = $request->validate([
        'category_id' => 'required|exists:categories,id',
        'name' => 'required|string|max:100',
        'image' => 'nullable|image|max:45',
        'description' => 'nullable|string',
        'price_min' => 'nullable|integer',
        'price_max' => 'nullable|integer',
        'business_hours' => 'nullable|string|max:100',
        'business_period' => 'nullable|string|max:100',
        'closed_day' => 'nullable|string|max:100',
        'zip_code' => 'nullable|string|max:10',
        'address' => 'nullable|string',
        'phone_number' => 'nullable|string|max:20',
    ]);

    $imagePath = null;

    if ($request->hasFile('image')) {
        $imagePath = base64_encode(file_get_contents($request->image->getRealPath()));
    }

    return view('admin.shops.editconfirm', [
        'shopId' => $shop->id,
        'input' => $validated,
        'imagePath' => $imagePath,
    ]);
}


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
{
    $shop = Shop::findOrFail($id);

    $validated = $request->validate([
        'category_id' => 'required|exists:categories,id',
        'name' => 'required|string|max:100',
        'image' => 'nullable|image|max:45',
        'description' => 'nullable|string',
        'price_min' => 'nullable|integer',
        'price_max' => 'nullable|integer',
        'business_hours' => 'nullable|string|max:100',
        'business_period' => 'nullable|string|max:100',
        'closed_day' => 'nullable|string|max:100',
        'zip_code' => 'nullable|string|max:10',
        'address' => 'nullable|string',
        'phone_number' => 'nullable|string|max:20',
    ]);

//     // 画像アップロード
//     if ($request->hasFile('image')) {
//     $imagePath = $request->file('image')->store('shops', 'public');
//     $validated['image'] = $imagePath;
//    } elseif ($request->filled('imagePath')) {
//     $tempPath = $request->input('imagePath');
//     $finalPath = 'shops/' . basename($tempPath);
//     \Storage::disk('public')->move($tempPath, $finalPath);
//     $validated['image'] = $finalPath;
//   }

 $validated['image'] = $request->input('imagePath');


    $shop->update($validated);

    return redirect()->route('admin.shops.index')->with('success', '店舗情報を更新しました');
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Shop::destroy($id);
        return redirect()->route('admin.shops.index')->with('success', '店舗を削除しました');
    }
}
