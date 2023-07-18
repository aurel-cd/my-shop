<x-guest-layout>
<div class="container">
    <div class="row justify-content-center">
        <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
            @auth
                @if( Auth::user()->hasRole('admin') )
                    <a href="{{ route('admin.dashboard') }}"
                       class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
                @endif
                @if( Auth::user()->hasRole('user') )
                    <a href="{{ route('user.dashboard') }}"
                       class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>

                @endif
                @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                       class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                @endif
            @endauth
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="flex card-header justify-center font-bold">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="mb-3">
                            <div>
                                <x-input-label for="email" :value="__('Email Address')"/>
                                <x-text-input id="email" class="@error('email') is-invalid @enderror block mt-1 w-full" type="email" name="email" :value="old('email')" required
                                              autofocus autocomplete="username"/>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0 flex justify-end">
                            <x-primary-button class="ml-3">
                                {{ __('Send Password Reset Link') }}
                            </x-primary-button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</x-guest-layout>
