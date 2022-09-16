<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name',
        'price',
        'color',
        'stock',
        'quantity',
        'discount',
        'star',
        'max_count_per_month',
        'has_min',
        'min',
        'has_max',
        'max',
        'sales_number',
        'user_id',
        ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
