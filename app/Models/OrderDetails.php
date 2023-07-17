<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class OrderDetails extends Model
{
    use HasFactory;
    protected $fillable = [
        'total_price',
        'session_id',
        'order_title',
        'country',
        'status',
        'created_at',
        'updated_at',
        'id',
        'payment_id',
    ];
    public function orderItems()
    {

        return $this->belongsToMany(OrderItem::class);
    }
}
