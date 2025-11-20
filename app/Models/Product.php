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

    public function increaseQuantity()
    {
        $this->quantity += 1;
        $this->save();
    }

    /**
     * Samazina produkta daudzumu par 1, ja tas ir lielāks par 0.
     */
    public function decreaseQuantity()
    {
        if ($this->quantity > 0) {
            $this->quantity -= 1;
            $this->save();
        }
    }
}
