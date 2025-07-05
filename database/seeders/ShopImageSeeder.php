<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ShopImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // storageに手動で保存した画像の一覧を取得
        $imageFiles = glob(storage_path('app/public/shops/*.jpg'));

        // shops テーブルのすべてのレコードを取得
        $shops = DB::table('shops')->get();

        foreach ($shops as $shop) {
            $randomImagePath = $imageFiles[array_rand($imageFiles)];
            $newFileName = basename($randomImagePath); // すでに保存済みなのでそのまま使用
            $storagePath = 'shops/' . $newFileName;

            // DBのみ更新
            DB::table('shops')
              ->where('id', $shop->id)
              ->update(['image' => $storagePath]);
        }
    }
}
