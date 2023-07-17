<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderDetails;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    public function index(){
        // Get order details from your database or any other data source
        $orderDetails = OrderDetails::select('order_title', 'total_price')->get();

        // Prepare data for the chart
        $labels = $orderDetails->pluck('order_title');
        $data = $orderDetails->pluck('total_price');

        // Prepare chart dataset
        $dataset = [
            'label' => 'Order Total',
            'data' => $data,
            'backgroundColor' => 'rgba(0, 123, 255, 0.5)',
            'borderColor' => 'rgba(0, 123, 255, 1)',
            'borderWidth' => 1
        ];

        // Return the data as a JSON response
        return response()->json([
            'labels' => $labels,
            'datasets' => [$dataset]
        ]);
    }
    public function itemChart(){
        $soldProducts = OrderItem::select('product_id', DB::raw('SUM(item_quantity) as total_quantity'))
            ->groupBy('product_id')
            ->get();

        $productNames = Product::whereIn('id', $soldProducts->pluck('product_id'))->pluck('product_name');

        $labels = $productNames;
        $data = $soldProducts->pluck('total_quantity');

        return response()->json([
            'label' => 'Sold Products',
            'labels' => $labels,
            'data' => $data,
        ]);
    }

}
