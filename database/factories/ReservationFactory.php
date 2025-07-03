<?php

namespace Database\Factories;
use App\Models\User;
use App\Models\Shop;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservation>
 */
class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => User::inRandomOrder()->first()?->id ?? 1,
            'shop_id' => Shop::inRandomOrder()->first()?->id ?? 1,
            'reservation_date' => $this->faker->dateTimeBetween('+1 days', '+30 days'),
            'number_of_people' => $this->faker->numberBetween(1, 6),
        ];
    }
}
