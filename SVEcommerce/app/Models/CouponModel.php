<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CouponModel extends Model
{
    use HasFactory;
    protected $table = 'coupon';
    protected $fillable = [
        'title',
        'code',
        'value',
    ];
}
