<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = \App\Models\Category::orderBy('created_at', 'desc')->get();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
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
    'name' => 'required|string|max:100|unique:categories,name,',
], [
    'name.required' => 'カテゴリ名を入力してください。',
    'name.string' => 'カテゴリ名は文字列で入力してください。',
    'name.max' => 'カテゴリ名は100文字以内で入力してください。',
    'name.unique' => 'このカテゴリ名はすでに存在しています。',
]);

    Category::create($validated);

    return redirect()->route('admin.categories.index')->with('success', 'カテゴリを追加しました');
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
        $category = Category::findOrFail($id);
    return view('admin.categories.edit', compact('category'));
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

         $validated = $request->validate([
    'name' => 'required|string|max:100|unique:categories,name,' . $id,
], [
    'name.required' => 'カテゴリ名を入力してください。',
    'name.string' => 'カテゴリ名は文字列で入力してください。',
    'name.max' => 'カテゴリ名は100文字以内で入力してください。',
    'name.unique' => 'このカテゴリ名はすでに存在しています。',
]);

    $category = Category::findOrFail($id);
    $category->update($validated);

    return redirect()->route('admin.categories.index')->with('success', 'カテゴリを更新しました');
  }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'カテゴリを削除しました');
    }
}
