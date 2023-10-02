@extends('template.main')
@section('content')
    <div class="container-xxl flegrow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"><a href="{{ route('tickets.index') }}">
                    Билеты</a> / </span>Создать</h4>

        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header">Детали</h5>

                    <hr class="my-0">
                    <div class="card-body">

                        <form id="formAccountSettings" method="POST" action="{{ route('ticket.store') }}">
                            @csrf
                            <div class="row">

                                <div class="mb-3 col-md-6">
                                    <label for="firstPrice" class="form-label">Цена*</label>
                                    <input class="form-control" type="text" id="firstPrice" name="price"
                                        placeholder="Введите цену" value="{{ old('price') }}" required>
                                    @error('price')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="firstDiscountedPrice" class="form-label">Цена со скидкой</label>
                                    <input class="form-control" type="text" id="firstDiscountedPrice"
                                        name="discounted_price" placeholder="Введите цену"
                                        value="{{ old('discounted_price') }}">
                                    @error('discounted_price')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="video" class="form-label">Видео*</label>
                                    @if (!count($videos) == 0)
                                        <select id="video" class="select2 form-select" name="video_id">
                                            @foreach ($videos as $video)
                                                <option value="{{ $video->id }}"
                                                    {{ $video->id == old('video_id') ? 'selected' : '' }}>
                                                    {{ $video->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('video_id')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    @else
                                        <div class="text-danger">Записей не существует, создайте запись в таблице(Видео)
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary">Создать</button>
                                <a href="{{ route('tickets.index') }}" class="btn btn-secondary">Отмена</a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
