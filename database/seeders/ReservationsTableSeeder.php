<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Shop;
use App\Models\Reservation;



class ReservationsTableSeeder extends Seeder
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
        $selectedShop = $shops->random();

        Reservation::factory()->create([
            'user_id' => $user->id,
            'shop_id' => $selectedShop->id,
            'reservation_date' => now()->addDays(rand(1, 30))->setTime(rand(11, 19), [0, 30][rand(0, 1)]),
        ]);
    } 
    }
}
