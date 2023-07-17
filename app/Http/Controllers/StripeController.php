<?php

namespace App\Http\Controllers;

use App\Events\OrderPlaced;
use App\Events\QuantityUpdated;
use App\Mail\OrderPlacedNotification;
use App\Models\OrderDetails;
use App\Models\OrderItem;
use App\Models\OrderItems;
use App\Models\PaymentDetails;
use App\Models\Product;
use App\Models\User;
use Illuminate\Console\View\Components\Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Stripe\Stripe;

use Stripe\PaymentIntent;
use Stripe\StripeClient;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
        return view('payment', compact('session','userId','productName', 'productIds' ));
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
//        dd($products);

        $total_amount = $request -> amount;
        $sessionId = $request->paymentMethod['id'];
        $userId = Session::get('userId');
        $card=$request->paymentMethod['card'];
        $country = $card['country'];
        $user = User::where('id', $userId)->first();

        // Create a PaymentIntent in Stripe
        $paymentIntent = PaymentIntent::create([
            'amount' => $total_amount, // Replace with the actual payment amount in cents
            'currency' => 'usd',
            'payment_method' => $paymentMethod['id'],
            'confirm' => true,
        ]);

        // Process the payment details and save them to your database or perform any other required actions
        $order = new OrderDetails();
        $order->total_price=$total_amount;
        $order->user_id=$userId;
        $order->session_id = $sessionId;
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
            $orderItem = new OrderItem();
            $orderItem->item_quantity = 1; // Set the quantity as needed
            $orderItem->product_id = $product->id;
            // Set any other relevant data for the order item
            $orderItem->save();
            $order->orderItems()->attach($orderItem->id);

            $orderedProduct = Product::with('productEntries', 'images')->find($product->id);

            if ($orderedProduct) {
                foreach ($orderedProduct->productEntries as $productEntry) {
                    $quantity = $productEntry->quantity - 1;
                    $productEntry->quantity = $quantity;
                    $productEntry->save(); // Save the updated product entry

                    event(new QuantityUpdated($product->id, $quantity));

                }
            }

        }


        event(new OrderPlaced($user, $order));
// Return a response to the client
        return response()->json(['message' => 'Order Placed Successfully']);
    }



    public function cancelPayment()
    {
        echo 'Payment cancelled';
    }
}
