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

    public function itemChart(Request $request){

        if($request->start_date != null) {
            $startDate = $request->start_date . ' 00:00:00';
            $endDate = $request->end_date . ' 23:59:59';
            $soldProducts = OrderItem::select('product_id', DB::raw('SUM(item_quantity) as total_quantity'))
                ->whereBetween('created_at', [$startDate, $endDate])
                ->groupBy('product_id')
                ->get();
        }else{
            $soldProducts = OrderItem::select('product_id', DB::raw('SUM(item_quantity) as total_quantity'))
                ->groupBy('product_id')
                ->get();
        }

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
