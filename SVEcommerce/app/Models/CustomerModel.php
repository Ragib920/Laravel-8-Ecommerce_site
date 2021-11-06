<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerModel extends Model
{
    use HasFactory;
    protected $table = 'customers';
    protected $fillable = [
        'name',
        'email',
        'mobile',
        'password',
        'address',
        'city',
        'state',
        'zip',
        'company',
        'gstin',
        'status',
    ];
}
