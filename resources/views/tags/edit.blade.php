@extends('template.main')
@section('content')
    <div class="container-xxl flegrow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"><a href="{{ route('tags.index') }}">
                    Теги</a> / </span>Редактировать</h4>

        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header">Детали</h5>

                    <hr class="my-0">
                    <div class="card-body">

                        <form id="formAccountSettings" method="POST" action="{{ route('tag.update', $tag->id) }}">
                            @csrf
                            @method('patch')
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="firstName" class="form-label">Название*</label>
                                    <input class="form-control" type="text" id="firstName" name="name"
                                        value="{{ $tag->name }}" autofocus autocomplete="name" required>
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="firstName" class="form-label">Отображение</label>
                              
                                    <div class="form-check mt-3">
                                        <input name="display" class="form-check-input" type="radio" value="false"
                                            id="defaultRadio1" @if ($tag->display == "false") checked="checked" @else @endif>
                                        <label class="form-check-label" for="defaultRadio1"> Нет </label>
                                    </div>
                                    <div class="form-check">
                                        <input name="display" class="form-check-input" type="radio" value="true"
                                            id="defaultRadio2" @if ($tag->display == "true") checked="checked" @else @endif>
                                        <label class="form-check-label" for="defaultRadio2"> Да </label>
                                    </div>
                                    @error('display')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary">Сохранить</button>
                                <a href="{{ route('tags.index') }}" class="btn btn-secondary">Отмена</a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
