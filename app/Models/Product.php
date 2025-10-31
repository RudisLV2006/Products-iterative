<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Product extends Model
{
    use HasFactory;
    protected $fillable = ["name","quantity","description","expiration_date","status"];

    protected $table = 'products';

    protected $casts = [
        'expiration_date' => 'datetime', // ✅ ensures Carbon instance
    ];
}
