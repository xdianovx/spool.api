@extends('template.main')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">
                <a href="{{ route('clients.index') }}"> Клиенты</a> / {{ $client->name }} </h4>
        <div class="row">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="user-avatar-section">
                        <div class=" d-flex align-items-center flex-column">
                            @if (!empty($client->avatar_image))
                                <img class="img-fluid rounded my-4" src="{{ Storage::url($client->avatar_image) }}"
                                    height="240" width="240" alt="User avatar">
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" height="240" width="240" viewBox="0 0 24 24"
                                    style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
                                    <circle cx="7.499" cy="9.5" r="1.5"></circle>
                                    <path d="m10.499 14-1.5-2-3 4h12l-4.5-6z"></path>
                                    <path
                                        d="M19.999 4h-16c-1.103 0-2 .897-2 2v12c0 1.103.897 2 2 2h16c1.103 0 2-.897 2-2V6c0-1.103-.897-2-2-2zm-16 14V6h16l.002 12H3.999z">
                                    </path>
                                </svg>
                            @endif
                            <div class="user-info text-center">
                                <h4 class="mb-2">{{ $client->name }}</h4>
                                <span class="badge bg-label-secondary">{{ $client->gender }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-around flex-wrap my-4 py-3">
                        <div class="d-flex align-items-start me-4 mt-3 gap-3">
                            <span class="badge bg-label-primary p-2 rounded"><i class="bx bx-check bx-sm"></i></span>
                            <div>
                                <h5 class="mb-0">1.23k</h5>
                                <span>Билетов куплено</span>
                            </div>
                        </div>
                        <div class="d-flex align-items-start mt-3 gap-3">
                            <span class="badge bg-label-primary p-2 rounded"><i class="bx bx-customize bx-sm"></i></span>
                            <div>
                                <h5 class="mb-0">{{ $client->last_login_date }}</h5>
                                <span>Дата последнего входа</span>
                            </div>
                        </div>
                    </div>
                    <h5 class="pb-2 border-bottom mb-4">Информация</h5>
                    <div class="info-container">
                        <ul class="list-unstyled">
                            <li class="mb-3">
                                <span class="fw-medium me-2">Id профиля:</span>
                                <span>{{ $client->id }}</span>
                            </li>
                            <li class="mb-3">
                                <span class="fw-medium me-2">Имя:</span>
                                <span>{{ $client->name }}</span>
                            </li>
                            <li class="mb-3">
                                <span class="fw-medium me-2">Статус:</span>
                                @if (empty($client->blocked_at))
                                    <span class="badge bg-label-primary me-1">Активный</span>
                                @else
                                    <span class="badge bg-label-danger me-1">Заблокирован {{ $client->blocked_at }}</span>
                                @endif
                            </li>
                            <li class="mb-3">
                                <span class="fw-medium me-2">Возраст:</span>
                                <span>{{ $client->age }}</span>
                            </li>
                            <li class="mb-3">
                                <span class="fw-medium me-2">Email:</span>
                                <span>{{ $client->email }}</span>
                            </li>
                            <li class="mb-3">
                                <span class="fw-medium me-2">Номер телефона:</span>
                                <span>{{ $client->phone_number }}</span>
                            </li>
                            <li class="mb-3">
                                <span class="fw-medium me-2">Пол:</span>
                                <span>{{ $client->gender }}</span>
                            </li>
                            <li class="mb-3">
                                <span class="fw-medium me-2">Внешний платежный идентификатор
                                    (токен):</span>
                                <span>{{ $client->external_payment_token }}</span>
                            </li>
                            <li class="mb-3">
                                <span class="fw-medium me-2">Дата регистрации:</span>
                                <span>{{ $client->created_at }}</span>
                            </li>
                            <li class="mb-3">
                                <span class="fw-medium me-2">Страна:</span>
                                <span>{{ $client->country->name ?? 'Страна не указана' }}</span>
                            </li>
                        </ul>
                        <div class="d-flex justify-content-center pt-3">
                            <a class="btn btn-primary text-nowrap me-3" href="{{ route('clients.index') }}">Назад</a>
                            @if (empty($client->blocked_at))
                                <button type="submit" class="btn btn-danger me-3" data-bs-toggle="modal"
                                    data-bs-target="#modalScrollable">Заблокировать</button>
                            @else
                                <form action="{{ route('client.send_ban', $client->id) }}" method="POST">
                                    @csrf
                                    @method('patch')
                                    <button type="submit" class="btn btn-success me-3">Разблокировать</button>
                                </form>
                            @endif
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
