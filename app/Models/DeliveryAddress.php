<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryAddress extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'da_first_name',
        'da_last_name',
        'da_first_kana', 
        'da_last_kana',
        'da_com_name',
        'da_postal_code',
        'da_prefecture', 
        'da_address1',
        'da_address2',
        'da_phone_number',
    ];
    public function user()
    {
        return $this->belongTo(User::class);
    }
}
