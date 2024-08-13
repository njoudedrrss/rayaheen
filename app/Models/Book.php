<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
     protected $fillable = ['title', 'description', 'author', 'publisher', 'year', 'price', 'cover_image', 'category_id','count'];

    public function category()
    {
        return $this->belongsTo(category::class);
    }
}
