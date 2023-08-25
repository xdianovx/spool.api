@extends('template.main')
@section('content')
    <div class="container-xxl flegrow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"><a href="{{ route('users.index') }}">
                    Администраторы</a> / </span>Создать</h4>

        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header">Детали</h5>

                    <hr class="my-0">
                    <div class="card-body">

                        <form id="formAccountSettings" method="POST" action="{{ route('user.store') }}">
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="firstName" class="form-label">Имя*</label>
                                    <input class="form-control" type="text" id="firstName" name="name"
                                        placeholder="Введите ваше имя" value="{{ old('name') }}" required>
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="lastName" class="form-label">Фамилия*</label>
                                    <input class="form-control" type="text" name="surname" id="lastName"
                                        placeholder="Введите вашу фамилию" value="{{ old('surname') }}" required>
                                    @error('surname')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="email" class="form-label">E-mail*</label>
                                    <input class="form-control" type="text" id="email" name="email"
                                        placeholder="Введите почту формата john@example.com" value="{{ old('email') }}"
                                        required>
                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="language" class="form-label">Роль*</label>
                                    <select id="language" class="select2 form-select" name="role">
                                        @foreach ($roles as $id => $role)
                                            <option value="{{ $id }}"
                                                {{ $id == old('role') ? 'selected' : '' }}>
                                                {{ $role }}</option>
                                        @endforeach
                                    </select>
                                    @error('role')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="phoneNumber">Phone Number*</label>
                                    <div class="input-group input-group-merge">
                                        <input type="text" id="phoneNumber" name="phone_number" class="form-control"
                                            placeholder="John" value="{{ old('phone_number') }}" required>
                                    </div>
                                    @error('phone_number')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="organization" class="form-label">Пароль*</label>
                                    <input type="text" class="form-control" id="organization" name="password"
                                        placeholder="Введите пароль" value="{{ old('password') }}" required>
                                    @error('password')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="language" class="form-label">Партнерская компания</label>
                                    <select id="language" class="select2 form-select" name="partner_company_id">
                                        <option value=""
                                        @if (old('partner_company_id') == '') {{ 'selected' }} @endif>
                                        Без партнерской компании</option>
                                        @foreach ($partner_companies as $partner_company)
                                            <option value="{{ $partner_company->id }}"
                                                {{ $partner_company->id == old('partner_company_id') ? 'selected' : '' }}>
                                                {{ $partner_company->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('partner_company_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="demo-inline-spacing">
                                <button type="submit" class="btn btn-primary">Создать</button>
                                <a href="{{ route('users.index') }}" class="btn btn-secondary">Отмена</a>
                            </div>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
