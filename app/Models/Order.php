<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_date',
        'bill_status',
        'order_type',
        'table',
        'payment_method',
        'user_id',
    ];

    public function getOrderTypeAttribute($attribute){
        return $this->isOrderTypeOptions()[$attribute] ?? 0;
    }
    public function isOrderTypeOptions(){
        return [
            1 => 'Dine-In',
            0 => 'Takeaway',
        ];
    }

    public function getBillStatusAttribute($attribute){
        return $this->isBillStatusOptions()[$attribute] ?? 0;
    }

    public function isBillStatusOptions(){
        return [
            2 => 'Paying',
            1 => 'Confirmed',
            0 => 'Pending',
        ];
    }

    public function products(){
        return $this->belongsToMany(Product::class)->withPivot('qty')->withTimestamps();
    }
}
