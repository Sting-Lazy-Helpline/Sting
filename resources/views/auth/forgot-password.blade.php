<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <form class="form w-100"  method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="text-start mb-10">
            <h1 class="text-gray-900 fw-bolder mb-3">Forgot Password ?</h1>
            <div class="text-gray-500 fw-semibold fs-6">Enter your email to reset your password.
            </div>
        </div>
        <div class="fv-row mb-8">
            <input type="text" placeholder="Email" name="email" autocomplete="off" class="form-control bg-transparent" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        <div class="d-flex flex-wrap justify-content-center pb-lg-0">
            <button type="submit" id="kt_password_reset_submit" class="btn btn-primary me-4">{{ __('Submit') }}</button>
            <a href="{{ route('login') }}" class="btn btn-light">{{ __('Cancel') }}</a>
        </div>
    </form>



    {{-- <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form> --}}
</x-guest-layout>
