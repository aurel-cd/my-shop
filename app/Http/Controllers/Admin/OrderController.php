<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderDetails;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class OrderController extends Controller
{
    public function orderList(){
        return view('admin.orders');
    }
    public function orderDatatable(){
        $orders = OrderDetails::with(['orderItems'])->get();


        foreach ($orders as $order){

            $order['item_number'] = count($order->orderItems);
            $client = User::where('id', $order->user_id)->first();
            $order['clientEmail'] = $client->email;

        }
        return DataTables::of($orders)
            ->addIndexColumn()
            ->addColumn('client', function ($order) {
                return $order['clientEmail'];
            })
            ->addColumn('title', function ($order) {
                return $order->order_title;
            })
            ->addColumn('quantity', function ($order) {
                return $order['item_number'];
            })
            ->addColumn('status', function ($order) {
                return $order['status'];
            })
            ->addColumn('price', function ($order) {
                return $order->total_price;
            })
            ->addColumn('country', function ($order) {
                return $order->country;
            })
            ->addColumn('date', function ($order) {
                return $order->created_at->format('Y-m-d H:i:s');
            })
            ->addColumn('action', function ($order) {
                // Add the necessary HTML for the action column
                // For example, edit and delete buttons
                $actionBtn = '<div class="inline-flex">
                            <button type="button" id="' . $order->id . '" class="px-2 viewOrder shadow-lg text-white inline-flex items-center bg-[#2c7da0]  hover:bg-[#61a5c2] focus:ring-4 focus:outline-none focus:ring-[#61a5c2] font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
<svg class="w-5 h-5 dark:text-gray-800 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 14">
    <g stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
      <path d="M10 10a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/>
      <path d="M10 13c4.97 0 9-2.686 9-6s-4.03-6-9-6-9 2.686-9 6 4.03 6 9 6Z"/>
    </g>
  </svg>                            </button></div>';
                return $actionBtn;
            })
            ->rawColumns(['client','title','quantity','price', 'country', 'date','action'])
            ->make(true);
    }

    public function showOrderDetails(Request $request){
        $order_id = $request->id;

        $order = OrderDetails::where('id',$order_id)->with(['orderItems'])->first();

        foreach ($order->orderItems as $item) {
            $product = Product::with(['productEntries', 'images'])->find($item->product_id);
            if ($product) {
                $items[] = $product;
            }
        }

        $order['items'] = $items;


        if (!$order) {
            return response()->json([
                'message' => 'Internal Server Error',
            ], 500);
        }
        return response()->json([
            'message' => 'Data retrieved Succesfully',
            'data' => $order,

        ]);
    }
}
