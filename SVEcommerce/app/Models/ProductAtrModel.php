<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAtrModel extends Model
{
    use HasFactory;
    protected $table = 'productAtr';
    protected $fillable = [
        'sku',
        'attr_image',
        'mrp',
        'price',
        'quantity',
        'size_id',
        'color_id',
        'product_id',
    ];
}
