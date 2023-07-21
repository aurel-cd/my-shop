<?php

namespace App\Http\Controllers;

use App\Events\OrderPlaced;
use App\Events\QuantityUpdated;
use App\Models\OrderDetails;
use App\Models\OrderItem;
use App\Models\OrderItems;
use App\Models\PaymentDetails;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Stripe\PaymentIntent;
use Stripe\Stripe;

class StripeController extends Controller
{

    public function checkout(Request $request)
    {
        $totalPrice = 0;
        $stripeApiKey = env('STRIPE_SECRET_KEY');

        // Initialize the Stripe API client
        \Stripe\Stripe::setApiKey($stripeApiKey);
        $productIds = Session::get('cartItems');
        $userId = Session::get('userId');    //        // Extract the product IDs, prices, and total price from the input

        foreach ($productIds as $productId) {
            $productName[$productId] = Product::where('id', $productId)->first();

            $product_name = ($productName[$productId]->product_name);
            $product_price = $productName[$productId]->price;
            $totalPrice += $product_price;

            $productName[$productId] = [
                'name' => $product_name,
                'price' => $product_price,
            ];

            $lineItems[] = [
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $product_name,
                    ],
                    'unit_amount' => $product_price * 100, // Stripe accepts amounts in cents
                ],
                'quantity' => 1,
            ];
        }
        $session = \Stripe\Checkout\Session::create([
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('cartItems', [], true) . "?session_id={CHECKOUT_SESSION_ID}",
            'cancel_url' => route('cartItems', [], true),
        ]);


//        dd($session);
        return view('payment', compact('session', 'userId', 'productName', 'productIds'));
    }


    public function success(Request $request)
    {
//        dd($request->paymentMethod);
        $stripeApiKey = env('STRIPE_SECRET_KEY');
        // Initialize the Stripe API client
        Stripe::setApiKey($stripeApiKey);
        // Retrieve the payment details from the request
        $paymentMethod = $request->input('paymentMethod');
        $products = json_decode($request->products);

        $total_amount = $request->amount;
        $sessionId = $request->paymentMethod['id'];
        $userId = Session::get('userId');
        $card = $request->paymentMethod['card'];
        $country = $card['country'];
        $user = User::where('id', $userId)->first();

        // Create a PaymentIntent in Stripe
        $paymentIntent = PaymentIntent::create([
            'amount' => $total_amount * 100, // Replace with the actual payment amount in cents
            'currency' => 'usd',
            'payment_method' => $paymentMethod['id'],
            'confirm' => true,
        ]);

        // Process the payment details and save them to your database or perform any other required actions
        $order = new OrderDetails();
        $order->total_price = $total_amount;
        $order->user_id = $userId;
        $order->session_id = $paymentIntent->id;
        $order->status = 'paid';
        $order->order_title = $request->title;
        $order->country = $country;
        $order->save();

        $payment_details = new PaymentDetails();
        $payment_details->amount = $total_amount;
        $payment_details->status = 'paid';
        $payment_details->session_id = $sessionId;
        $payment_details->save();


        foreach ($products as $product) {
            $size = $product->size;
            $color = $product->color;
            $orderItem = new OrderItem();
            $orderItem->item_quantity = 1; // Set the quantity as needed
            $orderItem->product_id = $product->id;
            // Set any other relevant data for the order item
            $orderItem->save();
            $order->orderItems()->attach($orderItem->id);


            $orderedProduct = Product::where('id', $product->id)->with(['productEntries'])
                ->whereHas('productEntries', function ($query) use ($size, $color) {
                    $query->where('size_id', $size)
                        ->where('color_id', $color);
                })
                ->first();

            if ($orderedProduct) {

                $quantity = $orderedProduct->productEntries[0]->quantity;
//                dd($quantity);
                $orderedProduct->productEntries[0]->update(['quantity' => $quantity-1]);
                event(new QuantityUpdated($product->id, $quantity));

            }
        }


        event(new OrderPlaced($user, $order));
// Return a response to the client
        return response()->json(['message' => 'Order Placed Successfully']);
    }


    public
    function cancelOrder(Request $request)
    {
        $orderDetails = $request->data;
        // Set the Stripe API key
        Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
// Retrieve the payment method ID
        $paymentIntent = $orderDetails['session_id'];
        $refund = \Stripe\Refund::create([
            'payment_intent' => $paymentIntent,
        ]);


        // Handle the refund response
        if ($refund->status === 'succeeded') {

            $order = OrderDetails::find($orderDetails['id']);
            if ($order) {
                $order->status = 'cancelled/refunded';
                $order->save();

                // Retrieve the associated order items
                $orderItems = $order->orderItems;

                foreach ($orderItems as $item) {
                    // Increase the quantity of each ordered item by 1
                    $product = Product::with(['productEntries', 'images'])->where('id', $item->product_id)->first();
                    foreach ($product->productEntries as $entry) {
                        $entry->quantity += 1;
                        $entry->save();
                    }
                }
            }
            return response()->json(['message' => 'Order Cancelled. Payment Refunded!']);
        } else {
            return response()->json(['message' => 'Error']);
        }

    }
}
