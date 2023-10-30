@extends('template.main')
@section('content')
    <div class="container-xxl flegrow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"><a href="{{ route('clients.index') }}">
            Клиенты</a> / Клиент {{ $client->email }} /</span>
            Редактировать</h4>
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header">Детали профиля</h5>

                    <hr class="my-0">
                    <div class="card-body">



                        <form id="formAccountSettings" method="POST" action="{{ route('client.update', $client->id) }}">
                            @csrf
                            @method('patch')
                            <div class="row">

                                <div class="mb-3 col-md-6">
                                    <label for="avatar_image" class="form-label">Аватар</label>
                                    @if (!empty($client->avatar_image))
                                        <div class="input-group">
                                            <img src="{{ Storage::url($client->avatar_image) }}" class="w-px-100">
                                        </div>
                                    @else
                                    @endif
                                    <div class="input-group">
                                        <input type="file" class="form-control" id="avatar_image" name="avatar_image"
                                            value="{{ $client->avatar_image }}">
                                    </div>
                                    @error('avatar_image')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="firstName" class="form-label">Имя</label>
                                    <input class="form-control" type="text" id="firstName" name="name"
                                        value="{{ $client->name }}" autofocus autocomplete="name" required>
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="lastName" class="form-label">Возраст</label>
                                    <input class="form-control" type="text" name="age" id="lastName"
                                        value="{{ $client->age }}" autofocus autocomplete="age" required>
                                    @error('age')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3 col-md-6">
                                    <label for="email" class="form-label">E-mail</label>
                                    <input class="form-control" type="text" id="email" name="email"
                                        value="{{ $client->email }}" autofocus autocomplete="email" required>
                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <input type="hidden" name="client_id" value="{{$client->id}}">
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="email" class="form-label">Пол</label>
                                    <input class="form-control" type="text" id="email" name="gender"
                                        value="{{ $client->gender }}" autofocus autocomplete="gender" required>
                                    @error('gender')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <input type="hidden" name="client_id" value="{{$client->id}}">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="language" class="form-label">Страна</label>
                                    <select id="language" class="select2 form-select" name="country_id">
                                        @foreach ($countries as $id => $country)
                                        <option value="{{ $id }}"
                                            {{ $id == $client->country_id ? 'selected' : '' }}>
                                            {{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('country_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="phoneNumber">Номер телефона</label>
                                    <div class="input-group input-group-merge">
                                        <input type="text" id="phoneNumber" name="phone_number" class="form-control"
                                            value="{{ $client->phone_number }}" autofocus autocomplete="phone_number" required>
                                        @error('phone_number')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="demo-inline-spacing">
                                <button type="submit" class="btn btn-primary">Сохранить</button>
                                <a href="{{ route('clients.index') }}" class="btn btn-secondary">Отмена</a>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
