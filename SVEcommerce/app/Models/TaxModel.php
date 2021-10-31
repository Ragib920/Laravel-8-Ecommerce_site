<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaxModel extends Model
{
    use HasFactory;
    protected $table = 'taxes';
    protected $fillable = [
        'tax_desc',
        'tax_value',
        'status',
    ];
}
