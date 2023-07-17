<aside id="logo-sidebar" class="text-white fixed top-0 left-0 z-40 shadow-md w-64 h-screen pt-20 transition-transform -translate-x-full bg-[#2c7da0] sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700" aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto  dark:bg-gray-800">
        <div class="flex flex-col flex-1 pt-2 pb-4 overflow-y-auto">
            <div class="flex-1 px-1 space-y-1  divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                <ul class="pb-2 space-y-5 ml-0">
                    @role('admin')
                    <li>
                        <button type="button" class="flex  items-center w-full p-2 text-base hover:text-gray-900 text-white transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700" >


                            <x-nav-link class="w-full text-white hover:text-gray-900 no-underline"  :href="route('admin.home')" :active="request()->routeIs('admin.home')">
                                <div class="pr-2">
                                    <svg class=" w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"></path>
                                    </svg>
                                </div>
                                USERS
                            </x-nav-link>

                        </button>
                    </li>
                    @endrole
                    <li>
                        <button type="button" class="flex  items-center w-full p-2 text-base text-white hover:text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700" >
                            <x-nav-link class="w-full  text-white hover:text-gray-900 no-underline"  :href="route('admin.products')" :active="request()->routeIs('admin.products')">
                                <div class="pr-2">
                                    <svg class="w-6 h-6 " fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z"></path>
                                    </svg>
                                </div>
                                PRODUCTS
                            </x-nav-link>
                        </button>
                    </li>
                    <li>
                        <button type="button" class="flex  items-center w-full p-2 text-base text-white hover:text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700" >

                            <x-nav-link class="w-full  text-white hover:text-gray-900 no-underline"  :href="route('admin.orders')" :active="request()->routeIs('admin.orders')">
                                <div class="pr-2">
                                    <svg class="w-6 h-6  dark:text-gray-800 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 21 18">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.5 3h9.563M9.5 9h9.563M9.5 15h9.563M1.5 13a2 2 0 1 1 3.321 1.5L1.5 17h5m-5-15 2-1v6m-2 0h4"/>
                                    </svg>
                                </div>

                                ORDERS
                            </x-nav-link>
                        </button>
                    </li>
                    @role('admin')
{{--                    <li class="space-y-5">--}}
{{--                        <button type="button" class="flex items-center w-full p-2 text-base text-white hover:text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700" aria-controls="dropdown-layouts" data-collapse-toggle="dropdown-layouts">--}}

{{--                            <svg  class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">--}}
{{--                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"></path>--}}
{{--                            </svg>--}}

{{--                            <span class="flex-1 ml-3 text-left whitespace-nowrap" sidebar-toggle-item>Role & Permissions</span>--}}
{{--                            <svg sidebar-toggle-item class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>--}}
{{--                        </button>--}}
{{--                        <ul id="dropdown-layouts" class="hidden py-2 ml-5 space-y-2">--}}
{{--                            <li class="space-y-2">--}}
{{--                                <x-nav-link class="w-full text-white hover:text-gray-900 text-lg hover:no-underline"  :href="route('admin.roles.index')" :active="request()->routeIs('admin.roles.index')">--}}
{{--                                    Roles--}}
{{--                                </x-nav-link>                            </li>--}}
{{--                            <li class="space-y-2">--}}
{{--                                <x-nav-link class="w-full text-white hover:text-gray-900 text-lg hover:no-underline"  :href="route('admin.permissions.index')" :active="request()->routeIs('admin.permissions.index')">--}}
{{--                                    Permissions--}}
{{--                                </x-nav-link>--}}
{{--                            </li>--}}
                            @endrole
                        </ul>


            </div>
        </div>
    </div>
</aside>
