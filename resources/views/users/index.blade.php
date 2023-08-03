@extends('template.main')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Администраторы /</h4>
        <div class="card">
            <h5 class="card-header">Список</h5>
            <div class="card-body">
                <a type="button" class="btn btn-outline-secondary fw-semibold" href="{{ route('user.create') }}">Добавить</a>

                <div class="demo-inline-spacing">
                    @if (session('status') === 'account-updated')
                        <div class="alert alert-primary" role="alert">{{ __('Обновлено успешно.') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if (session('status') === 'account-password-updated')
                        <div class="alert alert-primary" role="alert">{{ __('Пароль обновлен успешно.') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if (session('status') === 'account-created')
                        <div class="alert alert-success alert-dismissible" role="alert">
                            {{ __('Создано успешно.') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if (session('status') === 'account-deleted')
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            {{ __('Удалено успешно.') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                </div>
            </div>

            <hr class="m-0">
            <div class="card-body">
                <form class="d-flex" action="{{ route('users.search') }}" method="get">
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
                                <th>Id</th>
                                <th>Имя</th>
                                <th>Email</th>
                                <th>Роль</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @forelse ($users as $user)
                                <tr>
                                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                        <strong>{{ $user->id }}</strong>
                                    </td>
                                    <td>{{ $user->name }}</td>
                                    <td>
                                        {{ $user->email }}
                                    </td>
                                    <td><span class="badge bg-label-primary me-1">{{ $user->role }}</span></td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{ route('user.show', $user->id) }}">
                                                    <i class="menu-icon tf-icons bx bx-detail"></i> Показать</a>
                                                <a class="dropdown-item" href="{{ route('user.edit', $user->id) }}">
                                                    <i class="bx bx-edit-alt me-1"></i> Редактировать</a>
                                                <button type="submit" class="dropdown-item"
                                                    data-bs-toggle="modal" data-bs-target="#modalScrollablePassword{{$user->id}}">
                                                    <i class='bx bxs-key'></i> Изменить пароль</button>
                                                <button type="submit" class="dropdown-item text-danger"
                                                    data-bs-toggle="modal" data-bs-target="#modalScrollableDelete{{$user->id}}">
                                                    <i class="bx bx-trash me-1 text-danger" role="button"></i>
                                                    Удалить</button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                    <div class="modal fade" id="modalScrollableDelete{{$user->id}}" tabindex="-1" style="display: none;" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalScrollableTitle">Вы уверены, что хотите удалить?</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400  alert alert-warning text-wrap">
                                                        {{ __('После удаления записи все ее ресурсы и данные будут безвозвратно удалены.') }}
                                                    </p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                                        Закрыть
                                                    </button>
                                                    <form action="{{ route('user.destroy', $user->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger" data-bs-toggle="modal"
                                                            data-bs-target="#modalScrollableConfirm">Подтвердить</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                
                                    <div class="modal fade" id="modalScrollablePassword{{$user->id}}" tabindex="-1" style="display: none;" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalScrollableTitle">Редактирование пароля</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('user.update_password', $user->id) }}" method="POST">
                                                    @csrf
                                                    @method('patch')
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col mb-3">
                                                                <label for="nameWithTitle" class="form-label">Пароль</label>
                                                                <input type="text" class="form-control" id="nameWithTitle"
                                                                    placeholder="Введите пароль" name="password" required>
                                                                @error('password')
                                                                    <div class="text-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                                            Закрыть
                                                        </button>
                                                        <button type="submit" class="btn btn-primary">Сохранить</button>
                                                    </div>
                                                </form>
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
                    @if ($users->links()->paginator->hasPages())
                        <div class="demo-inline-spacing">
                            {{ $users->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>


@endsection
