<x-guest-layout>
    <form class="form w-100"  method="POST" action="{{ route('password.store') }}" id="kt_password_reset_submit">
        @csrf
        <input type="hidden" name="token" value="{{ $request->route('token') }}">
        <div class="text-start mb-10">
            <h1 class="text-gray-900 fw-bolder mb-3">Reset Password ?</h1>
            {{-- <div class="text-gray-500 fw-semibold fs-6">Enter your email to reset your password.
            </div> --}}
        </div>
        <div class="fv-row mb-8">
            <input type="text" placeholder="Email" name="email" value="{{ old('email', $request->email) }}" autocomplete="off" class="form-control bg-transparent" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        <div class="fv-row mb-3">
            <input type="password" placeholder="Password" name="password" autocomplete="off" class="form-control bg-transparent" required autocomplete="new-password"  />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>
        <div class="fv-row mb-3">
            <input type="password" placeholder="Confirm Password" name="password_confirmation" autocomplete="off" class="form-control bg-transparent" required autocomplete="new-password"  />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>
        <div class="d-flex flex-wrap justify-content-center pb-lg-0">
            <button id="submitbutton" type="button" onclick="addUpdateData('submitbutton','kt_password_reset_submit','modal_large','no','{{ route('login') }}')" class="btn btn-primary">
                <label class="indicator-label">{{ __('Reset Password') }}</label>
                <label class="indicator-progress">{{ __('Please wait...') }}
                    <label class="spinner-border spinner-border-sm align-middle ms-2"></label>
                </label>
            </button>
            <a href="{{ route('login') }}" class="btn btn-light">{{ __('Cancel') }}</a>
        </div>
    </form>
    {{-- <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Reset Password') }}
            </x-primary-button>
        </div>
    </form> --}}
</x-guest-layout>
