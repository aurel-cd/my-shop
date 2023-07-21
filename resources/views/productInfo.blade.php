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
@include('layouts.navigation');
@auth
    @if( Auth::user()->hasRole('admin') )
        @include('layouts.sidebar');
        <div class="sm:ml-64">
            @endif
            @endauth
            <div class="py-4 px-2  mt-10">
                <div class="relative py-4 px-4 sm:rounded-lg">

                    <section class="text-gray-700 body-font border-2px overflow-hidden">
                        <div class="container px-5 py-24 mx-auto">
                            <div class="lg:w-4/5 mx-auto flex flex-wrap">
                                <div class="lg:w-1/2 w-full shadow-md object-cover object-center bg-white rounded  ">
                                    <div id="controls-carousel" class="relative w-full bg-white" data-carousel="static">
                                        <!-- Carousel wrapper -->
                                        <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
                                            <!-- Item 1 -->
                                            @foreach($product['images'] as $index => $image)
                                                <div
                                                    class="my-auto hidden duration-700 ease-in-out {{ $index === 0 ? 'active' : '' }}"
                                                    data-carousel-item>
                                                    <img
                                                        class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                                                        src="{{ asset('storage/images').'/'.$image['image_name'] }}"
                                                        alt="Slide {{ $index + 1 }}">
                                                </div>
                                            @endforeach
                                            {{--                                            @foreach($product['images'] as $images)--}}
                                            {{--                                                <script>console.log({{$images}})</script>--}}
                                            {{--                                            <div class="hidden duration-700 ease-in-out" data-carousel-item>--}}
                                            {{--                                                <img src="{{asset('storage/images').'/'.$product['images'][0]['image_name']}}" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">--}}
                                            {{--                                            </div>--}}
                                            {{--                                            @endforeach--}}

                                        </div>
                                        <!-- Slider controls -->
                                        <button type="button"
                                                class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                                                data-carousel-prev>
    <span
        class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-[#a9d6e5] dark:bg-gray-900/40 group-hover:bg-[#2c7da0] dark:group-hover:bg-gray-700/50 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
        <svg class="w-4 h-4 text-white dark:text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
             fill="none" viewBox="0 0 6 10">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M5 1 1 5l4 4"/>
        </svg>
        <span class="sr-only">Previous</span>
    </span>
                                        </button>

                                        <button type="button"
                                                class="absolute top-0 right-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                                                data-carousel-next>
    <span
        class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-[#a9d6e5] dark:bg-gray-900/40 group-hover:bg-[#2c7da0] dark:group-hover:bg-gray-700/50 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
        <svg class="w-4 h-4 text-white dark:text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
             fill="none" viewBox="0 0 6 10">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="m1 9 4-4-4-4"/>
        </svg>
        <span class="sr-only">Next</span>
    </span>
                                        </button>
                                    </div>
                                </div>


                                <div class="lg:w-1/2 w-full lg:pl-10 lg:py-6 mt-6 lg:mt-0">
                                    <h2 class="text-lg title-font text-gray-500 tracking-widest">{{$product->brandName}}</h2>
                                    <h1 class="text-gray-900 text-3xl title-font font-medium mb-1">{{$product->product_name}}</h1>
                                    <div class="flex mb-4">
                                        <span class="flex ml-3 pl-3 py-2 border-l-2 border-gray-200">
            <a class="text-gray-500">
              <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5"
                   viewBox="0 0 24 24">
                <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path>
              </svg>
            </a>
            <a class="ml-2 text-gray-500">
              <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5"
                   viewBox="0 0 24 24">
                <path
                    d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"></path>
              </svg>
            </a>
            <a class="ml-2 text-gray-500">
              <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5"
                   viewBox="0 0 24 24">
                <path
                    d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z"></path>
              </svg>
            </a>
          </span>
                                    </div>
                                    <p class="leading-relaxed">{{$product->product_desc}}</p>
                                    <div class="flex mt-6 items-center pb-5 border-b-2 border-gray-200 mb-5">

                                        <div class="flex ml-6 items-center">
                                            <ul class="inline-flex">
                                                <li>
                                                    @if(!empty($availableColors) || !empty($availableSizes))
                                                    <select id="sizes"
                                                            class="bg-[#a9d6e5]  text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                        <option value="">Size</option>
                                                        @foreach($availableSizes as $size)
                                                            <option value="{{$size->id}}">{{$size->size_value}}</option>
                                                        @endforeach

                                                    </select>
                                                </li>
                                                <li>

                                                    <select id="colors"
                                                            class="bg-[#a9d6e5] mx-5 px-5 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                        <option value="">Color</option>
                                                        @foreach($availableColors as $color)
                                                            <option
                                                                value="{{$color->id}}">{{$color->color_name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @endif
                                                    @if(empty($availableColors) || empty($availableSizes))
                                                        <x-input-label class="message">Out of Stock!</x-input-label>
                                                    @endif
                                                    <x-input-label class="messageInfo hidden">Out of Stock!</x-input-label>

                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="flex">
                                        <span
                                            class="title-font font-medium text-2xl text-gray-900">${{$product->price}}</span>
                                        @if(!empty($availableColors) && !empty($availableSizes))
                                        <button disabled
                                            class="addToCart flex ml-auto text-white bg-red-500 border-0 py-2 px-6 focus:outline-none hover:bg-red-600 rounded">
                                            Add To Cart
                                        </button>
                                        @endif
                                        <button
                                            class="rounded-full w-10 h-10 bg-gray-200 p-0 border-0 inline-flex items-center justify-center text-gray-500 ml-4">
                                            <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                 stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                                                <path
                                                    d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>



                    <div class="flex justify-center mt-16 px-0 sm:items-center sm:justify-between">
                        <div class="text-center text-sm text-gray-500 dark:text-gray-400 sm:text-left">
                            <div class="flex items-center gap-4">
                                <a href="https://github.com/sponsors/taylorotwell"
                                   class="group inline-flex items-center hover:text-gray-700 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5"
                                         class="-mt-px mr-1 w-5 h-5 stroke-gray-400 dark:stroke-gray-600 group-hover:stroke-gray-600 dark:group-hover:stroke-gray-400">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z"/>
                                    </svg>
                                    Sponsor
                                </a>
                            </div>
                        </div>

                        <div
                            class="ml-4 text-center text-sm text-gray-500 dark:text-gray-400 sm:text-right sm:ml-0">
                            Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
                        </div>
                    </div>
                </div>

            </div>
            @auth
                @if( Auth::user()->hasRole('admin') )
                    <div>
    @endif
@endauth
</body>

<script type="module">
    $(document).ready(function(){
        $(document).on('change', '#sizes', function (event){
            var size = $('#sizes').val();
            var color = $('#colors').val();
            var id = {{$product->id}};
            if(size && color){
                $.ajax({
                    url: "{{route('checkInventoryOrder')}}",
                    type: "get",
                    dataType: 'json',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "color": color,
                        "size": size,
                        "id":id
                    },
                    success: function (response) {
                        var quantity = response.data;
                        if(quantity!=0){

                            $('.addToCart').attr('disabled', false);
                            $('.messageInfo').addClass('hidden');

                        }else{
                            $('.messageInfo').removeClass('hidden');
                            $('.addToCart').attr('disabled', true);
                        }

                    },
                    error: function (response) {
                        alert('failed');
                    }
                });
            }
        });
        $(document).on('change', '#colors', function (event){
            var size = $('#sizes').val();
            var color = $('#colors').val();
            var id = {{$product->id}};
            if(size && color){
                $.ajax({
                    url: "{{route('checkInventoryOrder')}}",
                    type: "get",
                    dataType: 'json',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "color": color,
                        "size": size,
                        "id":id
                    },
                    success: function (response) {
                        var quantity = response.data;
                        if(quantity!=0){

                            $('.addToCart').attr('disabled', false);
                            $('.messageInfo').addClass('hidden');

                        }else{
                            $('.messageInfo').removeClass('hidden');
                            $('.addToCart').attr('disabled', true);
                        }

                    },
                    error: function (response) {
                        alert('failed');
                    }
                });
            }
        });


    });
    // Function to save product data in local storage
    function saveProductToLocalStorage() {
        // Get the product details
        var id = "{{$product->id}}";
        var name = "{{$product->product_name}}";
        var price = "{{$product->price}}"



        var size = $('#sizes').val(); // Assuming size_id is the ID of the size for this entry
        var color = $('#colors').val(); // Assuming color_id is the ID of the color for this entry



        // Create a product object
        var product = {
            id: id,
            name: name,
            price: price,
            size: size,
            color:color,
        };

        // Check if local storage is supported by the browser
        if (typeof(Storage) !== "undefined") {
            var productIDs = new Array();
            // Retrieve existing cart items from local storage or initialize an empty array
            var cartItems = JSON.parse(localStorage.getItem("cartItems")) || [];
            $.each(cartItems, function (index, product) {
                productIDs[index] = product.id;
            });
            // Add the new product to the cart items array
            if (productIDs.includes(product.id)) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Product already exists in the cart!',
                    text: 'Please remove it from the cart before adding again.',
                });
            } else {
                // Add the new product to the cart items array
                cartItems.push(product);

                // Save the updated cart items array back to local storage
                localStorage.setItem("cartItems", JSON.stringify(cartItems));

                // Provide feedback to the user
                Swal.fire({
                    icon: 'success',
                    title: 'Product added to cart!',
                });
            }
        } else {
            // Local storage is not supported
            Swal.fire({
                icon: 'error',
                title: 'Sorry, your browser does not support local storage.',
            });
        }
    }

    // Add event listener to the "Add to Cart" button
    $(document).on('click','.addToCart', function(event){
        event.preventDefault();
        saveProductToLocalStorage();
    });
</script>
</html>

