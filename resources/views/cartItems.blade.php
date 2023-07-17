<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>
    @vite(['resources/css/app.css','resources/js/app.js'])

</head>
<body class="antialiased bg-[#a9d6e5]">
@include('layouts.navigation')
@auth
    @if( Auth::user()->hasRole('admin') )
        @include('layouts.sidebar')
        <div class="sm:ml-64">
            @endif
            @endauth
            <div class="mt-16 flex inline-flex">
                <div class="productCardsContainer grid grid-cols-1 md:grid-cols-3 sm:grid-cols-3 rounded  mx-10 p-5">
                    <!-- Your product cards go here -->
                </div>

                <form id="receipt" method="post" action="{{route('user.checkout')}}" class="
                @auth
                w-1/3
                @endauth
                h-1/3 p-4 hidden mr-4 divide-y divide-gray-900 my-5 bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                    @csrf
                    <div class="flex justify-center ">
                        <h5 class="text-xl font-weight-bolder">Receipt</h5>
                    </div>
                    <div class="flex items-center justify-between">
                        <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">Product</h5>
                        <h3 class="text-md font-medium text-blue-600 hover:underline dark:text-blue-500">
                            Price
                        </h3>
                    </div>

                    <div class="flow-root h-2/3">
                        <ul role="list" id="product_receipt" class="divide-y divide-gray-200 dark:divide-gray-700">
                            @auth
                            <input type="hidden" name="userId" value="{{$userId = Auth::user()->id}}">
                            @endauth
                        </ul>
                    </div>
                    <div class="flex  items-center justify-between">
                        <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">Totali</h5>
                        <h3 id="totalPrice" class="text-lg font-lg text-base font-semibold text-gray-900 dark:text-white">
                            <!-- Total price goes here -->
                            <input type="hidden" id="totalInput" name="total">

                        </h3>
                    </div>
                    <div class="flex justify-center">
                        @auth
                        <button type="submit" class="checkout mt-5 inline-flex items-center px-3 py-2 text-md font-medium text-center text-white bg-[#2c7da0] rounded-lg hover:bg-[#a9d6e5] focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Checkout
                            <svg class="w-6 h-6 pl-2 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="white" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                            </svg>
                        </button>

                        @endauth
                        @guest
                        <h5>You must be logged In to checkout!</h5>
                            @endguest
                    </div>
                </form>

            </div>
            @auth
                @if( Auth::user()->hasRole('admin') )
                    <div>
    @endif
@endauth
</body>
<script src="https://js.stripe.com/v3/"></script>
<script type="module">
    $(document).ready(function() {
        var total = 0;

        // Retrieve product data from local storage
        var products = JSON.parse(localStorage.getItem("cartItems")) || [];

        var listItemHTML = '';

        var productIDs = [];


        // Get the container element to display the product cards
        var productCardsContainer = $(".productCardsContainer");
        if (products.length == 0) {
            $('#receipt').addClass('hidden');
            Swal.fire({
                title: "Product Cart is Empty!",
                icon: "warning",
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{url('/')}}";
                }
            });
        } else {
            // Loop through ea
            // consch product in the cart
            $.each(products, function (index) {
                productIDs[index] = products[index].id;
            });
            if (productIDs && productIDs.length > 0) {
                // Make AJAX call to retrieve product data
                $.ajax({
                    url: "{{route('getItems')}}", // Replace with the actual URL or endpoint to retrieve product data
                    method: 'post',
                    data: {
                        "_token": '{{csrf_token()}}',
                        'ids': productIDs
                    }, // Pass the product IDs as a parameter
                    dataType: 'json',
                    success: function (response) {
                        $('.productCardsContainer').html(response.data);
                        // $('.pppp').html(response.data);
                        // console.log(response.data);
                    },
                    error: function (xhr, status, error) {
                        // Handle the error response
                        console.log('Error:', error);
                    }
                });
                if($('#receipt').hasClass('hidden')) {
                    $('#receipt').removeClass('hidden');
                }
                $.each(products, function(index, product){
                    listItemHTML += `
                            <li class="py-3 sm:py-4">
                                    <div class="flex items-center space-x-4">
                                        <div class="flex-1 min-w-0">
                                                <p class="text-lg font-weight-bold text-gray-900 truncate dark:text-white">
                                                        ${product.name}
                                                </p>
                                                <p class="text-sm text-gray-500 truncate dark:text-gray-400">

                                                </p>
                                        </div>
                                        <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                            $${product.price}
                                        </div>
                                        <input type="hidden" name="${product.id}" value="${product.price}">
                                    </div>
                            </li>`;

                    total += parseInt(product.price);
                    // console.log(product.price);
                });
                $('#product_receipt').html(listItemHTML);
                $('#totalPrice').text('$'+total);

            }
        }


    });
    // $(window).unload(function() {
    //     window.localStorage.removeItem('cartItems');
    // });

</script>
</html>

