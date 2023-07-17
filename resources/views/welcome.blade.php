<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>MyShop</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>
    @vite(['resources/css/app.css','resources/js/app.js'])

</head>
<body class="antialiased bg-[#a9d6e5]">
@include('layouts.navigation');
@auth
    @role('admin|menager')
        @include('layouts.sidebar');
        <div class="sm:ml-64">
            @endrole
            @endauth
            <div class="py-4 px-2 mt-10">
                <div class="relative pt-4 pb-2 px-4 sm:rounded-lg">
                    <div class="py-2 flex justify-end subnav-hero-section bg-[#a9d6e5]">
                        <h1 class="subnav-hero-headline">Founded <small>by AS</small></h1>
                        <ul class="subnav-hero-subnav py-2">
                            <li>
                                <p class="text-white">Filter by:</p>
                            </li>
                            <li>
                                <select id="brands"
                                        class="bg-[#a9d6e5]  text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="">Brand</option>
                                    @foreach($brands as $brand)
                                        <option value="{{$brand->id}}">{{$brand->brandName}}</option>
                                    @endforeach

                                </select>

                            </li>
                            <li>
                                <select id="sizes"
                                        class="bg-[#a9d6e5]  text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="">Size</option>
                                    @foreach($sizes as $size)
                                        <option value="{{$size->id}}">{{$size->size_value}}</option>
                                    @endforeach

                                </select>
                            </li>
                            <li>
                                <select id="colors"
                                        class="bg-[#a9d6e5]  text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="">Color</option>
                                    @foreach($colors as $color)
                                        <option value="{{$color->id}}">{{$color->color_name}}</option>
                                    @endforeach

                                </select>
                            </li>
                        </ul>

                    </div>

                    <div class="mt-16">

                        <div class="productCard grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                                @forelse ($products as $product)
                                <div data-product-id="{{$product->id}}"
                                     class="singleProduct hover:bg-gray-200 hover:-translate-y-1 max-w-sm bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">

                                    <a data-product-id="{{$product->id}}" class="productInfo "
                                       href="{{route('productInfo', ['id' => $product->id])}}">

                                        <div>
                                        <img
                                            id="productImage"
                                            class=" background-transparent hover:bg-gray-100 py-8 rounded-t-lg align-content-center product-image"
                                            src="{{asset('storage/images').'/'.$product['images'][0]['image_name']}}"
                                            alt="product image"/>
                                        </div>
                                        <div class="px-5 pb-5">

                                            <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">{{$product->product_name}}
                                                , {{$product->color}}</h5>

                                            <div class="flex items-center mt-2.5 mb-5">
                                                <svg aria-hidden="true" class="w-5 h-5 text-yellow-300"
                                                     fill="currentColor" viewBox="0 0 20 20"
                                                     xmlns="http://www.w3.org/2000/svg"><title>First star</title>
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                </svg>
                                                <svg aria-hidden="true" class="w-5 h-5 text-yellow-300"
                                                     fill="currentColor" viewBox="0 0 20 20"
                                                     xmlns="http://www.w3.org/2000/svg"><title>Second star</title>
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                </svg>
                                                <svg aria-hidden="true" class="w-5 h-5 text-yellow-300"
                                                     fill="currentColor" viewBox="0 0 20 20"
                                                     xmlns="http://www.w3.org/2000/svg"><title>Third star</title>
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                </svg>
                                                <svg aria-hidden="true" class="w-5 h-5 text-yellow-300"
                                                     fill="currentColor" viewBox="0 0 20 20"
                                                     xmlns="http://www.w3.org/2000/svg"><title>Fourth star</title>
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                </svg>
                                                <svg aria-hidden="true" class="w-5 h-5 text-yellow-300"
                                                     fill="currentColor" viewBox="0 0 20 20"
                                                     xmlns="http://www.w3.org/2000/svg"><title>Fifth star</title>
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                </svg>
                                                <span
                                                    class="bg-blue-100 text-blue-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800 ml-3">5.0</span>
                                            </div>


                                            <div class="flex items-center justify-between">
                                                <span
                                                    class="text-3xl font-bold text-gray-900 dark:text-white">${{$product->price}}</span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @empty
                                No products available!
                            @endforelse
                        </div>

                    </div>
                </div>
                {{$products->links()}}
            </div>
            @auth
                @if( Auth::user()->hasRole('admin') )
                    <div>
    @endif
