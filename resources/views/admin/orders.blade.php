<x-admin-layout>
    @section('links')
        <link rel="stylesheet" href="{{Vite::asset('resources/assets/datatable/datatable.css')}}">
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>
    @endsection

    <div class="py-4 px-4 mt-14 sm:ml-64 bg-[#61a5c2]">
        <div class="relative py-4 px-4 bg-[#a9d6e5] overflow-x-auto shadow-md sm:rounded-lg">
            <caption class="flex inline-flex text-lg justify-center p-5 text-gray-200 dark:text-white dark:bg-gray-800">
                <h1 class="text-center font-bold"> ORDER HISTORY</h1>
                <div class="inline-flex justify-center p-2">
                <h3  class="py-1 px-1 text-center text-xl font-bold">Filter:</h3><input class="border-[#aaa]" type="text" id="daterangePicker" name="daterangePicker">
                </div>
            </caption>
            <table id="orderDatatable" class="w-full text-sm text-left text-dark dark:text-gray-400">
                <thead class="text-dark  font-weight-bolder text-md dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-4 py-4"></th>
                    <th scope="col" class="px-4 py-4">Client</th>
                    <th scope="col" class="px-4 py-4">Order Title</th>
                    <th scope="col" class="px-4 py-4">Qty</th>
                    <th scope="col" class="px-4 py-4">Status</th>
                    <th scope="col" class="px-4 py-4">Price</th>
                    <th scope="col" class="px-4 py-4">Country</th>
                    <th scope="col" class="px-4 py-4">Date</th>
                    <th scope="col" class="px-4 py-4">
                        <span class="sr-only">Actions</span>
                    </th>
                </tr>
                </thead>
                <tbody>

                </tbody>
                <tfoot class="text-dark  font-weight-bolder text-md dark:bg-gray-700 dark:text-gray-400">
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th id="totalRevenueFooter"></th>
                <th id="totalPrice"></th>
                <th></th>
                <th></th>
                <th></th>

                </tfoot>
            </table>
        </div>
    </div>
    <div class="py-4 px-4 mt-5 sm:ml-64 bg-[#a9d6e5]">

        <div class="w-full flex inline-flex">

            <canvas id="itemCanvas">

            </canvas>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>

    <style>
        #daterangePicker {
            width: 220px;
            border-radius: 5px
        }
    </style>
    <script type="module">
        var dataTable;
        var modal;
        var chart;
        var chart2;

        let minDate;
        let maxDate;

        var daterange = $('#daterangePicker');
        //DATATABLE
        function fetch(start_date, end_date) {
            if(dataTable){
                dataTable.destroy();
            }
            dataTable = $('#orderDatatable').DataTable({
                "processing": true,
                "serverSide": true,

                "ajax": {
                    type: "post",
                    url: "{{route('admin.orders')}}",
                    "data": {
                        "_token": "{{ csrf_token() }}",
                        'start_date': start_date,
                        'end_date': end_date
                    },
                },
                "columns": [
                    {
                        "data": "DT_RowIndex", orderable: false, searchable: false
                    },
                    {
                        "data": "client", "name": "client"
                    },
                    {
                        "data": "order_title", "name": "order_title"
                    },
                    {
                        "data": "quantity", "name": "quantity"
                    },
                    {
                        "data": "status", "name": "status"
                    },
                    {
                        "data": "price", "name": "price"
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
                            } else {
                                $(cell).css('color', 'red'); // Set the text color to green

                            }
                        }
                    }
                ],
                "footerCallback": function (row, data, start, end, display) {
                    var api = this.api();

                    // Filter and calculate the total revenue for paid orders
                    var total = api
                        .column(5, {page: 'current'})
                        .data()
                        .reduce(function (sum, value, index) {
                            var orderStatus = api.row(index).data()['status'];
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
            // Item chart
            $.ajax({
                url: '{{route('admin.itemCharts')}}',
                method: 'GET',
                dataType: 'json',
                "data": {
                    "_token": "{{ csrf_token() }}",
                    'start_date': start_date,
                    'end_date': end_date
                },
                success: function (response) {
                    // console.log(response);
                    if (chart2) {
                        chart2.destroy();
                    }
                    // Create the chart using Chart.js
                    var ctx = document.getElementById('itemCanvas').getContext('2d');
                    chart2 = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: response.labels,
                            datasets: [{
                                label: response.label,
                                data: response.data,
                                backgroundColor: '#61a5c2',
                                borderColor: 'white',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            aspectRatio: 1.5,
                            scales: {
                                x: {
                                    display: true,
                                    title: {
                                        display: true,
                                        text: 'Ordered Products'
                                    }
                                },
                                y: {
                                    display: true,
                                    title: {
                                        display: true,
                                        text: 'QTY'
                                    },
                                    min: 0,
                                    max: 25
                                }
                            }
                        }
                    });
                },
                error: function (xhr, status, error) {
                    console.log('AJAX Error: ' + error);
                }
            });
        }

        daterange.daterangepicker({
                opens: 'right',
                locale: {
                    format: 'YYYY-MM-DD'
                },
                startDate: '2023-07-01',
                endDate: '2023-08-31',
            },
            function (start, end, label) {
                const startDate = start.format('YYYY-MM-DD');
                const endDate = end.format('YYYY-MM-DD');
                fetch(startDate,endDate);
            });
        fetch(daterange.data().startDate,daterange.data().endDate);

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


            $(document).on('click', '.viewOrder', function (event) {
                event.preventDefault();
                var $row = $(this).closest('tr');
                var data = dataTable.row($row).data();
                var id = data.id;
// console.log(id);
                var listItems = '';
                var total = 0;
                $.ajax({
                    url: "{{route('admin.showOrderDetails')}}",
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
            })
        });
    </script>

</x-admin-layout>
