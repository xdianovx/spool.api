@extends('template.main')
@section('content')
    <div class="container-xxl flegrow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"><a href="{{ route('settings.index') }}">
                    Настройки</a> / {{$setting->id}} / </span>Редактировать</h4>

        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header">Детали</h5>

                    <hr class="my-0">
                    <div class="card-body">

                        <form id="formAccountSettings" method="POST" action="{{ route('setting.update', $setting->id) }}">
                            @csrf
                            @method('patch')
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Ключь*</label>
                                    <input class="form-control" type="text" name="key"
                                        value="{{ $setting->key }}" autofocus autocomplete="key" required>
                                    @error('key')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label  class="form-label">Значение*</label>
                                    <input class="form-control" type="text"  name="value"
                                        value="{{ $setting->value }}" required>
                                    @error('value')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary">Сохранить</button>
                                <a href="{{ route('settings.index') }}" class="btn btn-secondary">Отмена</a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
