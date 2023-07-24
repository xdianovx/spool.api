@extends('template.main')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Пользователи /</span>Создать</h4>

    <div class="row">
      <div class="col-md-12">
        <div class="card mb-4">
          <h5 class="card-header">Детали профиля</h5>

          <hr class="my-0">
          <div class="card-body">
<form id="formAccountSettings" method="post" action="{{ route('user.store') }}" class="mt-6 space-y-6">
    @csrf
    @method('patch')
    <div class="row">
        <!-- Name -->
        <div class="mb-3 col-md-6">
            <x-input-label class="form-label" for="name" :value="__('Имя')" />
            <x-text-input id="name" name="name" type="text" class="form-control"  required
                autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div> 
        <!-- Surname -->
        <div class="mb-3 col-md-6">
            <x-input-label class="form-label" for="surname" :value="__('Фамилия')" />
            <x-text-input id="surname" name="surname" type="text" class="form-control"  required
                autofocus autocomplete="surname" />
            <x-input-error class="mt-2" :messages="$errors->get('surname')" />
        </div>
        <!-- Email -->
        <div class="mb-3 col-md-6">
            <x-input-label class="form-label" for="name" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="form-control"  required
                autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>
        <!-- Phone number -->
        <div class="mb-3 col-md-6">
            <x-input-label class="form-label" for="phone_number" :value="__('Номер телефона')" />
            <x-text-input id="phone_number" name="phone_number" type="phone" class="form-control"
                required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('phone_number')" />
        </div>
                <!-- Role-->
                <div class="mb-3 col-md-6">
                    <x-input-label class="form-label" for="role" :value="__('Роль')" />
                    <x-text-input id="role" name="role" type="phone" class="form-control"
                        required autocomplete="username" />
                    <x-input-error class="mt-2" :messages="$errors->get('role')" />
                </div>
        <div class="mt-2">
            <x-primary-button>{{ __('Создать') }}</x-primary-button>
        </div>
    </div>
</form>
</div>
</div>

</div>
</div>
</div>
@endsection