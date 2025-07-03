<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
        ['name' => 'ラーメン'],
    ['name' => 'カフェ'],
    ['name' => '焼肉'],
    ['name' => '寿司'],
    ['name' => '居酒屋'],
    ['name' => '洋食'],
    ['name' => '中華'],
    ['name' => 'スイーツ'],
    ['name' => 'フレンチ'],
    ['name' => 'イタリアン'],
    ['name' => 'バー'],
    ['name' => '揚げ物'],
    ['name' => '定食・食堂'],
    ['name' => 'ファーストフード'],
    ['name' => '焼き鳥'],
    ['name' => '海鮮料理'],
    ['name' => '鉄板焼き'],
    ['name' => '韓国料理'],
    ]);
    }
}
