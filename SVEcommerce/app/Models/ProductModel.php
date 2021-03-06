<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    use HasFactory;
    protected $table = 'product';
    protected $fillable = [
        'category_id',
        'name',
        'image',
        'brand',
        'model',
        'short_desc',
        'desc',
        'keywords',
        'technical_specification',
        'uses',
        'warranty',
        'lead_time',
        'tax_id',
        'is_promo',
        'is_featured',
        'is_discounted',
        'is_trending',
        'status',
    ];
}
