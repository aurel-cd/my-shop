<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\OrderDetails;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function showOrders(){
        $orders = OrderDetails::with('orderItems')->get();
        return $orders;
    }

    public function showOrder(OrderDetails $order){
        return $order::with('orderItems')->first();
    }
}
