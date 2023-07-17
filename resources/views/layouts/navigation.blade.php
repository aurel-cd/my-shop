<nav class="fixed top-0 z-50 w-full bg-[#2c7da0] shadow-md dark:bg-gray-800 dark:border-gray-700">
    <div class="px-3 py-3 lg:px-5 lg:pl-3">
        <div class="flex items-center justify-between">
            <div class="flex items-center justify-start">
                @guest
                    <a href="{{url('/')}}">
                    <div class="shrink-0 pl-10 flex items-center">
                    <x-application-logo
                        class="block h-9 w-auto fill-current text-white font-weight-bold dark:text-gray-200"/>
                    </div>
                    </a>

                @endguest
                    @auth
                        @role('user')
                            <a href="{{url('/')}}">
                                <div class="shrink-0 pl-10 flex items-center">
                                    <x-application-logo
                                        class="block h-9 w-auto fill-current text-white font-weight-bold dark:text-gray-200"/>
                                </div>
                            </a>
                            <a href="{{route('user.orders')}}">
                                <div class="shrink-0 pl-10 flex items-center">
                                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 21 18">
                                        <path stroke="white" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.5 3h9.563M9.5 9h9.563M9.5 15h9.563M1.5 13a2 2 0 1 1 3.321 1.5L1.5 17h5m-5-15 2-1v6m-2 0h4"/>
                                    </svg>
                                </div>
                            </a>
                        @endrole
                    @endauth
                @auth
                        @role('admin|menager')
                <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 text-sm text-white hover:text-gray-900 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                    <span class="sr-only">Open sidebar</span>
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
                    </svg>
                </button>
                        <div class="shrink-0 pl-10 flex items-center">
                            <a href="{{ url('/') }}">
                                <x-application-logo
                                    class="block h-9 w-auto fill-current text-white font-weight-bold dark:text-gray-200"/>
                            </a>
                        </div>

                    @endrole
                @endauth
            </div>
            <div class="flex h-[40px] items-center justify-center">

                    <div class="shrink-0 pr-5 flex items-center">
                        <a href="{{route('cartItems')}}">
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 19 20">
                            <path stroke="white" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 15a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm0 0h8m-8 0-1-4m9 4a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm1-4H5m0 0L3 4m0 0h5.501M3 4l-.792-3H1m11 3h6m-3 3V1"/>
                        </svg>
                        </a>
                    </div>
                <style>
                    .selectjs{
                        width:200px;
                        height:40px;
                        margin-top:0;
                        margin-bottom: 0;
                    }
                </style>

                    <div class="flex">
                        <select name="selectjs" id="ajaxSelect" class="selectjs">
                            <option value=""></option>
                        </select>
                    </div>
                </form>
                <div class="shrink-0 pl-2 flex items-center">
                    @if (Route::has('login'))
                        @guest
                    <button id="dropdownHoverButton" data-dropdown-toggle="dropdownHover" data-dropdown-trigger="hover" class="text-white bg-[##2c7da0] hover:bg-[#a9d6e5] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">Welcome <svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                        </svg></button>
                        @endguest
                    <!-- Dropdown menu -->
                    <div id="dropdownHover" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownHoverButton">
                        @auth
                            @role('admin|menager')
                                <a href="{{ route('admin.dashboard') }}"
                                   class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
                            @endrole
                            @role('user')
                                <a href="{{ route('user.dashboard') }}"
                                   class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>

                            @endrole
                        @else
                            <li>
                            <a href="{{ route('login') }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Log in</a>
                            </li>
                            <li>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class=" block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Register</a>
                            @endif
                            </li>
                        @endauth
                        </ul>
                    </div>
                    @endif

                </div>

                @auth
                    <div class="flex items-center">
                        <div>
                            <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"
                                 xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z"></path>
                            </svg>
                        </div>
                        <div class="flex items-center ml-3">
                            <div>
                                <button type="button"
                                        class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                                        aria-expanded="false" data-dropdown-toggle="dropdown-user">
                                    <div
                                        class="relative inline-flex items-center justify-center w-10 h-10 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600">
                                        <span
                                            class="font-medium text-gray-600 dark:text-gray-300">{{ substr(Auth::user()->firstName, 0, 1) }}{{ substr(Auth::user()->lastName, 0, 1) }}</span>
                                    </div>
                                </button>
                            </div>
                            <div
                                class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600"
                                id="dropdown-user">
                                <div class="px-4 py-3" role="none">
                                    <p class="text-sm text-gray-900 dark:text-white" role="none">
                                    <div>{{ Auth::user()->firstName }} {{ Auth::user()->lastName }}</div>

                                    </p>
                                    <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300"
                                       role="none">
                                        {{ Auth::user()->email }}
                                    </p>
                                </div>
                                <ul class="py-1" role="none">
                                    <x-dropdown-link :href="route('profile.edit')">
                                        {{ __('Profile') }}
                                    </x-dropdown-link>
                                    <!-- Authentication -->
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf

                                        <x-dropdown-link :href="route('logout')"
                                                         onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                            {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </ul>
                        </div>
                    </div>
                </div>
                @endauth

            </div>
        </div>
    </div>
</nav>
<script type="module">
    $(document).ready(function(){
        var selectedProductName;

        $(".selectjs").select2({
            placeholder: "Search Product",
            templateResult: function(data) {
                return data.text;
            },
            templateSelection: function(data) {
                return data.text;
            },
            closeOnSelect: true,
            minimumInputLength: 2,
            ajax: {
                url: "{{url('/getProductNames')}}",
                dataType: "json",
                type: "get",
                delay: 250,
                data: function(params) {
                    return {
                        searchItem: params.term,

                    };
                },
                processResults: function(data) {

                    return {
                        results: data,

                    };
                },
                allowClear: true,
                cache: true
            },
            templateResult:templateResult,
        }).on("change", function(event) {
            event.preventDefault();
            selectedProductName = $(this).val();

            // console.log(selectedProductText);
            // console.log(selectedProductText);
            getProduct(selectedProductName);
        });
    });

    function getProduct(selectedProductName){
        $.ajax({
            url: "{{url('/selectedProduct')}}",
            type: 'post',
            data: {
                "_token": '{{csrf_token()}}',
                'selectedProductName': selectedProductName,
            },
            success: function (data) {
                $('.productCard').html(data.data);
                $('.selectjs').select2({
                    placeholder: "Search Product",
                    templateResult: function (data) {
                        return data.text;
                    },
                    templateSelection: function (data) {
                        return data.text;
                    },
                    closeOnSelect: true,
                    minimumInputLength: 2,
                    ajax: {
                        url: "{{url('/getProductNames')}}",
                        dataType: "json",
                        type: "get",
                        delay: 250,
                        data: function (params) {
                            return {
                                searchItem: params.term,

                            };
                        },
                        processResults: function (data) {
                            return {
                                results: data,

                            };
                        },
                        allowClear: true,
                        cache: true
                    },
                    templateResult: templateResult,
                }).on("change", function (event) {
                    event.preventDefault();
                    selectedProductName = $(this).val();
                    getProduct(selectedProductName);
                });
            }
        });
    }

    function templateResult(data){
        if(data.loading){
            return data.text;
        }else{
            return data.product_name;
        }
    }
</script>
