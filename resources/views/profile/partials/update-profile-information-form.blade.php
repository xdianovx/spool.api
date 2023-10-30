<form id="formAccountSettings" method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
    @csrf
    @method('patch')
    <div class="row">
        <!-- Name -->
        <div class="mb-3 col-md-6">
            <x-input-label class="form-label" for="name" :value="__('Имя')" />
            @if ($user->role == 1)
            <x-text-input id="name" name="name" type="text" class="form-control" :value="old('name', $user->name)" disabled
                autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
            @else
            <x-text-input id="name" name="name" type="text" class="form-control" :value="old('name', $user->name)" required
                autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
            @endif

        </div> 
        <!-- Surname -->
        <div class="mb-3 col-md-6">
            <x-input-label class="form-label" for="surname" :value="__('Фамилия')" />
            @if ($user->role == 1)
            <x-text-input id="surname" name="surname" type="text" class="form-control" :value="old('surname', $user->surname)" disabled
                autofocus autocomplete="surname" />
            <x-input-error class="mt-2" :messages="$errors->get('surname')" />
            @else
            <x-text-input id="surname" name="surname" type="text" class="form-control" :value="old('surname', $user->surname)" required
                autofocus autocomplete="surname" />
            <x-input-error class="mt-2" :messages="$errors->get('surname')" />
            @endif
        </div>
        <!-- Email -->
        <div class="mb-3 col-md-6">
            <x-input-label class="form-label" for="name" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="form-control" :value="old('email', $user->email)" required
                autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>
        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
        <div class="mb-3 col-md-6">
                <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                    {{ __('Your email address is unverified.') }}

                    <button form="send-verification"
                        class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                        {{ __('Click here to re-send the verification email.') }}
                    </button>
                </p>

                @if (session('status') === 'verification-link-sent')
                    <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                        {{ __('A new verification link has been sent to your email address.') }}
                    </p>
                @endif
            </div>
        @endif
        <!-- Phone number -->
        <div class="mb-3 col-md-6">
            <x-input-label class="form-label" for="phone_number" :value="__('Номер телефона')" />
            <x-text-input id="phone_number" name="phone_number" type="phone" class="form-control" :value="old('phone_number', $user->phone_number)"
                required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('phone_number')" />
        </div>
        <div class="mt-2">
            <x-primary-button>{{ __('Сохранить') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400">{{ __('Сохранено.') }}</p>
            @endif
        </div>
    </div>
</form>
