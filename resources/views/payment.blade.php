<x-app-layout>

    <div class="min-w-screen min-h-screen bg-gray-200 flex items-center justify-center px-5 pb-10 mt-14">

        <div class="w-full justify-center rounded-lg bg-white shadow-lg p-5 text-gray-700" style="max-width: 600px">


            <div class="w-full pt-1 pb-5">
                <div
                    class="bg-white text-white overflow-hidden rounded-full w-20 h-20 -mt-16 mx-auto shadow-lg flex justify-center items-center">
                    <a title="Stripe, Inc., Public domain, via Wikimedia Commons"
                       href="https://stripe.com/en-gb-us"><img width="512" alt="Stripe Logo, revised 2016"
                                                               src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/ba/Stripe_Logo%2C_revised_2016.svg/512px-Stripe_Logo%2C_revised_2016.svg.png"></a>
                </div>
            </div>
            <div>
                <div class="flex justify-center ">
                    <h5 class="text-xl font-weight-bolder">Receipt</h5>
                </div>
                <div class="flex items-center justify-between">
                    <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">Product</h5>
                    <h3 class="text-md font-medium text-blue-600 hover:underline dark:text-blue-500">
                        Price
                    </h3>
                </div>

            </div>
            <div class="flow-root h-2/3">
                <ul role="list" id="product_receipt" class="divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach($productIds as $productId)
                        <li class="py-3 sm:py-4">
                            <div class="flex items-center space-x-4">
                                <div class="flex-1 min-w-0">
                                    <p class="text-lg font-weight-bold text-gray-900 truncate dark:text-white">
                                        {{$productName[$productId]['name']}}
                                    </p>
                                    <p class="text-sm text-gray-500 truncate dark:text-gray-400">

                                    </p>
                                </div>
                                <div
                                    class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                    ${{$productName[$productId]['price']}}
                                </div>
                                <input type="hidden" name="{{$productId}}" value="{{$productId}}">
                            </div>
                        </li>
                    @endforeach
                    <input type="hidden" name="userId" value="{{$userId = Auth::user()->id}}">
                </ul>
            </div>
            <div class="flex  items-center justify-between">
                <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">Totali</h5>
                <h3 id="totalPrice" class="text-lg font-lg text-base font-semibold text-gray-900 dark:text-white">
                    <!-- Total price goes here -->
                    <input type="hidden" id="totalInput" name="total">
                    ${{$session -> amount_total/100}}
                </h3>
            </div>
            <div class="mb-10">
                <h1 class="text-center font-bold text-xl uppercase">Secure payment info</h1>
            </div>
            <div class="mb-3 flex -mx-2">
                <div class="px-2">
                    <label for="type1" class="flex items-center cursor-pointer">
                        <input type="radio" class="form-radio h-5 w-5 text-indigo-500" name="type" id="type1" checked>
                        <img src="https://leadershipmemphis.org/wp-content/uploads/2020/08/780370.png" class="h-8 ml-3">
                    </label>
                </div>

            </div>

            <form
                role="form"
                {{--                action="{{ route('stripe.post') }}"--}}
                method="post"
                class="require-validation"
                data-cc-on-file="false"
                data-stripe-publishable-key="{{ env('STRIPE_PUBLISHABLE_KEY') }}"
                id="payment-form">

                @csrf
                <div class="mb-3 w-full">
                    <label class="font-bold text-sm mb-2 ml-1">Title</label>
                    <input id='order-title'
                           class="w-full px-3 py-2 mb-1 border-2 border-gray-200 rounded-md focus:outline-none focus:border-indigo-500 transition-colors"
                           type="text"/>
                </div>
                <div class="mb-3 -mx-2 flex items-end">
                    <div class="px-2 w-1/2">
                        <label class="font-bold text-sm mb-2 ml-1">Email</label>
                        <input id='card-holder-email'
                               class="w-full px-3 py-2 mb-1 border-2 border-gray-200 rounded-md focus:outline-none focus:border-indigo-500 transition-colors"
                               value="{{Auth::user()->email}}" type="text"/>

                    </div>
                    <div class="px-2 w-1/2">
                        <label class="font-bold text-sm mb-2 ml-1">Name on Card</label>
                        <input id='card-holder-name'
                               class="w-full px-3 py-2 mb-1 border-2 border-gray-200 rounded-md focus:outline-none focus:border-indigo-500 transition-colors"
                               type="text"/>
                        <input id='total-value' value="{{$session -> amount_total/100}}"
                               class=" hidden w-full px-3 py-2 mb-1 border-2 border-gray-200 rounded-md focus:outline-none focus:border-indigo-500 transition-colors"
                               type="text"/>
                        @foreach($productIds as $productId)
                            <input type="hidden" name="products" value="{{$productId}}">
                        @endforeach
                    </div>
                </div>                <!-- Stripe Elements Placeholder -->
                <div class="mb-3">
                    <div id="card-element"></div>
                </div>
                <div>
                    <button id="card-button"
                            class="block w-full max-w-xs mx-auto bg-blue-500 hover:bg-[#2c7da0] focus:bg-[#2c7da0] text-white rounded-lg px-3 py-3 font-semibold">
                        <i class="mdi mdi-lock-outline mr-1"></i> PAY NOW ${{$session -> amount_total/100}}</button>
                </div>

            </form>
        </div>
    </div>
    <!-- BUY ME A BEER AND HELP SUPPORT OPEN-SOURCE RESOURCES -->
    <div class="flex items-end justify-end fixed bottom-0 right-0 mb-4 mr-4 z-10">
        <div>
            <a title="Buy me a beer" href="https://www.buymeacoffee.com/scottwindon" target="_blank"
               class="block w-16 h-16 rounded-full transition-all shadow hover:shadow-lg transform hover:scale-110 hover:rotate-12">
                <img class="object-cover object-center w-full h-full rounded-full"
                     src="https://i.pinimg.com/originals/60/fd/e8/60fde811b6be57094e0abc69d9c2622a.jpg"/>
            </a>
        </div>
    </div>

    <script src="https://js.stripe.com/v3/"></script>
    <script type="module">

        $(document).ready(function () {

            var productAll = localStorage.getItem('cartItems');
            const stripe = Stripe('pk_test_51NRbzOFpXn0EOxzMXhQcweuc75sbkwnPGhqTqs1QSSYOxcMh2mIee3yGRGH0DJYJfTga423pjcGt0zHIXcPQCRoA00Yvt40Nab');

            const elements = stripe.elements();
            const cardElement = elements.create('card');

            cardElement.mount('#card-element');

            const cardHolderName = document.getElementById('card-holder-name');
            const clientEmail = document.getElementById('card-holder-email');
            const cardButton = document.getElementById('card-button');
            const orderTitle = document.getElementById('order-title');


            const amount = '{{$session->amount_total/100}}';
            cardButton.addEventListener('click', async (e) => {
                e.preventDefault();
                const {paymentMethod, error} = await stripe.createPaymentMethod({
                    type: 'card',
                    card: cardElement,
                    billing_details: {
                        name: cardHolderName.value,
                        email: clientEmail.value,
                    }
                });

                if (error) {
                    Swal.fire({
                        title: "Error",
                        text: error.message,
                        icon: "error",
                    });
                    // Display "error.message" to the user...
                } else {
                    Swal.fire({
                        title: 'Processing Payment',
                        text: 'Please wait...',
                        icon: 'info',
                        allowOutsideClick: false,
                        showConfirmButton: false,
                        onBeforeOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    $.ajax({
                        url: '{{route('user.success')}}', // Replace with the actual URL or route that points to your controller's action
                        method: 'POST',
                        data: {
                            '_token': '{{csrf_token()}}',
                            'paymentMethod': paymentMethod,
                            'products': productAll,
                            'amount': amount,
                            'name': cardHolderName.value,
                            'title': orderTitle.value,

                        },
                        success: function (response) {

                            Swal.fire({
                                text: response.message,
                                icon: 'success',
                            }).then(() => {
                                setTimeout(function () {
                                    window.location.href = '{{url('/')}}';
                                }, 1000);
                            });
                            localStorage.removeItem('cartItems');
                        },
                        error: function (xhr, textStatus, errorThrown) {
                            // Handle any error that occurred during the AJAX call
                            Swal.fire({
                                title: "Error",
                                text: errorThrown,
                                icon: "error",
                            });
                        }
                    });
                    // Proceed with further actions (e.g., submit the form, process the payment)
                }
            });


        });
    </script>


    <style>@import url(https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.3.45/css/materialdesignicons.min.css);</style>
    <style>
        /*
        module.exports = {
            plugins: [require('@tailwindcss/forms'),]
        };
        */
        .form-radio {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            -webkit-print-color-adjust: exact;
            color-adjust: exact;
            display: inline-block;
            vertical-align: middle;
            background-origin: border-box;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            flex-shrink: 0;
            border-radius: 100%;
            border-width: 2px;
        }

        .form-radio:checked {
            background-image: url("data:image/svg+xml,%3csvg viewBox='0 0 16 16' fill='white' xmlns='http://www.w3.org/2000/svg'%3e%3ccircle cx='8' cy='8' r='3'/%3e%3c/svg%3e");
            border-color: transparent;
            background-color: currentColor;
            background-size: 100% 100%;
            background-position: center;
            background-repeat: no-repeat;
        }

        @media not print {
            .form-radio::-ms-check {
                border-width: 1px;
                color: transparent;
                background: inherit;
                border-color: inherit;
                border-radius: inherit;
            }
        }

        .form-radio:focus {
            outline: none;
        }

        .form-select {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%23a0aec0'%3e%3cpath d='M15.3 9.3a1 1 0 0 1 1.4 1.4l-4 4a1 1 0 0 1-1.4 0l-4-4a1 1 0 0 1 1.4-1.4l3.3 3.29 3.3-3.3z'/%3e%3c/svg%3e");
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            -webkit-print-color-adjust: exact;
            color-adjust: exact;
            background-repeat: no-repeat;
            padding-top: 0.5rem;
            padding-right: 2.5rem;
            padding-bottom: 0.5rem;
            padding-left: 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            background-position: right 0.5rem center;
            background-size: 1.5em 1.5em;
        }

        .form-select::-ms-expand {
            color: #a0aec0;
            border: none;
        }

        @media not print {
            .form-select::-ms-expand {
                display: none;
            }
        }

        @media print and (-ms-high-contrast: active), print and (-ms-high-contrast: none) {
            .form-select {
                padding-right: 0.75rem;
            }
        }
    </style>

</x-app-layout>
