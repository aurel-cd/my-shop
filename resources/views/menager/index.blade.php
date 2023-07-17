<x-admin-layout>
    @section('links')
        <link rel="stylesheet" href="{{Vite::asset('resources/assets/datatable/datatable.css')}}">
    @endsection
    <div class="py-4 mt-14 sm:ml-64">
        <div class="mx-auto px-4">
            <!-- Start coding here -->
            <div class="relative shadow-md sm:rounded-lg">
                <div class="relative py-4 px-4 bg-[#a9d6e5] overflow-x-auto shadow-md sm:rounded-lg">
                    <caption class=" text-lg font-semibold text-left  text-gray-200 dark:text-white dark:bg-gray-800">
                        <div class="flex justify-end mt-4">
                            <button type="button" data-modal-toggle="addUserModal" data-modal-target="addUserModal"
                                    class="text-white addUserToggle bg-[#2c7da0]  hover:bg-[#61a5c2] shadow-lg focus:ring-4 focus:outline-none focus:ring-[#61a5c2] font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-[#4285F4]/55 mr-2 mb-2">
                                <svg class="w-4 h-4 mr-2 -ml-1" fill="none" stroke="currentColor"
                                     stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                     aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z"></path>
                                </svg>
                                Add User
                            </button>
                        </div>
                    </caption>
                    <table id="dataTable" class="w-full text-sm text-left text-dark dark:text-gray-400">

                        <thead class="text-dark  font-weight-bolder text-md dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-4 py-4">Id</th>
                            <th scope="col" class="px-4 py-4">First Name</th>
                            <th scope="col" class="px-4 py-4">Last Name</th>
                            <th scope="col" class="px-4 py-4">Email</th>
                            <th scope="col" class="px-4 py-4">Phone</th>
                            <th scope="col" class="px-4 py-4">Role</th>
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

        {{--                ADD MODAL--}}
        <div id="addUserModal" tabindex="-1"
             class="overflow-y-auto hidden overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full flex"
             aria-modal="true" role="dialog">
            <div class="content relative p-4 w-full max-w-2xl h-full md:h-auto">
                <!-- Modal content -->
                <div class="relative p-4 bg-[#a9d6e5] rounded-lg shadow dark:bg-gray-800 sm:p-5">
                    <!-- Modal header -->
                    <div
                        class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                        <h3 class="head text-lg font-semibold text-gray-900 dark:text-white">
                            Add User
                        </h3>
                        <button type="button"
                                class="resetModal absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
                                data-modal-hide="addUserModal">
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
                    <form method="post" id="addUserForm"
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
                                <p class="userAdded hidden"> User Added Successfully! </p>
                                <p class="userUpdated hidden"> User Data Updated Successfully! </p>
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
                                <x-input-label for="firstName" :value="__('First Name')"/>
                                <x-text-input id="firstName" class="block mt-1 w-full" type="text" name="firstName"
                                              :value="old('firstName')" required autofocus
                                              autocomplete="firstName"/>
                                <x-input-error :messages="$errors->get('firstName')" id="firstName" class="error mt-2"/>
                            </div>

                            <!-- Last Name -->
                            <div>
                                <x-input-label for="lastName" :value="__('Last Name')"/>
                                <x-text-input id="lastName" class="block mt-1 w-full" type="text" name="lastName"
                                              :value="old('lastName')" required autofocus autocomplete="lastName"/>
                                <x-input-error :messages="$errors->get('lastName')" id="lastName-error" class="error mt-2"/>
                            </div>

                            <!-- Email Address -->
                            <div>
                                <x-input-label for="email" :value="__('Email')"/>
                                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                                              :value="old('email')" required autocomplete="username"/>
                                <x-input-error :messages="$errors->get('email')" class="error mt-2"/>
                            </div>
                            <!-- Phone -->
                            <div>
                                <x-input-label for="phone" :value="__('Phone')"/>
                                <x-text-input id="phone" class="block mt-1 w-full" type="tel" name="phone"
                                              :value="old('phone')" required autocomplete="phone"/>
                                <x-input-error :messages="$errors->get('phone')" class="error mt-2"/>
                            </div>
                            <!-- Password -->
                            <div>
                                <x-input-label for="password" :value="__('Password')"/>
                                <x-text-input id="password" class="block mt-1 w-full" type="password"
                                              name="password" required autocomplete="new-password"/>
                                <x-input-error :messages="$errors->get('password')" class="error mt-2"/>
                                <span class="error text-danger" id="password-error"></span>
                            </div>

                            <!-- Confirm Password -->
                            <div>
                                <x-input-label for="password_confirmation" :value="__('Confirm Password')"/>
                                <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                                              name="password_confirmation" required autocomplete="new-password"/>
                                <x-input-error :messages="$errors->get('password_confirmation')" class="error mt-2"/>
                            </div>
                        </div>
                        <!-- Role -->
                        <div class="items-center justify-content-around mt-4">
                            <x-input-label for="role" :value="__('Role')"/>
                            <select name="role"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                @foreach($roles as $role)
                                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('role')" class="error mt-2"/>
                        </div>
                        <div
                            class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">


                        </div>
                        <div class="flex justify-between">
                            <x-secondary-button type="reset" class="hidden" id="resetAddModal">
                                {{__('Close')}}
                            </x-secondary-button>
                            <x-primary-button class="add ml-50 end-0" type="submit" id="addUserBtn">
                                {{ __('Add User') }}
                            </x-primary-button>
                            <x-primary-button class="edit ml-50 end-0 hidden" type="submit" id="editUserBtn">
                                {{ __('Save Changes') }}
                            </x-primary-button>
                        </div>
                    </form>

                </div>

            </div>
        </div>

        <div id="deleteUser" tabindex="-1"
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
                    <form id="deleteUserForm" method="post">
                        @csrf
                        <div class="p-6 text-center">
                            <input type="hidden" id="userId">
                            <svg aria-hidden="true" class="mx-auto mb-4 text-gray-400 w-14 h-14 dark:text-gray-200"
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want
                                to delete this user?</h3>
                            <button type="button"
                                    class="deleteUserBtn text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
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

    </div>
        <script type="module">
            var dataTable;
            var modal;
            var deleteConfirm;

            var validator = null;

            $(document).ready(function (event) {
                // DATATABLE DATA PROCESSING AND DISPLAY
                dataTable = $('#dataTable').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "ajax": {
                        type: "POST",
                        url: "{{route('admin.users')}}",
                        "data": {
                            "_token": "{{ csrf_token() }}"
                        },
                    },
                    "columns": [
                        {
                            "data": "DT_RowIndex", orderable: false, searchable: false
                        },
                        {
                            "data": "firstName", "name": "firstName"
                        },
                        {
                            "data": "lastName", "name": "lastName"
                        },
                        {
                            "data": "email", "name": "email"
                        },
                        {
                            "data": "phone", "name": "phone"
                        },
                        {
                            "data": "role", "name": "role"
                        },

                        {
                            "data": "action", "name": "action", orderable: true, searchable: true
                        },
                    ]
                });

                // MODAL SETTINGS
                //ADD AND EDIT USER MODAL OPTIONS
                const $targetEl = document.getElementById('addUserModal');
                const options = {
                    closable: true,
                    backdrop: 'dynamic',
                    onHide: () => {
                        if ($('#addUserModal').hasClass("hidden")) {
                            if (!($('.userAdded').hasClass("hidden"))) {
                                $('.userAdded').addClass('hidden');
                            }
                            if (!($('.userUpdated').hasClass("hidden"))) {
                                $('.userUpdated').addClass('hidden');
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
                            window.addEventListener("click", function(event) {
                                if (event.target === $('[modal-backdrop]')) {
                                    $('#addUserForm')[0].reset();
                                }
                            });


                            $('#addUserForm')[0].reset();
                        }
                    },
                };
                modal = new Modal($targetEl, options);

                //DELETE USER CONFIRMATION MODAL OPTIONS
                const $deleteTarget = document.getElementById('deleteUser');
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


                //AUTOFILL THE EDIT USER DATA MODAL FORM
                $(document).on('click', '.editUserBtn', function (event) {
                    event.preventDefault();
                    var $row = $(this).closest('tr');
                    var data = dataTable.row($row).data();
                    var id = data.id;

                    $.ajax({
                        url: "{{route('admin.showUserData')}}",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            id: id
                        },
                        type: 'post',
                        success: function (result) {
                            var data = result.data;
                            var roles = data.roles[0];
                            var roleName = roles.name;

                            $('h3.head').html('Edit User');
                            $('#id').val(data.id);
                            $('#firstName').val(data.firstName);
                            $('#lastName').val(data.lastName);
                            $('#email').val(data.email);
                            $('#password').attr('disabled', 'disabled');
                            $('#password_confirmation').attr('disabled', 'disabled');
                            $('#phone').val(data.phone);
                            $('select option[value="' + roleName + '"]').attr('selected', 'selected');
                            $('.add').addClass('hidden');
                            $('.edit').removeClass('hidden');
                            modal.show();
                        }
                    });

                });

                // EDIT EXISTING USER DATA
                $(document).on('click', '#editUserBtn', function (event) {
                    event.preventDefault();
                    $.ajax({
                        type: "post",
                        url: "{{route('admin.updateUser')}}",
                        data: $('#addUserForm').serialize(),
                        dataType: "json",
                        success: function (response) {
                            if (response.code = 200) {
                                $('.userUpdated').removeClass('hidden');
                                $('#alert-3').removeClass('hidden');
                                $('#editUserBtn').attr('disabled', true);
                                $('#dataTable').DataTable().ajax.reload();
                            }
                        },
                    });
                });

                // ADD NEW USER MODAL PROCESSING
                var $addUser = $('#addUserForm');
                if ($addUser.length) {
                    validator = $addUser.validate({
                        rules: {
                            firstName: {
                                check_fname: true,
                                required: true

                            },
                            lastName: {
                                check_lname: true,
                                required: true
                            },
                            email: {

                                required: true
                            },
                            phone: {
                                check_phone: true,
                                minlength: 10,
                                maxlength: 10,
                                required: true
                            },
                            password: {
                                check_pass: true,
                                required: true,
                                minlength: 8
                            },
                            password_confirmation: {
                                required: true,
                                equalTo: '#password',
                                minlength: 8
                            }

                        },
                        messages: {
                            firstName: {
                                required: 'Complete the field!',
                                check_fname: 'Name should only contain characters'
                            },
                            lastName: {
                                required: 'Complete the field!',
                                check_lname: 'Last Name should only contain characters'
                            },
                            phone: {
                                required: 'Complete the field!',
                                check_phone: 'Invalid Phone number'
                            },
                            email: {
                                required: 'Complete the field!',
                                email: 'Please enter valid email!',
                            },
                            password: {
                                required: 'Complete the field!',
                                check_pass: 'Enter a valid password'
                            },
                            password_confirmation: {
                                required: 'Complete the field!',
                                equalTo: 'Passwords do not match'
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

                // validations
                $.validator.addMethod("check_fname", function () {
                    var pattern = /^[a-zA-Z]*$/;
                    var fname = $("#firstName").val();
                    if (pattern.test(fname)) {
                        return true;
                    }
                });
                $.validator.addMethod("check_lname", function () {
                    var pattern = /^[a-zA-Z]*$/;
                    var lname = $("#lastName").val();
                    if (pattern.test(lname)) {
                        return true;
                    }
                });
                $.validator.addMethod("check_phone", function () {
                    var pattern = /^[\(\)\.\- ]{0,}[0-9]{3}[\(\)\.\- ]{0,}[0-9]{3}[\(\)\.\- ]{0,}[0-9]{4}[\(\)\.\- ]{0,}$/;
                    var phone = $("#phone").val();
                    if (pattern.test(phone)) {
                        return true;
                    }
                });
                $.validator.addMethod("check_pass", function () {

                    var pass = $("#password").val();
                    var passPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}/;

                    if (passPattern.test(pass)) {
                        return true;
                    }
                });

                $(document).on('click', '#addUserBtn', function (event) {
                    event.preventDefault();
                    $('.error').addClass('text-danger');
                    $.ajax({
                        type: "post",
                        url: "{{route('admin.addUser')}}",
                        data: $('#addUserForm').serialize(),
                        dataType: "json",

                        success: function (response) {
                                $('.userAdded').removeClass('hidden');
                                $('#alert-3').removeClass('hidden');
                                $('#addUserBtn').attr('disabled', true);
                                $('#dataTable').DataTable().ajax.reload();

                        },

                        error: function(response){
                            $('.error').addClass('text-danger');

                            var res = response.responseJSON;


                            $('#addUserForm').validate().showErrors(res.errors);
                        }
                    });
                });

                //RESET THE ADDUSER MODAL onclose
                $(document).on('click', '.resetModal', function () {
                    modal.hide();
                    $('h3.head').html('Add User');
                });

                // DELETE USER MODAL WITH CONFIRMATION
                var userIdToDelete;
                $(document).on('click', '.deleteBtn', function () {
                    deleteConfirm.show();
                    var $row = $(this).closest('tr');
                    var data = dataTable.row($row).data();
                    var id = data.id;

                    userIdToDelete = id;
                    $(document).on('click', '.deleteUserBtn', function (event) {
                        $.ajax({
                            url: "{{url('admin/deleteUserById')}}",
                            type: "post",
                            dataType: 'json',
                            data: {
                                "_token": "{{ csrf_token() }}",
                                "id": userIdToDelete
                            },
                            success: function (response) {

                                $('#dataTable').DataTable().ajax.reload();
                                deleteConfirm.hide();

                            },
                        });
                        event.preventDefault();
                    });
                });

                // CONFIRMATION MODAL CLOSING
                $(document).on('click', '.closeDelete', function () {
                    $('#deleteUserForm')[0].reset();
                    deleteConfirm.hide();
                });


            });
        </script>

</x-admin-layout>
