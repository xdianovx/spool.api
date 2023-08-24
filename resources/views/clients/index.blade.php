@extends('template.main')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Клиенты /</h4>
        <div class="card">

            <h5 class="card-header">Список</h5>
            <div class="card-body">


                <div class="demo-inline-spacing">
                    @if (session('status') === 'account-banned')
                        <div class="alert alert-primary" role="alert">
                            {{ __('Клиент заблокирован успешно.') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if (session('status') === 'account-unbanned')
                        <div class="alert alert-primary" role="alert">
                            {{ __('Клиент разблокирован успешно.') }}
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
                <form class="d-flex" action="{{ route('clients.search') }}" method="get">
                    @csrf
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
                                <th>Почта</th>
                                <th>Дата последнего входа</th>
                                <th>Статус</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @forelse ($clients as $client)
                                <tr>
            
                                    <td>
                                        <strong>{{ $client->id }}</strong>
                                    </td>
                                    <td>{{ $client->name }}</td>
                                    <td>
                                        {{ $client->email }}
                                    </td>
                                    <td>{{ $client->last_login_date }}</td>
                                    <td>
                                        @if (empty($client->blocked_at))
                                            <span class="badge bg-label-primary me-1">Активный</span>
                                        @else
                                            <span class="badge bg-label-warning me-1">Заблокирован:
                                                {{ $client->blocked_at }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{ route('client.show', $client->id) }}"><i
                                                        class="menu-icon tf-icons bx bx-detail"></i> Показать</a>

                                                <button type="submit" class="dropdown-item text-danger"
                                                    data-bs-toggle="modal" data-bs-target="#modalScrollable{{$client->id}}"><i
                                                        class="bx bx-trash me-1 text-danger" role="button"></i>
                                                    Удалить</button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <div class="modal fade" id="modalScrollable{{$client->id}}" tabindex="-1" style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable" role="document">
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
                                                <form action="{{ route('client.destroy', $client->id) }}" method="POST">
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
                    @if ($clients->links()->paginator->hasPages())
                        <div class="demo-inline-spacing">
                            {{ $clients->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection
