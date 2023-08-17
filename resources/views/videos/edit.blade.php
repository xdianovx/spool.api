@extends('template.main')
@section('content')
    <div class="container-xxl flegrow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"><a href="{{ route('videos.index') }}">
                    Видеоролики</a> / {{ $video->name }} / </span>Редактировать</h4>

        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header">Детали</h5>

                    <hr class="my-0">
                    <div class="card-body">

                        @if (session('status') === 'video-created')
                            <div class="alert alert-success alert-dismissible" role="alert">
                                {{ __('Создано успешно.') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        <form id="formAccountSettings" method="POST" action="{{ route('video.update', $video->id) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('patch')
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="name" class="form-label">Название*</label>
                                    <input class="form-control" type="text" id="name" name="name"
                                        placeholder="Введите название" value="{{ $video->name }}" required>
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="category" class="form-label">Категория*</label>
                                    @if (!count($categories) == 0)
                                        <select id="category" class="select2 form-select" name="category_id">
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ $category->id == $video->category_id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    @else
                                        <div class="text-danger">Записей не существует, создайте запись в таблице(Категории)
                                        </div>
                                    @endif
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="partner_company" class="form-label">Партнерская компания*</label>
                                    @if (!count($partner_companies) == 0)
                                        <select id="partner_company" class="select2 form-select" name="partners_company_id">
                                            @foreach ($partner_companies as $partner_company)
                                                <option value="{{ $partner_company->id }}"
                                                    {{ $partner_company->id == $partner_company->partners_company_id ? 'selected' : '' }}>
                                                    {{ $partner_company->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('partners_company_id')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    @else
                                        <div class="text-danger">Записей не существует, создайте запись в
                                            таблице(Партнерские компани)</div>
                                    @endif
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="image" class="form-label">Изображение*</label>
                                    @if (!empty($video->image))
                                        <div class="input-group">
                                            <img src="{{ Storage::url($video->image) }}" class="w-px-100">
                                        </div>
                                    @else
                                    @endif
                                    <div class="input-group">
                                        <input type="file" class="form-control" id="image" name="image"
                                            value="{{ $video->image }}">
                                    </div>
                                    @error('image')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="image_banner" class="form-label">Изображение (баннер)</label>
                                    @if (!empty($video->image_banner))
                                        <div class="input-group">
                                            <img src="{{ Storage::url($video->image_banner) }}" class="w-px-100">
                                        </div>
                                    @else
                                    @endif
                                    <div class="input-group">
                                        <input type="file" class="form-control" id="image_banner" name="image_banner"
                                            value="{{ $video->image_banner }}">
                                    </div>
                                    @error('image_banner')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="video" class="form-label">Видео</label>
                                    <input class="form-control" type="text" id="video" name="video"
                                        placeholder="Введите ссылку на видео" value="{{ $video->video }}" required>
                                    @error('video')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-message">Описание*</label>
                                    <textarea id="basic-default-message" class="form-control" name="description" placeholder="Текст" style="height: 234px;"
                                        required>{{ $video->description }}</textarea>
                                    @error('description')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="duration" class="form-label">Длительность*</label>
                                    <input class="form-control" type="text" id="duration" name="duration"
                                        placeholder="Ввидите длительность видео" value="{{ $video->duration }}" required>
                                    </input>
                                    @error('duration')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="event_date" class="form-label">Дата события*</label>
                                    <input class="form-control" type="data" id="event_date" name="event_date"
                                        placeholder="Введите дату события" value="{{ $video->event_date }}" required>
                                    </input>
                                    @error('event_date')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="minimum_age" class="form-label">Допустимый минимальный возраст*</label>
                                    <input class="form-control" type="text" id="minimum_age" name="minimum_age"
                                        placeholder="Введите минимальный возраст" value="{{ $video->minimum_age }}"
                                        required>
                                    </input>
                                    @error('minimum_age')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="firstName" class="form-label">Отображение в слайдере</label>

                                    <div class="form-check mt-3">
                                        <input name="display_slider" class="form-check-input" type="radio"
                                            value="false" id="defaultRadio1"
                                            @if ($video->display_slider == 'false') checked="checked" @else @endif>
                                        <label class="form-check-label" for="defaultRadio1"> Нет </label>
                                    </div>
                                    <div class="form-check">
                                        <input name="display_slider" class="form-check-input" type="radio"
                                            value="true" id="defaultRadio2"
                                            @if ($video->display_slider == 'true') checked="checked" @else @endif>
                                        <label class="form-check-label" for="defaultRadio2"> Да </label>
                                    </div>
                                    @error('display_slider')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary">Сохранить</button>
                                <a href="{{ route('videos.index') }}" class="btn btn-secondary">Отмена</a>
                            </div>
                        </form>
                        <div class="divider">
                            <div class="divider-text">Теги</div>
                        </div>
                        <div class="card-body">

                            @if (session('status') === 'tag-updated')
                                <div class="alert alert-primary" role="alert">{{ __('Обновлено успешно.') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            @if (session('status') === 'tag-created')
                                <div class="alert alert-success alert-dismissible" role="alert">
                                    {{ __('Создано успешно.') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            @if (session('status') === 'tag-deleted')
                                <div class="alert alert-danger alert-dismissible" role="alert">
                                    {{ __('Удалено успешно.') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

                            <form id="formAccountSettings" method="POST" action="{{ route('tag.store', $video->id) }}">
                                @csrf
                                <div class="row">
                                    <label for="firstName" class="form-label">Название*</label>
                                    <div class="mb-3 col-md-6 d-flex gap-2">

                                        <input class="form-control" type="text" id="firstName" name="name"
                                            placeholder="Введите название" value="{{ old('name') }}" required>
                                        @error('name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                        <button type="submit" class="btn btn-primary">Создать</button>
                                    </div>
                                </div>

                            </form>
                            @if ($user_tags->count() > 0)
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Название</th>
                                            <th>Показать?</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0 tag__wrap position-relative block" data-video-id="{{$video->id}}">

                                    </tbody>
                                </table>
                                @if ($user_tags->links()->paginator->hasPages())
                                    <div class="demo-inline-spacing">
                                        {{ $user_tags->links() }}
                                    </div>
                                @endif
                            @else
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        let data
        let tagWrap

        const listUpdate = async () => {
            await fetch('/tags')
                .then(res => res.json())
                .then(body => data = body)
                .then(() => {
                    tagWrap = document.querySelector('.tag__wrap')
                    tagWrap.innerHTML = " "
                    console.log(data);

                })
                .then(() => {

                    data.forEach(item => {


                        //этот ДАТА выше я добавил
                        const videoId = tagWrap.getAttribute('data-video-id');




                        isChecked = item.display
                        const htmlEl = `
                        <tr class="tag_row" data-tag-id="${item.id}">
                            <td>${item.name}</td>
                            <td>
                                <div class="form-check form-switch">
                                    <input name="display" class="form-check-input tag_display" type="checkbox" ${item.display == 1 ? 'checked' : ""} />
                                </div>
                            </td>

                            <td>
                                <button class="btn btn-xs tag_delete">
                                    <i class="bx bx-trash me-1 text-danger" role="button"></i>
                                </button>
                            </td>
                        </tr>
                        `
                        tagWrap.insertAdjacentHTML("beforeend", htmlEl)
                    })
                })
                .then(() => {
                    const tags = document.querySelectorAll('.tag_row')


                    tags.forEach(item => {

                        const checkButton = item.querySelector('.tag_display');
                        const tagId = item.getAttribute('data-tag-id');
                        const deleteButton = item.querySelector('.tag_delete');
                        
                        checkButton.addEventListener('change', () => {
                            const isCheck = checkButton.checked;

                            fetch("{{ route('tag.display') }}", {
                                    headers: {
                                        "X-CSRF-TOKEN": token
                                    },
                                    method: 'post',
                                    credentials: "same-origin",
                                    body: JSON.stringify({
                                        id: tagId,
                                        isCheck,
                                        videoId
                                    })
                                })
                                .then(response => response.json())

                                .catch(function(error) {
                                    console.log(error);
                                });
                        })


                        deleteButton.addEventListener('click', () => {
                            deleteFunct(tagId)
                        })
                    });

                })


        }



        const deleteFunct = async (tagId) => {
            const url = "/tags/destroy/" + tagId;
            await fetch(url, {
                    headers: {
                        "X-CSRF-TOKEN": token
                    },
                    method: 'delete',
                    body: JSON.stringify({
                        id: tagId
                    })
                })
                .then(() => listUpdate())

                .catch(function(e) {
                    console.log(e);
                });
        }

        listUpdate()
    </script>
@endsection
