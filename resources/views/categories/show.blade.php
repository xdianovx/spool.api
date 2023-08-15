@extends('template.main')
@section('content')

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">
                <a href="{{ route('categories.index') }}"> Категории</a> / {{ $category->name }} </h4>
        <div class="row">
            <!-- Inline text elements -->
            <div class="col">
                <div class="card mb-4">
                    <h5 class="card-header">Информация</h5>
                    <div class="card-body">
                        <hr class="m-0">
                        <div class="user-avatar-section">
                            <div class=" d-flex align-items-center flex-column">
                                @if (!empty($category->image))
                                    <img class="img-fluid rounded my-4" src="{{ Storage::url($category->image) }}"
                                        height="240" width="240" alt="User avatar">
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" height="240" width="240"
                                        viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
                                        <circle cx="7.499" cy="9.5" r="1.5"></circle>
                                        <path d="m10.499 14-1.5-2-3 4h12l-4.5-6z"></path>
                                        <path
                                            d="M19.999 4h-16c-1.103 0-2 .897-2 2v12c0 1.103.897 2 2 2h16c1.103 0 2-.897 2-2V6c0-1.103-.897-2-2-2zm-16 14V6h16l.002 12H3.999z">
                                        </path>
                                    </svg>
                                @endif
                            </div>
                        </div>
                        <hr class="m-0">
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <td class="align-middle"><small class="text-light fw-semibold">Id:</small></td>
                                    <td class="py-3">
                                        <p class="mb-0">{{ $category->id }}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="align-middle"><small class="text-light fw-semibold">Название:</small></td>
                                    <td class="py-3">
                                        <p class="mb-0">{{ $category->name }}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="align-middle"><small class="text-light fw-semibold">Слаг:</small></td>
                                    <td class="py-3">
                                        <p class="mb-0">{{ $category->slug }}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="align-middle"><small class="text-light fw-semibold">Родительская
                                            категория:</small></td>
                                    <td class="py-3">
                                        <p class="mb-0">
                                            @if (!empty($category->parent->name))
                                                {{ $category->parent->name }}
                                            @else
                                                Без родительской категории
                                            @endif
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="align-middle"><small class="text-light fw-semibold">Дата создания:</small>
                                    </td>
                                    <td class="py-3">
                                        <p class="mb-0">{{ $category->created_at }}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="align-middle"><small class="text-light fw-semibold">Сортировка:</small></td>
                                    <td class="py-3">
                                        <p class="mb-0">{{ $category->sort }}</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <hr class="m-0">
                        <div class="row demo-vertical-spacing">

                            <div class="col">
                                @if (!$category->parent_id == 0)
                                <a href="{{ route('category.show',$category->parent_id) }}" class="btn btn-primary text-nowrap">Назад</a>
                                @else
                                <a href="{{ route('categories.index') }}" class="btn btn-primary text-nowrap">Назад</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        @if ($child_categories->count() > 0)


        <div class="card">
            <h5 class="card-header">Список дочерних категорий</h5>
            <div class="card-body">
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
                <div class="text-nowrap">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Название</th>
                                <th>Слаг</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="list" class="table-border-bottom-0">
                            @forelse ($child_categories as $child_category)
                                <tr class="list-item cursor-move" data-sort-id="{{ $child_category->id }}">

                                    <td>{{ $child_category->name }}</td>
                                    <td>{{ $category->slug }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">

                                                <a class="dropdown-item"
                                                    href="{{ route('category.show', $child_category->slug) }}"><i
                                                        class="menu-icon tf-icons bx bx-detail"></i> Показать</a>
                                                <a class="dropdown-item"
                                                    href="{{ route('category.edit', $child_category->slug) }}"><i
                                                        class="bx bx-edit-alt me-1"></i> Редактировать</a>

                                                <button type="submit" class="dropdown-item text-danger"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modalScrollable{{ $child_category->slug }}"><i
                                                        class="bx bx-trash me-1 text-danger" role="button"></i>
                                                    Удалить</button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <div class="modal fade" id="modalScrollable{{ $child_category->slug }}" tabindex="-1"
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
                                                <form action="{{ route('category.destroy', $child_category->slug) }}"
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
                                    <td class="text-danger">Записи отсутстувют.</td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                    @if ($child_categories->links()->paginator->hasPages())
                        <div class="demo-inline-spacing">
                            {{ $child_categories->links() }}
                        </div>
                    @endif

                </div>
            </div>
        </div>
        @endif
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
              let id = e.item.attributes[0].value;

              updateOrder(oldId, newId, id);

          }
      });
      const updateOrder = (oldId, newId, id) => {
          const listItem = document.querySelectorAll('.list-item');
          const order = [];
          listItem.forEach((item, idx) => {
              const id = item.getAttribute('data-sort-id');
              order.push({
                  id: id,
                  order: idx
              })
          });
          fetch("{{ route('category.sort') }}", {
                  headers: {
                      "X-CSRF-TOKEN": token
                  },
                  method: 'post',
                  credentials: "same-origin",
                  body: JSON.stringify(order)
              })
              .then(response => response.json())
              .catch(function(error) {
                  console.log(error);
              });
      }
  </script>
@endsection
