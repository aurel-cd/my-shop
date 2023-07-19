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
                       @include('filteredProducts')
                    </div>


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
        width: 300px;
        height: 300px;
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
                    type: 'get',
                    data: {

                        'brand_id': selectedBrandId,
                        'size_id': selectedSizeId,
                        'color_id': selectedColorId,
                    },
                    success: function (response) {

                        $('.productCard').html(response.data);
                        $('.pagination').html(response.pagination);

                    }
                });
            } else {
                $.ajax({
                    url: '{{url('/filteredProducts')}}',
                    type: 'get',
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
                    type: 'get',
                    data: {

                        'brand_id': selectedBrandId,
                        'size_id': selectedSizeId,
                        'color_id': selectedColorId,
                    },
                    success: function (response) {

                        $('.productCard').html(response.data);
                        $('.pagination').html(response.pagination);



                    }
                });
            } else {
                $.ajax({
                    url: '{{url('/filteredProducts')}}',
                    type: 'get',
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
                    type: 'get',
                    data: {

                        'brand_id': selectedBrandId,
                        'size_id': selectedSizeId,
                        'color_id': selectedColorId,
                    },
                    success: function (response) {

                        $('.productCard').html(response.data);
                        $('.pagination').html(response.pagination);


                    }
                });
            } else {
                $.ajax({
                    url: '/',
                    type: 'get',
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

</script>

</html>
