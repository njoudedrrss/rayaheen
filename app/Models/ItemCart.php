<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemCart extends Model
{
    use HasFactory;
    

    protected $fillable = ['cart_id', 'book_id', 'quantity', 'price', 'total_price'];

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    // Update the total price when the quantity or price changes
    protected static function booted()
    {
        static::saving(function ($cartItem) {
            $cartItem->total_price = $cartItem->price * $cartItem->quantity;
        });
    }
}
