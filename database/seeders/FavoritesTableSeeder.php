<?php

namespace Database\Seeders;
use App\Models\Favorite;
use App\Models\User;
use App\Models\Shop;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FavoritesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $users = User::all();
         $shops = Shop::all();

     foreach ($users as $user) {
        // ユーザーごとに3件ランダムにお気に入り登録（重複防止も兼ねて）
        $favoriteShops = $shops->random(3);

        foreach ($favoriteShops as $shop) {
            Favorite::create([
                'user_id' => $user->id,
                'shop_id' => $shop->id,
            ]);
        }
    }
    }
}
