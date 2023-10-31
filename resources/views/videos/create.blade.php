@extends('template.main')
@section('content')
    <div class="container-xxl flegrow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"><a href="{{ route('videos.index') }}">
                    Видео</a> / </span>Создать</h4>

        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header">Детали</h5>

                    <hr class="my-0">
                    <div class="card-body">

                        <form id="formAccountSettings" method="POST" action="{{ route('video.store') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="name" class="form-label">Название *</label>
                                    <input class="form-control" type="text" id="name" name="name"
                                        placeholder="Введите название" value="{{ old('name') }}" required>
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="category" class="form-label">Категория *</label>
                                    @if (!count($categories) == 0)
                                        <select id="category" class="select2 form-select" name="category_id">
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ $category->id == old('category_id') ? 'selected' : '' }}>
                                                    {{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    @else
                                        <div class="text-danger">Записей не существует, создайте запись в таблице «Категории»
                                        </div>
                                    @endif
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="partner_company" class="form-label">Партнерская компания *</label>
                                    @if (!count($partner_companies) == 0)
                                        <select id="partner_company" class="select2 form-select" name="partners_company_id">

                                            @foreach ($partner_companies as $partner_company)
                                                <option value="{{ $partner_company->id }}"
                                                    {{ $partner_company->id == old('partners_company_id') ? 'selected' : '' }}>
                                                    {{ $partner_company->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('partners_company_id')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    @else
                                        <div class="text-danger">Записей не существует, создайте запись в
                                            таблице «Партнерские компании»</div>
                                    @endif
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="image" class="form-label">Обложка *</label>
                                    <div class="input-group">
                                        <input type="file" class="form-control" id="image" name="image"
                                            value="{{ old('image') }}">
                                    </div>
                                    @error('image')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="image_banner" class="form-label">Баннер</label>
                                    <div class="input-group">
                                        <input type="file" class="form-control" id="image_banner" name="image_banner"
                                            value="{{ old('image_banner') }}">
                                    </div>
                                    @error('image_banner')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="video" class="form-label">Видео (ссылка на CDN)</label>
                                    <input class="form-control" type="text" id="video" name="video"
                                        placeholder="Введите ссылку" value="{{ old('video') }}" required>
                                        @error('video')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-message">Описание *</label>
                                    <textarea id="basic-default-message" class="form-control" name="description" placeholder="Текст" style="height: 234px;"
                                        required>{{ old('description') }}</textarea>
                                    @error('description')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="duration" class="form-label">Длительность (в секундах) *</label>
                                    <input class="form-control" type="text" id="duration" name="duration"
                                        placeholder="Введите длительность видео" value="{{ old('duration') }}" required>
                                    </input>
                                    @error('duration')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="event_date" class="form-label">Дата события *</label>
                                    <input class="form-control" type="date" id="event_date" name="event_date"
                                        placeholder="Введите дату события" value="{{ old('event_date') }}" required>
                                    </input>
                                    @error('event_date')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="minimum_age" class="form-label">Допустимый минимальный возраст *</label>
                                    <input class="form-control" type="text" id="minimum_age" name="minimum_age"
                                        placeholder="Введите минимальный возраст" value="{{ old('minimum_age') }}"
                                        required>
                                    </input>
                                    @error('minimum_age')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="firstName" class="form-label">Отображение в слайдере баннеров</label>
                                    <div class="form-check mt-2">
                                        <input name="display_slider" class="form-check-input" type="radio"
                                            value="false" id="defaultRadio1"
                                           checked="checked">
                                        <label class="form-check-label" for="defaultRadio1"> Нет </label>
                                    </div>
                                    <div class="form-check mt-1">
                                        <input name="display_slider" class="form-check-input" type="radio"
                                            value="true" id="defaultRadio2"
                                            @if (old('display_slider') == 'true')  @else @endif>
                                        <label class="form-check-label" for="defaultRadio2"> Да </label>
                                    </div>
                                    @error('display_slider')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary">Создать</button>
                                <a href="{{ route('videos.index') }}" class="btn btn-secondary">Отмена</a>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
