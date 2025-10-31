<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ["name","quantity","description","expiration_date","status"];

    protected $table = 'products';

    protected $casts = [
        'expiration_date' => 'datetime', // ✅ ensures Carbon instance
    ];
}
