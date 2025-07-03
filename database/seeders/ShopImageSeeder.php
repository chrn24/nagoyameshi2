<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShopImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // public/images/shops 配下の画像ファイル名を取得
        $imageFiles = glob(public_path('images/shops/*.jpg'));

        // 画像ファイル名だけを抽出（パスを除く）
        $imageNames = array_map(function ($path) {
            return 'images/shops/' . basename($path);
        }, $imageFiles);

        // shops テーブルのすべてのレコードを取得
        $shops = DB::table('shops')->get();

        // 各ショップにランダムな画像を設定
        foreach ($shops as $shop) {
            $randomImage = $imageNames[array_rand($imageNames)];

            DB::table('shops')
              ->where('id', $shop->id)
              ->update(['image' => $randomImage]);
        }
    }
}
