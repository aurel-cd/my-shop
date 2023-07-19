<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\OrderDetails;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class OrderController extends Controller
{
    public function orders()
    {
        return view('user.orders');
    }
    public function orderDatatable()
    {
        $userId = Auth::user()->id;

        $orders = OrderDetails::with(['orderItems'])->where('user_id', $userId)->get();


        foreach ($orders as $order) {
            $order['quantity'] = count($order->orderItems);

        }

        return DataTables::of($orders)
            ->addIndexColumn()

            ->addColumn('title', function ($order) {
                return $order->order_title;
            })
            ->addColumn('quantity', function ($order) {
                return $order['quantity'];
            })
            ->addColumn('price', function ($order) {
                return $order->total_price;
            })
            ->addColumn('status', function ($order) {
                return $order->status;
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
                if($order->status == 'paid') {
                    $actionBtn = '<div class="inline-flex mx-2">
                            <button type="button" id="' . $order->id . '" class="px-2 mx-2 viewOrder shadow-lg text-white inline-flex items-center bg-[#2c7da0]  hover:bg-[#61a5c2] focus:ring-4 focus:outline-none focus:ring-[#61a5c2] font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
<svg class="w-5 h-5 dark:text-gray-800 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 14">
    <g stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
      <path d="M10 10a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/>
      <path d="M10 13c4.97 0 9-2.686 9-6s-4.03-6-9-6-9 2.686-9 6 4.03 6 9 6Z"/>
    </g>
  </svg>                            </button>
  <button type="button" id="' . $order->id . '" class="cancellation shadow-lg inline-flex items-center text-white bg-red-600 hover:bg-red-100 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-900">
                            <svg aria-hidden="true" class="w-5 h-5 " fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                            </button></div>';
                }else{
                    $actionBtn = '<div class="inline-flex mx-2">
                            <button type="button" id="' . $order->id . '" class="px-2 mx-2 viewOrder shadow-lg text-white inline-flex items-center bg-[#2c7da0]  hover:bg-[#61a5c2] focus:ring-4 focus:outline-none focus:ring-[#61a5c2] font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
<svg class="w-5 h-5 dark:text-gray-800 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 14">
    <g stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
      <path d="M10 10a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/>
      <path d="M10 13c4.97 0 9-2.686 9-6s-4.03-6-9-6-9 2.686-9 6 4.03 6 9 6Z"/>
    </g>
  </svg>                            </button>
</div>';
                }
                return $actionBtn;
            })
            ->rawColumns(['title','quantity','price', 'status','country', 'date','action'])
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