@endauth
</body>
<style>

    .subnav-hero-headline {
        font-size: 3rem;
    }

    .subnav-hero-section {
        text-align: center;
        background: #2c7da0;
        border-radius: 5px;
        background-size: cover;
        position: relative;
        overflow: visible;
        display: -webkit-flex;
        display: -ms-flexbox;
        display: flex;
        -webkit-align-items: center;
        -ms-flex-align: center;
        align-items: center;
        -webkit-justify-content: center;
        -ms-flex-pack: center;
        justify-content: center;
        height: 300px;
    }

    .subnav-hero-section .subnav-hero-headline {
        color: #fefefe;
    }

    .subnav-hero-subnav {
        float: none;
        position: absolute;
        text-align: center;
        margin: 0 auto;
        bottom: 0;
        width: 100%;
    }

    .subnav-hero-subnav li {
        float: none;
        display: inline-block;
    }


    img {
        display: block;
        margin: 0 auto;
        width:300px;
        height:300px;
        background: transparent;
        mix-blend-mode: darken;
    }
</style>
<script type="module">


    $(document).ready(function () {

        $(document).on('change', '#brands', function (event) {
            event.preventDefault();
            var selectedBrandId = $('#brands').find(':selected').val();
            var selectedSizeId = $('#sizes').find(':selected').val();
            var selectedColorId = $('#colors').find(':selected').val();


            if (selectedBrandId || selectedSizeId || selectedColorId) {
                $.ajax({
                    url: '{{url('/filteredProducts')}}',
                    type: 'post',
                    data: {
                        "_token": '{{csrf_token()}}',
                        'brand_id': selectedBrandId,
                        'size_id': selectedSizeId,
                        'color_id': selectedColorId,
                    },
                    success: function (response) {
                        // ReplaceContent(data);
                        $('.productCard').html(response.data);


                    }
                });
            } else {
                $.ajax({
                    url: '{{url('/filteredProducts')}}',
                    type: 'post',
                    data: {
                        "_token": '{{csrf_token()}}',

                    },
                    success: function (data) {
                        // ReplaceContent(data);
                    }
                });
            }

        });
        $(document).on('change', '#sizes', function (event) {
            event.preventDefault();
            var selectedBrandId = $('#brands').find(':selected').val();
            var selectedSizeId = $('#sizes').find(':selected').val();
            var selectedColorId = $('#colors').find(':selected').val();


            if (selectedBrandId || selectedSizeId || selectedColorId) {
                $.ajax({
                    url: '{{url('/filteredProducts')}}',
                    type: 'post',
                    data: {
                        "_token": '{{csrf_token()}}',
                        'brand_id': selectedBrandId,
                        'size_id': selectedSizeId,
                        'color_id': selectedColorId,
                    },
                    success: function (response) {

                        $('.productCard').html(response.data);


                    }
                });
            } else {
                $.ajax({
                    url: '{{url('/filteredProducts')}}',
                    type: 'post',
                    data: {
                        "_token": '{{csrf_token()}}',

                    },
                    success: function (data) {
                        // ReplaceContent(data);
                    }
                });
            }

        });
        $(document).on('change', '#colors', function (event) {
            event.preventDefault();
            var selectedBrandId = $('#brands').find(':selected').val();
            var selectedSizeId = $('#sizes').find(':selected').val();
            var selectedColorId = $('#colors').find(':selected').val();


            if (selectedBrandId || selectedSizeId || selectedColorId) {
                $.ajax({
                    url: '{{url('/filteredProducts')}}',
                    type: 'post',
                    data: {
                        "_token": '{{csrf_token()}}',
                        'brand_id': selectedBrandId,
                        'size_id': selectedSizeId,
                        'color_id': selectedColorId,
                    },
                    success: function (response) {

                        $('.productCard').html(response.data);

                    }
                });
            } else {
                $.ajax({
                    url: '/',
                    type: 'post',
                    data: {
                        "_token": '{{csrf_token()}}',

                    },
                    success: function (data) {
                        // ReplaceContent(data);
                    }
                });
            }

        });

    });


    // window.addEventListener('beforeunload', function() {
    //     localStorage.removeItem('cartItems');
    // });
</script>

</html>
