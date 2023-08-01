@extends('template.main')
@section('content')
    <div class="container-xxl flegrow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"><a href="{{ route('users.index') }}">
                    Администраторы</a> / Пользователь {{ $user->name }} /</span>
            Редактировать</h4>
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header">Детали профиля</h5>

                    <hr class="my-0">
                    <div class="card-body">



                        <form id="formAccountSettings" method="POST" action="{{ route('user.update', $user) }}">
                            @csrf
                            @method('patch')
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="firstName" class="form-label">Имя</label>
                                    <input class="form-control" type="text" id="firstName" name="name"
                                        value="{{ $user->name }}" autofocus autocomplete="name">
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="lastName" class="form-label">Фамилия</label>
                                    <input class="form-control" type="text" name="surname" id="lastName"
                                        value="{{ $user->surname }}" autofocus autocomplete="surname">
                                    @error('surname')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="email" class="form-label">E-mail</label>
                                    <input class="form-control" type="text" id="email" name="email"
                                        value="{{ $user->email }}" autofocus autocomplete="email">
                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="language" class="form-label">Роль</label>
                                    <select id="language" class="select2 form-select" name="role">
                                        <option value="admin" @if ($user->role == 'admin') {{ 'selected' }} @endif>
                                            Администратор</option>
                                        <option value="partner"
                                            @if ($user->role == 'partner') {{ 'selected' }} @endif>Партнер</option>
                                    </select>
                                    @error('role')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="phoneNumber">Номер телефона</label>
                                    <div class="input-group input-group-merge">
                                        <input type="text" id="phoneNumber" name="phone_number" class="form-control"
                                            value="{{ $user->phone_number }}" autofocus autocomplete="phone_number">
                                        @error('phone_number')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="organization" class="form-label">Пароль*</label>
                                    <input type="text" class="form-control" id="organization" name="password" autofocus
                                        autocomplete="password">
                                    @error('password')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="language" class="form-label">Партнерская компания</label>
                                    <select id="language" class="select2 form-select" name="partner_company_id">
                                        <option value=""
                                        @if ($user->partner_company_id == '') {{ 'selected' }} @endif>
                                        Без партнерской компании</option>
                                        @foreach ($partner_companies as $partner_company)
                                            <option value="{{ $partner_company->id }}"
                                                {{ $partner_company->id == $user->partner_company_id ? 'selected' : '' }}>
                                                {{ $partner_company->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('partner_company_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="demo-inline-spacing">
                                <button type="submit" class="btn btn-primary">Сохранить</button>
                                <button type="reset" class="btn btn-secondary">Отмена</button>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
