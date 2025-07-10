<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Reservation;
use App\Models\User;

class Shop extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'image',
        'description',
        'price_min',
        'price_max',
        'business_hours',
        'business_period',
        'closed_day',
        'zip_code',
        'address',
        'phone_number',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function reviews()
    {
     return $this->hasMany(Review::class);
    }

    public function favorited_users()
   {
     return $this->belongsToMany(User::class, 'favorites', 'shop_id', 'user_id')->withTimestamps();
   }

   public function reservations()
{
    return $this->hasMany(Reservation::class);
}

public function favoredByUsers()
{
    return $this->belongsToMany(User::class, 'favorites');
}


}
