<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name',
        'product_description',
        'product_price',
        'product_quantity',
        'product_images',
        'product_video'
    ];

      // Define the relationship to Orders_items
      public function orderItems()
      {
          return $this->hasMany(Orders_items::class, 'product_id');
      }
}
