<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSku extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'sku',
        'name',
        'spec',
        'weight',
        'tax_rate',
        'cost_price',
        'sale_price',
        'stock',
        'status',
        'start_date',
        'end_date',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
