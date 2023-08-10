@extends('template.main')
@section('content')
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" />
    <script src="https://raw.githack.com/SortableJS/Sortable/master/Sortable.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Категории /</span></h4>
        <div class="card">
            <h5 class="card-header">Список</h5>
            <div class="card-body">
                <a type="button" class="btn btn-outline-secondary fw-semibold"
                    href="{{ route('category.create') }}">Добавить</a>

                <div class="demo-inline-spacing">
                    @if (session('status') === 'category-updated')
                        <div class="alert alert-primary" role="alert">{{ __('Обновлено успешно.') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if (session('status') === 'category-created')
                        <div class="alert alert-success alert-dismissible" role="alert">
                            {{ __('Создано успешно.') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if (session('status') === 'category-deleted')
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            {{ __('Удалено успешно.') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                </div>
            </div>

            <hr class="m-0">
            <div class="card-body">
                <form class="d-flex" action="{{ route('categories.search') }}" method="get">
                    <input class="form-control me-2" type="search" name="search" placeholder="Поиск" aria-label="Search">
                    <button class="btn btn-outline-primary" type="submit">Поиск</button>
                </form>
            </div>

            <hr class="m-0">
            <div class="card-body">
                <div class="text-nowrap">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Название</th>
                                <th>Родительская категория</th>
                                <th>Сортировка</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="list" class="table-border-bottom-0">
                            @forelse ($categories as $category)
                                <tr data-sort-id="{{ $category->sort }}">

                                    <td>{{ $category->name }}</td>
                                    <td>
                                        @if (!empty($category->parent->name))
                                            {{ $category->parent->name }}
                                        @else
                                            Без родительской категории
                                        @endif
                                    </td>
                                    <td>{{ $category->sort }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">

                                                <a class="dropdown-item"
                                                    href="{{ route('category.show', $category->slug) }}"><i
                                                        class="menu-icon tf-icons bx bx-detail"></i> Показать</a>
                                                <a class="dropdown-item"
                                                    href="{{ route('category.edit', $category->slug) }}"><i
                                                        class="bx bx-edit-alt me-1"></i> Редактировать</a>

                                                <button type="submit" class="dropdown-item text-danger"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modalScrollable{{ $category->slug }}"><i
                                                        class="bx bx-trash me-1 text-danger" role="button"></i>
                                                    Удалить</button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <div class="modal fade" id="modalScrollable{{ $category->slug }}" tabindex="-1"
                                    style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalScrollableTitle">Вы уверены, что хотите
                                                    удалить?</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p
                                                    class="mt-1 text-sm text-gray-600 dark:text-gray-400  alert alert-warning text-wrap">
                                                    {{ __('После удаления записи все ее ресурсы и данные будут безвозвратно удалены.') }}
                                                </p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-secondary"
                                                    data-bs-dismiss="modal">
                                                    Закрыть
                                                </button>
                                                <form action="{{ route('category.destroy', $category->slug) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger" data-bs-toggle="modal"
                                                        data-bs-target="#modalScrollableConfirm">Подтвердить</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <tr>
                                    <td class="text-danger">По вашему запросу ничего не найдено.</td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                    @if ($categories->links()->paginator->hasPages())
                        <div class="demo-inline-spacing">
                            {{ $categories->links() }}
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>

    <script>
        let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        Sortable.create(list, {
            swap: false,
            swapClass: "highlight",
            animation: 150,
            onEnd: function(e) {
                let oldId = e.oldIndex;
                let newId = e.newIndex;
                updateOrder(oldId, newId);
            }
        });
        const updateOrder = (oldId, newId) => {
            fetch("{{ route('category.sort',[2]) }}", {
                    headers: {
                        "X-CSRF-TOKEN": token
                    },
                    method: 'post',
                    body: {
                        oldId,
                        newId
                    }
                })
                .then((data) => {
                  console.log(data);
                })
                .catch(function(error) {
                    console.log(error);
                });
        }

    </script>
@endsection