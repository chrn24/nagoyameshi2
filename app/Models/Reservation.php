<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Shop;

class Reservation extends Model
{
    use HasFactory;

     protected $fillable = [
        'user_id',
        'shop_id',
        'reservation_date',
        'number_of_people',
        

    ];

    public function shop()
{
    return $this->belongsTo(Shop::class);
}

}
