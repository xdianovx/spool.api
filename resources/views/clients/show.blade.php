@extends('template.main')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">
                <a href="{{ route('clients.index') }}"> Клиенты</a> / {{ $client->name }} /</span> Информация</h4>
        <div class="row">
            <!-- Inline text elements -->
            <div class="col">
                <div class="card mb-4">
                    <h5 class="card-header">Информация</h5>
                    <div class="card-body">
                        <hr class="m-0">
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <td class="align-middle"><small class="text-light fw-semibold">Id профиля:</small></td>
                                    <td class="py-3">
                                        <p class="mb-0">{{ $client->id }}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="align-middle"><small class="text-light fw-semibold">Имя:</small></td>
                                    <td class="py-3">
                                        <p class="mb-0">{{ $client->name }}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td><small class="text-light fw-semibold">Возраст:</small></td>
                                    <td class="py-3">
                                        <p class="mb-0">{{ $client->age }}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td><small class="text-light fw-semibold">Email:</small></td>
                                    <td class="py-3">
                                        <p class="mb-0">{{ $client->email }}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td><small class="text-light fw-semibold">Номер телефона:</small></td>
                                    <td class="py-3">
                                        <p class="mb-0">{{ $client->phone_number }}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td><small class="text-light fw-semibold">Пол:</small></td>
                                    <td class="py-3">
                                        <p class="mb-0">{{ $client->gender }}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td><small class="text-light fw-semibold">Внешний платежный идентификатор
                                            (токен):</small></td>
                                    <td class="py-3">
                                        <p class="mb-0">{{ $client->external_payment_token }}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td><small class="text-light fw-semibold">Дата последнего входа:</small></td>
                                    <td class="py-3">
                                        <p class="mb-0">{{ $client->last_login_date }}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td><small class="text-light fw-semibold">Дата регистрации:</small></td>
                                    <td class="py-3">
                                        <p class="mb-0">{{ $client->created_at }}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td><small class="text-light fw-semibold">Страна:</small></td>
                                    <td>
                                        <p class="mb-0">
                                            {{ $client->country->name ?? 'Страна не указана' }}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td><small class="text-light fw-semibold">Статус:</small></td>
                                    <td class="py-3">
                                        @if (empty($client->blocked_at))
                                        <p class="mb-0 alert alert-success alert-dismissible">Активен</p>
                                        @else
                                        <p class="mb-0 alert alert-danger">Заблокирован {{ $client->blocked_at }}</p>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <hr class="m-0">
                        <div class="demo-vertical-spacing">
                            <div class="col">
                                <a class="btn btn-primary text-nowrap" href="{{ route('clients.index') }}">Назад</a>
                            </div>
                            <div class="col">
                                @if (empty($client->blocked_at))
                                    <button type="submit" class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#modalScrollable">Заблокировать</button>
                                @else
                                    <form action="{{ route('client.send_ban', $client->id) }}" method="POST">
                                        @csrf
                                        @method('patch')
                                        <button type="submit" class="btn btn-success">Разблокировать</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if ($client ?? null)
        <div class="modal fade" id="modalScrollable" tabindex="-1" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalScrollableTitle">Вы уверены, что хотите заблокировать?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400  alert alert-warning">
                            {{ __('После блокировки пользователь потеряет доступ к учетной записи.') }}
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            Закрыть
                        </button>
                        <form action="{{ route('client.send_ban', $client->id) }}" method="POST">
                            @csrf
                            @method('patch')
                            <button type="submit" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#modalScrollableConfirm">Заблокировать аккаунт</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
