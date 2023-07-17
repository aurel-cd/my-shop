<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderPivot extends Model
{
    use HasFactory;
    protected $table ='order_details_order_item';
    protected $fillable = [
        'order_id',
        'order_item_id'
    ];
    public static function boot()
    {
        parent::boot();

    }
}
