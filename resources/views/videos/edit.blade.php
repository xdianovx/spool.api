@extends('template.main')
@section('content')
    <div class="container-xxl flegrow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"><a href="{{ route('videos.index') }}">
            Видео</a> / </span>Редактировать</h4>

        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header">Детали</h5>

                    <hr class="my-0">
                    <div class="card-body">

                        <form id="formAccountSettings" method="POST"
                            action="{{ route('video.update', $video->slug) }}" enctype="multipart/form-data">
                            @csrf
                            @method('patch')
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="firstName" class="form-label">Название*</label>
                                    <input class="form-control" type="text" id="firstName" name="name"
                                        placeholder="Введите название категории" value="{{ $video->name }}" required>
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="language" class="form-label">Родительская категория</label>
                                    <select id="language" class="select2 form-select" name="parent_id">
                                        <option value="" @if ($video->parent_id == '') {{ 'selected' }} @endif>
                                            Без родительской категории</option>
                                        @foreach ($videos as $video)
                                            <option value="{{ $video->id }}"
                                                {{ $video->id == $video->parent_id ? 'selected' : '' }}>
                                                {{ $video->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('parent_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="sort" class="form-label">Сортировка*</label>
                                    <input class="form-control" type="text" id="sort" name="sort"
                                        placeholder="Введите число" value="{{ $video->sort }}" required>
                                    @error('sort')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="sort" class="form-label">Изображение*</label>
                                    @if (!empty($video->image))
                                        <div class="input-group">
                                            <img src="{{ Storage::url($video->image) }}" class="w-px-100">
                                        </div>
                                    @else
                                    @endif
                                    <div class="input-group">
                                        <input type="file" class="form-control" id="inputGroupFile02" name="image">
                                    </div>
                                    @error('image')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>
                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary">Сохранить</button>
                                <a href="{{ route('videos.index') }}" class="btn btn-secondary">Отмена</a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
