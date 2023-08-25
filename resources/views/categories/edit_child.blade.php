@extends('template.main')
@section('content')
    <div class="container-xxl flegrow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"><a href="{{ route('categories.index') }}">
                    Категории</a> / {{$category_parent->name}} / </span>Редактировать подкатегорию: {{ $category->name }}</h4>

        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header">Детали</h5>

                    <hr class="my-0">
                    <div class="card-body">

                        <form id="formAccountSettings" method="POST"
                            action="{{ route('category.update', $category->slug) }}" enctype="multipart/form-data">
                            @csrf
                            @method('patch')
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="firstName" class="form-label">Название*</label>
                                    <input class="form-control" type="text" id="firstName" name="name"
                                        placeholder="Введите название категории" value="{{ $category->name }}" required>
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <input type="hidden" name="category_id" value="{{$category->id}}">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="firstName" class="form-label">Слаг*</label>
                                    <input class="form-control" type="text" id="firstName" name="slug"
                                         value="{{ $category->slug }}" required>
                                    @error('slug')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="sort" class="form-label">Сортировка*</label>
                                    <input class="form-control" type="text" id="sort" name="sort"
                                        placeholder="Введите число" value="{{ $category->sort }}" required>
                                    @error('sort')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="sort" class="form-label">Изображение</label>
                                    @if (!empty($category->image))
                                        <div class="input-group">
                                            <img src="{{ Storage::url($category->image) }}" class="w-px-100">
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
                                @if (!$category->parent_id == 0)
                                <a href="{{ route('category.show',$category->parent_id) }}" class="btn btn-secondary">Отмена</a>
                                @else
                                <a href="{{ route('categories.index') }}" class="btn btn-secondary">Отмена</a>
                                @endif
                                
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
