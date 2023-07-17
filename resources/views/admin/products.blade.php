<x-admin-layout>
    @section('links')
        <link rel="stylesheet" href="{{Vite::asset('resources/assets/datatable/datatable.css')}}">
        <link href="
https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css
" rel="stylesheet">
    @endsection
    <div class="py-4 px-2 mt-14 sm:ml-64 bg-[#61a5c2]">
        <div class="relative py-4 px-4 bg-[#a9d6e5] overflow-x-auto shadow-md sm:rounded-lg">
            <div>
                <caption class=" text-lg font-semibold text-left  text-gray-200 dark:text-white dark:bg-gray-800">
                    <div class="flex justify-end mt-4">

                        <button type="button" data-modal-toggle="addProductModal" data-modal-target="addProductModal"
                                class="text-white addUserToggle bg-[#2c7da0] rounded-lg shadow-lg hover:bg-[#61a5c2] focus:ring-4 focus:outline-none focus:ring-[#61a5c2] font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-[#4285F4]/55 mr-2 mb-2">
                            <svg class="w-4 h-4 mr-2 -ml-1" fill="none" stroke="currentColor"
                                 stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                 aria-hidden="true">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="2" d="M9 1v16M1 9h16"/>
                            </svg>
                            Add Product
                        </button>

                    </div>
                </caption>
                <table id="productDataTable" class="w-full text-sm text-left text-dark dark:text-gray-400">

                    <thead
                        class="text-dark border-[#2c7da0] font-weight-bolder text-md dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-4 py-4">Id</th>
                        <th scope="col" class="px-4 py-4">Images</th>
                        <th scope="col" class="px-4 py-4">Product Name</th>
                        <th scope="col" class="px-4 py-4">Description</th>
                        <th scope="col" class="px-4 py-4">Brand</th>
                        <th scope="col" class="px-4 py-4">Price</th>

                        <th scope="col" class="px-4 py-4">
                            <span class="sr-only">Actions</span>
                        </th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>

            </div>
        </div>
    </div>

    <style></style>

    <div id="addProductModal" tabindex="-1"
         class="overflow-y-auto hidden overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full flex"
         aria-modal="true" role="dialog">
        <div class="mt-20">
            <!-- Modal content -->
            <div class="relative p-4 bg-[#a9d6e5] rounded-lg shadow dark:bg-gray-800 sm:p-5">
                <!-- Modal header -->
                <div
                    class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                    <h3 class="head text-lg font-semibold text-gray-900 dark:text-white">
                        Add Product
                    </h3>

                    <button type="button"
                            class="resetModal absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
                            data-modal-hide="addProductModal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                             xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                  d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                  clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form method="post" id="addProductForm"
                      enctype="multipart/form-data">
                    @csrf

                    <div id="alert-3"
                         class="flex hidden p-4 mb-4 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                         role="alert">
                        <svg class="w-4 h-4 text-gray-800 dark:text-white" aria-hidden="true"
                             xmlns="http://www.w3.org/2000/svg" fill="green" viewBox="0 0 18 18">
                            <path
                                d="M3 7H1a1 1 0 0 0-1 1v8a2 2 0 0 0 4 0V8a1 1 0 0 0-1-1Zm12.954 0H12l1.558-4.5a1.778 1.778 0 0 0-3.331-1.06A24.859 24.859 0 0 1 6 6.8v9.586h.114C8.223 16.969 11.015 18 13.6 18c1.4 0 1.592-.526 1.88-1.317l2.354-7A2 2 0 0 0 15.954 7Z"/>
                        </svg>
                        <div class="alertContent ml-3 text-sm font-medium">
                            <p class="productAdded hidden"> Product Added Successfully! </p>
                            <p class="productUpdated hidden"> Product Data Updated Successfully! </p>
                        </div>
                        <button type="button"
                                class="ml-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700"
                                data-dismiss-target="#alert-3" aria-label="Close">
                            <span class="sr-only">Close</span>
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                      d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                      clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <input type="hidden" id="id" name="id" value="">
                        <!-- Name -->
                        <div>
                            <x-input-label for="productName" :value="__('Product Name')"/>
                            <x-text-input placeholder="Type product name" id="productName" class="block mt-1 w-full"
                                          type="text" name="productName"
                                          :value="old('productName')" required autofocus
                                          autocomplete="productName"/>
                            <x-input-error :messages="$errors->get('productName')" class="mt-2"/>
                        </div>

                        <!-- Category -->
                        <div>
                            <x-input-label for="productCategory" :value="__('Category')"/>
                            {{--                            <x-text-input id="productCategory" class="block mt-1 w-full" type="text" name="productCategory"--}}
                            {{--                                          :value="old('productCategory')" required autofocus autocomplete="productCategory"/>--}}
                            {{--                            <x-input-error :messages="$errors->get('productCategory')" class="mt-2"/>--}}
                            <select name="productCategory" id="productCategory"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="select" selected>Select a category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('productCategory')" class="mt-2"/>
                        </div>

                        <!-- Brand -->
                        <div>
                            <x-input-label for="brand" :value="__('Brand')"/>
                            <select name="brand" id="brand"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="select" selected>Select a brand</option>
                                @foreach($brands as $brand)
                                    <option value="{{ $brand->id }}">{{ $brand->brandName }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('brand')" class="mt-2"/>
                        </div>
                        <!-- Price -->
                        <div>
                            <x-input-label for="price" :value="__('Price')"/>
                            <x-text-input placeholder="Price" id="price" class="block mt-1 w-full" type="number"
                                          name="price"
                                          :value="old('price')" required autocomplete="price"/>
                            <x-input-error :messages="$errors->get('price')" class="mt-2"/>
                        </div>
                    </div>
                    <div class="grid grid-cols-4 gap-4 mt-4 mb-4">
                        <div>
                            <x-input-label for="color" :value="__('Color')"/>
                            <select name="color" id="color"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="select" selected>Select a color</option>
                                @foreach($colors as $color)
                                    <option value="{{ $color->id }}">{{ $color->color_name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('color')" class="mt-2"/>
                        </div>
                        <div>
                            <x-input-label for="size" :value="__('Size')"/>
                            <select name="size" id="size"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="select" selected>Select a size</option>
                                @foreach($sizes as $size)
                                    <option value="{{ $size->id }}">{{ $size->size_value }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('size')" class="mt-2"/>
                        </div>
                        <div>
                            <x-input-label for="quantity" :value="__('Inventory')"/>
                            <x-text-input id="quantity" class="block mt-1 w-full" type="number" min="0" max="100"
                                          name="quantity"
                                          :value="old('quantity')" required autocomplete="quantity"/>
                            <x-input-error :messages="$errors->get('quantity')" class="mt-2"/>
                        </div>
                        <div>
                            <x-input-label for="discount" :value="__('Discount')"/>
                            <x-text-input id="discount" class="block mt-1 w-full" type="tel" name="discount"
                                          :value="old('discount')" required autocomplete="discount"/>
                            <x-input-error :messages="$errors->get('discount')" class="mt-2"/>
                        </div>
                    </div>

                    <div>
                        <x-input-label for="description" :value="__('Description')"/>
                        <textarea placeholder="Write product description here" id="description"
                                  class="block mt-1 w-full"
                                  type="tel" name="description"
                                  :value="old('description')" required autocomplete="description"></textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2"/>
                    </div>
                    <div class="mt-4">
                        <x-input-label for="image" :value="__('Product Images')"/>

                        <div class=" items-center justify-center w-full">
                            <div class="flex h-50 w-150" id="preview">
                            </div>
                            <input name="images[]" id="images" accept="image/*"
                                   class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                   id="multiple_files" type="file" multiple>
                            </label>
                        </div>
                        <x-input-error :messages="$errors->get('images')" class="mt-2"/>

                    </div>
                    <div
                        class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">


                    </div>
                    <div class="flex justify-between">
                        <x-secondary-button type="reset" class="hidden" id="resetAddProduct">
                            {{__('Close')}}
                        </x-secondary-button>
                        <x-primary-button class="add ml-50 end-0" type="submit" id="addProductBtn">
                            {{ __('Add Product') }}
                        </x-primary-button>
                        <x-primary-button class="edit ml-50 end-0 hidden" type="submit" id="editProductBtn">
                            {{ __('Save Changes') }}
                        </x-primary-button>
                    </div>
                </form>

            </div>

        </div>
    </div>

    {{--        delete PRODUCT
    --}}
    <div id="deleteProduct" tabindex="-1"
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
                <form id="deleteProductForm" method="post">
                    @csrf
                    <div class="p-6 text-center">
                        <input type="hidden" id="userId">
                        <svg aria-hidden="true" class="mx-auto mb-4 text-gray-400 w-14 h-14 dark:text-gray-200"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to
                            delete this Product?</h3>
                        <button type="button"
                                class="deleteProductBtn text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
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

    <style>
        .image-container {
            position: relative;
            display: inline-block;
        }

        .delete-btn {
            position: absolute;
            top: 4px;
            right: 4px;
            margin: 0;
            padding: 4px;
            background-color: red;
            color: white;
            border: none;
            border-radius: 50%;
            font-size: 12px;
            cursor: pointer;
        }


    </style>

    <script type="module">
        var dataTable;
        var modal;
        var deleteConfirm;
        var validator;
        $(document).ready(function (event) {
            dataTable = $('#productDataTable').DataTable({
                "processing": true,
                "serverSide": true,

                "ajax": {
                    type: "POST",
                    url: "{{route('admin.products')}}",
                    "data": {
                        "_token": "{{ csrf_token() }}"
                    },
                },
                "columns": [
                    {
                        "data": "DT_RowIndex", orderable: false, searchable: false
                    },
                    {
                        "data": "image", "name": "images"
                    },
                    {
                        "data": "product_name", "name": "product_name"
                    },

                    {
                        "data": "product_desc", "name": "product_desc"
                    },
                    {
                        "data": "brand", "name": "brand"
                    },
                    {
                        "data": "price", "name": "price"
                    },

                    {
                        "data": "action", "name": "action", orderable: true, searchable: true
                    },
                ]
            });

// MODAL SETTINGS
            //ADD AND EDIT USER MODAL OPTIONS
            const $targetEl = document.getElementById('addProductModal');
            const options = {
                closable: true,
                backdrop: 'dynamic',
                onHide: () => {
                    if ($('#addProductModal').hasClass("hidden")) {
                        if (!($('.productAdded').hasClass("hidden"))) {
                            $('.productAdded').addClass('hidden');
                        }
                        if (!($('.productUpdated').hasClass("hidden"))) {
                            $('.productUpdated').addClass('hidden');
                        }
                        if (!$('[modal-backdrop]') === null) {
                            $('[modal-backdrop]').remove();
                        }
                        if (!$('.edit').hasClass('hidden')) {
                            $('.edit').addClass('hidden');
                        }
                        if ($('.add').hasClass('hidden')) {
                            $('.add').removeClass('hidden')
                        }
                        if (!$('#alert-3').hasClass('hidden')) {
                            $('#alert-3').addClass('hidden')
                        }
                        if ($('.add').attr('disabled')) {
                            $('.add').removeAttr('disabled', 'disabled')
                        }
                        if ($('.edit').attr('disabled')) {
                            $('.edit').removeAttr('disabled', 'disabled')
                        }
                        $('#preview').empty();

                        $('#addProductForm')[0].reset();
                        $('#addProductForm').validate().resetForm();
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

            //DELETE USER CONFIRMATION MODAL OPTIONS
            const $deleteTarget = document.getElementById('deleteProduct');
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
            deleteConfirm = new Modal($deleteTarget, deleteOptions);

        });


        {{--            // ADD NEW USER MODAL PROCESSING--}}
        $(document).on('click', '#addProductBtn', function (event) {

            event.preventDefault();
            var form = $('#addProductForm')[0];
            var formData = new FormData(form);
            console.log(formData);
            $.ajax({
                type: "post",
                url: "{{route('admin.createProduct')}}",
                data: formData,
                dataType: "json",
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response.code = 200) {
                        $('.productAdded').removeClass('hidden');
                        $('#alert-3').removeClass('hidden');
                        $('#addProductBtn').attr('disabled', true);
                        $('#productDataTable').DataTable().ajax.reload();
                    }
                },
            });
        });
        // VALIDATION WITH JQUERY VALIDATOR
        var $addProduct = $('#addProductForm');
        if ($addProduct.length) {
            validator = $addProduct.validate({
                rules: {
                    productName: {
                        required: true
                    },
                    productCategory: {
                        required: {
                            depends: function (element) {
                                if ('select' == $('#productCategory').val()) {
                                    //Set predefined value to blank.
                                    $('#productCategory').val('');
                                }
                                return true;
                            }
                        }
                    },
                    brand: {
                        required: {
                            depends: function (element) {
                                if ('select' == $('#brand').val()) {
                                    //Set predefined value to blank.
                                    $('#brand').val('');
                                }
                                return true;
                            }
                        }
                    },
                    price: {
                        required: true
                    },
                    color: {
                        required: {
                            depends: function (element) {
                                if ('select' == $('#color').val()) {
                                    //Set predefined value to blank.
                                    $('#color').val('');
                                }
                                return true;
                            }
                        }
                    },
                    size: {
                        required: {
                            depends: function (element) {
                                if ('select' == $('#size').val()) {
                                    //Set predefined value to blank.
                                    $('#size').val('');
                                }
                                return true;
                            }
                        }
                    },
                    quantity: {
                        required: true
                    },
                    discount: {
                        required: true
                    },
                    description: {
                        required: true
                    },
                    images: {
                        required: true,
                        check_type:true
                    },
                },
                messages: {
                    productName: {
                        required: 'Product Name is required!',
                    },
                    productCategory: {
                        required: 'Product Category is required!',
                    },
                    brand: {
                        required: 'Product brand is required!',
                    },
                    price: {
                        required: 'Product price is required!',
                    },
                    color: {
                        required: 'Product color is required!',
                    },
                    size: {
                        required: 'Product size is required!',
                    },
                    quantity: {
                        required: 'Product quantity is required!',
                    },
                    discount: {
                        required: 'Product discount is required!',
                    },
                    description: {
                        required: 'Product description is required!',
                    },
                    images: {
                        required: 'Product Images are required!',
                        check_type: 'Incorrect filetype'
                    },
                },
                highlight: function (element) {
                    $(element).parent().addClass('text-red-600')
                },
                unhighlight: function (element) {
                    $(element).parent().removeClass('text-red-600')
                },

            });
        };
        $.validator.addMethod("check_type", function(){
            var fileInput = $('input[name="images[]"]')[0];
            var files = fileInput.files;
            var allowedExtensions = ['jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG'];

            for (var i = 0; i < files.length; i++) {
                var file = files[i];
                var fileName = file.name;
                var fileExtension = fileName.split('.').pop().toLowerCase();

                if (allowedExtensions.indexOf(fileExtension) === -1) {
                    console.log('Invalid file type: ' + fileExtension);
                    return false;
                    // Perform your validation error handling here
                }
                return true;
            }
        });

        //AUTOFILL THE EDIT PRODUCT DATA MODAL FORM
        $(document).on('click', '.editProductBtn', function (event) {
            event.preventDefault();
            var $row = $(this).closest('tr');
            var data = dataTable.row($row).data();
            var id = data.id;


            $.ajax({
                url: "{{route('admin.showProductData')}}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    id: id
                },
                type: 'post',
                success: function (result) {

                    var data = result.data;
                    var images = data.images;
                    console.log(images);

                    var productEntry = data.product_entries[0];
                    var size = productEntry.size_id;
                    var color = productEntry.color_id;
                    var quantity = productEntry.quantity;
                    $('h3.head').html('Update Product');
                    $('#id').val(data.id);
                    $('#productName').val(data.product_name);
                    $('#productCategory').val(data.category_id);
                    $('#brand').val(data.brands_id);
                    $('#price').val(data.price);
                    $('#size').val(size);
                    $('#color').val(color);
                    $('#quantity').val(quantity);
                    if (data.discount_id == null) {
                        $('#discount').val('0');
                    } else {
                        $('#discount').val(data.discount_id);
                    }
                    $('#description').val(data.product_desc);
                    $('.add').addClass('hidden');
                    $('.edit').removeClass('hidden');
                    var form = $('#addProductForm')[0];
                    var formData = new FormData(form);

                    var imagePath ='{{asset('storage/images/')}}';
                    for (let i = 0; i < images.length; i++) {
                        const imageName = images[i].image_name;
                        const imageId = images[i].id;
                        const img = `
    <div class="image-container">
      <a href="${imagePath}/${imageName}" download>
        <img src="${imagePath}/${imageName}" class="upload-pp w-40 flex mx-5 my-3 " style="width:70px; height:70px; border-radius:50%;" id="${imageId}" alt="profil">
      </a>
      <button class="delete-btn deleteImage" data-image-id="${imageId}">X</button>
    </div>`;
                        const image = `<input type="hidden" id="${imageId}" value="${imageName}" name="imageInput[]">`;

                        $('#preview').append(img);
                        $('#preview').append(image);
                    }


                    modal.show();
                }
            });

        });

        // EDIT EXISTING PRODUCT DATA
        $(document).on('click', '#editProductBtn', function (event) {
            event.preventDefault();
            var form = $('#addProductForm')[0];
            var formData = new FormData(form);
            $.ajax({
                type: "post",
                url: "{{route('admin.updateProductData')}}",
                data: formData,
                dataType: "json",
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response.code = 200) {
                        $('.productUpdatedUpdated').removeClass('hidden');
                        $('#alert-3').removeClass('hidden');
                        $('#editProductBtn').attr('disabled', true);
                        $('#productDataTable').DataTable().ajax.reload();
                    }
                },
            });
        });


        // DELETE USER MODAL WITH CONFIRMATION
        var productIdToDelete;
        $(document).on('click', '.deleteBtn', function () {
            deleteConfirm.show();
            var $row = $(this).closest('tr');
            var data = dataTable.row($row).data();
            var id = data.id;
            productIdToDelete = id;
            $(document).on('click', '.deleteProductBtn', function (event) {
                $.ajax({
                    url: "{{route('admin.deleteProduct')}}",
                    type: "post",
                    dataType: 'json',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id": productIdToDelete
                    },
                    success: function (response) {
                        $('#productDataTable').DataTable().ajax.reload();
                        deleteConfirm.hide();
                    },
                    error: function (response) {
                        alert('failed');
                    }
                });
                event.preventDefault();
            });
        });

        //RESET THE ADDProduct MODAL onclose
        $(document).on('click', '.resetModal', function () {
            modal.hide();
            $('h3.head').html('Add Product');
            $('#addProductForm').validate().resetForm();
        });


        // CONFIRMATION MODAL CLOSING
        $(document).on('click', '.closeDelete', function () {
            $('#deleteProductForm')[0].reset();
            $('#addProductForm').validate().resetForm();
            deleteConfirm.hide();
        });

        $(document).on('click', '.deleteImage', function(event) {
            event.preventDefault();
            let imageId = $(this).data('image-id');
            let url = '{{ route('admin.deleteImage', 'imageId') }}';
            url = url.replace('imageId', imageId);
            Swal.fire({
                title: 'Warning!',
                text: `Are you sure you want to delete this image?`,
                icon: 'warning',
                confirmButtonText: 'Delete',
                showCancelButton: true,
            }).then((result) => {
                if (result["isConfirmed"]) {
                    $.ajax({
                        url: url,
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        type: 'delete',
                        success: function () {
                            table.draw();
                        }
                    });
                    $(`#${imageId}`).remove();
                }
            });
        });
    </script>

</x-admin-layout>
