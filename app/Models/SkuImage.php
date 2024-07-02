<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkuImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_sku_id',
        'image_path',
    ];

    public function productSku()
    {
        return $this->belongsTo(ProductSku::class);
    }
}
