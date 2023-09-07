@extends('template.main')
@section('content')
    <div class="container-xxl flegrow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"><a href="{{ route('partners_companies.index') }}">
            Партнерские компании</a> / </span>Редактировать</h4>

        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header">Детали</h5>

                    <hr class="my-0">
                    <div class="card-body">

                        <form id="formAccountSettings" method="POST" action="{{ route('partners_company.update', $partners_company->id) }}">
                            @csrf
                            @method('patch')
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="firstName" class="form-label">Название*</label>
                                    <input class="form-control" type="text" id="firstName" name="name"
                                        value="{{ $partners_company->name }}" autofocus autocomplete="name" required>
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <input type="hidden" name="partners_company_id" value="{{$partners_company->id}}">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="firstCommission" class="form-label">Комиссия(%)*</label>
                                    <input class="form-control" type="text" id="firstCommission" name="commission"
                                    value="{{ $partners_company->commission }}" autofocus autocomplete="commission" required>
                                    @error('commission')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary">Сохранить</button>
                                <a href="{{ route('partners_companies.index') }}" class="btn btn-secondary">Отмена</a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
