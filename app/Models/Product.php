<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'maker',
        'category',
        'status',
        'remarks',
        'start_date',
        'end_date',
    ];

    public function skus()
    {
        return $this->hasMany(ProductSku::class)->orderBy('sku', 'asc');
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function files()
    {
        return $this->hasMany(ProductFile::class);
    }
}
