<x-app-layout>
{{--    @section('links')--}}
        <link rel="stylesheet" href="{{Vite::asset('resources/assets/datatable/datatable.css')}}">
{{--    @endsection--}}

        <div class="py-4 px-4 mt-14 ">
            <div class="relative py-4 px-4 bg-[#a9d6e5] overflow-x-auto shadow-md sm:rounded-lg">
                <caption class=" text-lg justify-center p-5 text-gray-200 dark:text-white dark:bg-gray-800">
                    <h1 class="text-center font-bold"> ORDER HISTORY</h1>
                </caption>
                <table id="orderDatatable" class="w-full p-4 text-sm text-left rounded-md text-dark dark:text-gray-400">

                <thead
                    class="text-dark bg-gray-200 border-[#2c7da0] font-weight-bolder text-md dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-4 py-4"></th>

                    <th scope="col" class="px-4 py-4">Order Title</th>
                    <th scope="col" class="px-4 py-4">Qty</th>
                    <th scope="col" class="px-4 py-4">Price</th>
                    <th scope="col" class="px-4 py-4">Status</th>
                    <th scope="col" class="px-4 py-4">Country</th>
                    <th scope="col" class="px-4 py-4">Date</th>
                    <th scope="col" class="px-4 py-4">
                        <span class="sr-only">Actions</span>
                    </th>
                </tr>
                </thead>
                <tbody class="bg-gray-100 p-5">

                </tbody>
                    <tfoot class="text-dark bg-gray-200 border-[#2c7da0] font-weight-bolder text-md dark:bg-gray-700 dark:text-gray-400">
                    <th></th>
                    <th></th>
                    <th  id="totalRevenueFooter"></th>
                    <th id="totalPrice"></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    </tfoot>
                </table>

        </div>

    </div>

    <div id="orderModal" tabindex="-1" aria-hidden="true"
         class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div
                    class="flex items-start justify-between p-4 border-b-2 border-gray-500  rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        ORDER DETAILS
                    </h3>
                    <button type="button"
                            class="closeModal text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-hide="orderModal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>

                </div>
                <!-- Modal body -->
                <div class="p-6 space-y-6">
                    <div class="flex justify-center ">
                        <h5 class="text-xl font-weight-bolder">Receipt</h5>
                    </div>
                    <div class="flex items-center justify-between">
                        <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">Product</h5>
                        <h3 class="text-md font-medium text-blue-600 hover:underline dark:text-blue-500">
                            Price
                        </h3>
                    </div>

                    <div class="flow-root border-t border-gray-200 h-2/3">
                        <ul role="list" id="product_receipt" class="divide-y divide-gray-200 dark:divide-gray-700">

                        </ul>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="flex items-center p-6 space-x-2 border-t-2  border-gray-500 rounded-b dark:border-gray-600">

                    <div class="flex-1 min-w-0">
                        <p class="text-lg font-weight-bold text-gray-900 truncate dark:text-white">
                        <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">Totali</h5>
                        </p>
                    </div>
                    <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                        <h3 id="totalPrice"
                            class="text-lg font-lg  text-base font-semibold text-gray-900 dark:text-white">
                            <!-- Total price goes here -->
                            <input type="hidden" id="totalInput" name="total">
                        </h3>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <div id="cancelOrder" tabindex="-1"
         class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button type="button"
                        class="closeDelete absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                         xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                              d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                              clip-rule="evenodd"></path>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <form id="cancelOrderForm" method="post">
                    @csrf
                    <div class="p-6 text-center">
                        <input type="hidden" id="userId">
                        <svg aria-hidden="true" class="mx-auto mb-4 text-gray-400 w-14 h-14 dark:text-gray-200"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24"
                             xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to cancel the order?</h3>
                        <button type="button"
                                class="cancelOrder text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                            Yes, I'm sure
                        </button>
                        <button type="button"
                                class="closeDelete text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                            No, cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script type="module">
        var dataTable;
        var modal;
        var cancelOrder;

        $(document).ready(function (event) {

            // MODAL SETTINGS
            const $targetEl = document.getElementById('orderModal');
            const options = {
                closable: true,
                backdrop: 'dynamic',
                onHide: () => {
                    if ($('#orderModal').hasClass("hidden")) {

                    }
                    // console.log('modal is hidden');
                },
                onShow: () => {
                    // console.log('modal is shown');
                },
                onToggle: () => {
                    // console.log('modal has been toggled');
                }
            };
            modal = new Modal($targetEl, options);

//CANCEL ORDER CONFIRMATION MODAL OPTIONS
            const $deleteTarget = document.getElementById('cancelOrder');
            const deleteOptions = {
                closable: true,
                backdrop: 'dynamic',
                onHide: () => {
                    // console.log('modal is hidden');
                },
                onShow: () => {
                    // console.log('modal is shown');
                },
                onToggle: () => {
                    // console.log('modal has been toggled');
                }
            };
            cancelOrder = new Modal($deleteTarget, deleteOptions);

            // DELETE USER MODAL WITH CONFIRMATION
            var orderToCancel;
            $(document).on('click', '.cancellation', function () {
                cancelOrder.show();
                var $row = $(this).closest('tr');
                var data = dataTable.row($row).data();

                // orderToCancel = id;
                $(document).on('click', '.cancelOrder', function (event) {

                    $.ajax({
                        url: "{{url('user/cancelOrder')}}",
                        type: "post",
                        dataType: 'json',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "data": data
                        },
                        success: function (response) {

                            $('#orderDatatable').DataTable().ajax.reload();
                            cancelOrder.hide();

                        },
                    });
                    event.preventDefault();
                });
            });

            // CONFIRMATION MODAL CLOSING
            $(document).on('click', '.closeDelete', function () {
                $('#cancelOrderForm')[0].reset();
                cancelOrder.hide();
            });






            dataTable = $('#orderDatatable').DataTable({
                "processing": true,
                "serverSide": true,

                "ajax": {
                    type: "POST",
                    url: "{{route('user.orders')}}",
                    "data": {
                        "_token": "{{ csrf_token() }}"
                    },
                },
                "columns": [
                    {
                        "data": "DT_RowIndex", orderable: false, searchable: false
                    },
                    {
                        "data": "order_title", "name": "order_title"
                    },
                    {
                        "data": "quantity", "name": "quantity"
                    },
                    {
                        "data": "price", "name": "price"
                    },
                    {
                        "data": "status", "name": "status"
                    },
                    {
                        "data": "country", "name": "country"
                    },
                    {
                        "data": "date", "name": "date"
                    },
                    {
                        "data": "action", "name": "action", orderable: true, searchable: true
                    },
                ],
                "columnDefs": [
                    {
                        "targets": 4,
                        createdCell: function (cell, cellData, rowData, rowIndex, colIndex) {
                            if (cellData == 'paid') {
                                $(cell).css('color', 'green'); // Set the text color to green
                            }else{
                                $(cell).css('color', 'red'); // Set the text color to green
                            }
                        }
                    }
                ],
                "footerCallback": function(row, data, start, end, display) {
                    var api = this.api();

                    // Filter and calculate the total revenue for paid orders
                    var total = api
                        .column(3, { page: 'current' })
                        .data()
                        .reduce(function(sum, value, index) {
                            var orderStatus = api.row(index).data()['status'];
                            console.log(orderStatus);
                                if (orderStatus === 'paid') {
                                    return sum + parseFloat(value);
                                } else {
                                    return sum;
                                }
                                }, 0);

                                // Add the total row at the bottom
                                $('#totalRevenueFooter').html('Total Revenue: ');
                                $('#totalPrice').html(total.toFixed(2) + '$');
                }
            });


            $(document).on('click', '.viewOrder', function (event) {
                event.preventDefault();
                var $row = $(this).closest('tr');
                var data = dataTable.row($row).data();
                var id = data.id;
// console.log(id);
                var listItems = '';
                var total = 0;
                $.ajax({
                    url: "{{route('user.showOrderDetails')}}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        id: id
                    },
                    type: 'post',
                    success: function (result) {
                        var data = result.data;
                        var items = data.items;
                        $.each(items, function (index) {
                            var product = items[index];
                            // console.log(product);
                            //  var name = product.product_name;
                            total += parseInt(product.price);
                            listItems += `
                            <li class="py-3 sm:py-4">
                                    <div class="flex items-center space-x-4">
                                        <div class="flex-1 min-w-0">
                                                <p class="text-lg font-weight-bold text-gray-900 truncate dark:text-white">
                                                            ${product.product_name}
                                                </p>
                                        </div>
                                        <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                            $${product.price}
                                        </div>
                                        <input type="hidden" name="${product.id}" value="${product.price}">
                                    </div>
                            </li>`
                        });
                        $('#product_receipt').html(listItems);
                        $('#totalPrice').text('$' + total);
                        modal.show();
                    }
                });

            });
            $('.closeModal').on('click', function (event) {
                // modal.reset();
                modal.hide();
            });
        });

    </script>
</x-app-layout>
