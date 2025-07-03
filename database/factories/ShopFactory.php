<?php

namespace Database\Factories;
use Faker\Factory as FakerFactory;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Shop>
 */
class ShopFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
{
    $faker = FakerFactory::create('ja_JP');

   $firstPart = $faker->randomElement([
    $faker->lastName,
    $faker->city,
]);

    $secondParts = ['食堂', 'バル', 'カフェ', '亭', 'ダイナー', 'キッチン', '寿司', '焼肉', 'うどん屋'];
    $hours = ['11:00～20:00', '10:00～22:00', '17:00～25:00', '24時間営業'];
    $periods = ['通年営業', '平日のみ営業', '週末のみ営業'];
    $closed = ['月曜','火曜','金曜', '水曜', '木曜', '不定休', '年中無休'];

    return [
        'category_id' => \App\Models\Category::inRandomOrder()->first()?->id ?? 1,
        'name' => $firstPart . $faker->randomElement($secondParts),
        'image' => null,
        'description' => $faker->realText(100),
        'price_min' => rand(800, 2000),
        'price_max' => rand(2500, 20000),
        'business_hours' => $faker->randomElement($hours),
        'business_period' => $faker->randomElement($periods),
        'closed_day' => $faker->randomElement($closed),
        'zip_code' => $faker->postcode(),
        'address' => $faker->address(),
        'phone_number' => $faker->phoneNumber(),
    ];
}
}
