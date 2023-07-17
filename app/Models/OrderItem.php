<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_quantity',
        'created_at',
        'updated_at',
        'order_id',
        'product_id',
    ];
    public function orderDetails()
    {
        return $this->hasMany(OrderItem::class)
            ->using(OrderPivot::class);
    }
}
