
@forelse ($products as $product)
    <div  id="{{$product->id}}" class="max-w-sm mt-5 bg-white border mx-4 p-4 border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
<div class="w-150 h-150 p-auto">
            <img class="rounded" src="{{asset('storage/images').'/'.$product['images'][0]['image_name']}}" alt="" />
</div>
        <div class="p-5">
                <h5 class="mb-2 text-2xl font-bold justify-start text-gray-900 dark:text-white">{{$product->product_name}}</h5>
            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{$product->product_desc}}</p>
            <h5 class="mb-2 text-2xl font-bold justify-start text-gray-900 dark:text-white">${{$product->price}}</h5>

            <button id="{{$product->id}}" data-product-id="{{$product->id}}" class="removeProduct inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-200 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Remove from Cart
                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                    <path stroke="white " stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h16M7 8v8m4-8v8M7 1h4a1 1 0 0 1 1 1v3H6V2a1 1 0 0 1 1-1ZM3 5h12v13a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V5Z"/>
                </svg>
            </button>
        </div>
    </div>
@empty
    Cart is empty!
@endforelse

<script>


    $(document).on('click','.removeProduct', function(event){
        event.preventDefault();
        var id = $(this).data('product-id');
        var productIDs =new Array();
        var cartItems = JSON.parse(localStorage.getItem("cartItems")) || [];

        for (var index = 0; index < cartItems.length; index++) {
            productIDs[index] = cartItems[index].id;
            if (cartItems[index].id == id) {
                console.log(cartItems[index].id);
                cartItems.splice(index, 1);
                localStorage.setItem("cartItems", JSON.stringify(cartItems));
                $('#'+id).remove();
                break; // Exit the loop since the item was found and removed
            }
        }
        var cartItems = JSON.parse(localStorage.getItem("cartItems")) || [];
        if(cartItems.length==0){
            $('#receipt').addClass('hidden');
            Swal.fire({
                title: "Product Cart is Empty!",
                icon: "warning",
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{url('/')}}";
                }
            });        }
        var total=0;
        var listItemHTML='';
        $.each(cartItems, function(index, product){
            // console.log(product.id);
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
</li>
`;

            total += parseInt(product.price);
            // console.log(product.price);
        });

        $('#product_receipt').html(listItemHTML);
        $('#totalPrice').text('$'+total);
    });
</script>
