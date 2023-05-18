<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderItem extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'order_id',
        'nomenclature_id',
        'base_price',
        'price_for_sale',
        'quantity',
    ];

    protected $casts = [
        'quantity' => 'double'
    ];

    protected $appends = [
        'total_amount',
        'total_profit',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function nomenclature()
    {
        return $this->belongsTo(Nomenclature::class)->withTrashed();
    }

    public function getTotalAmountAttribute()
    {
        return $this->price_for_sale * $this->quantity;
    }

    public function getTotalProfitAttribute()
    {
        return ($this->price_for_sale - $this->base_price) * $this->quantity;
    }
}
