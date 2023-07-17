<x-mail::message>


    Thank you for placing your order.

    Order Title: {{ $order->order_title }}

    Additional Details:
    - Order ID: {{ $order->id }}
    - Total Price: ${{ $order->total_price }}
    - Order Date: {{ $order->created_at }}

    <x-mail::button :url="''">
        CANCEL ORDER
    </x-mail::button>

    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>

