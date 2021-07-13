<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'image',
        'category_name',
        'sale_price',
        'cost_price',
    ];

    use HasFactory;

    public function orders(){
        return $this->belongsToMany(Order::class)->withPivot('qty')->withTimestamps();
    }
}
