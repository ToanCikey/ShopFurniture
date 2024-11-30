<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $table = 'product_img';
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}