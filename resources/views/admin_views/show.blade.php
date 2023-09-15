@extends('template.main')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">
                <a href="{{ route('admin_views.index') }}"> Видео</a> / {{ $video->name }} </h4>
        <div class="row">
            <!-- Inline text elements -->
            <div class="col">
                <div class="card mb-4">
                    <h5 class="card-header">Информация</h5>
                    <div class="card-body">
                        <hr class="m-0">
                        <div class="user-avatar-section">
                            <div class=" d-flex align-items-center flex-column">
                                @if (!empty($video->image))
                                    <img class="img-fluid rounded my-4" src="{{ Storage::url($video->image) }}"
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
                                    <td class="align-middle"><small class="text-light fw-semibold">Баннер:</small></td>
                                    <td class="py-3">
                                        @if (!empty($video->image_banner))
                                            <img class="img-fluid rounded my-4"
                                                src="{{ Storage::url($video->image_banner) }}" height="240" width="240"
                                                alt="User avatar">
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
                                    </td>
                                </tr>

                                <tr>
                                    <td class="align-middle"><small class="text-light fw-semibold">Название:</small></td>
                                    <td class="py-3">
                                        <p class="mb-0">{{ $video->name }}</p>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="align-middle"><small class="text-light fw-semibold">Kатегория:</small></td>
                                    <td class="py-3">
                                        <p class="mb-0">
                                            {{ $video->category->name ?? 'Без категории' }}
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="align-middle"><small class="text-light fw-semibold">Дата создания:</small>
                                    </td>
                                    <td class="py-3">
                                        <p class="mb-0">{{ $video->created_at }}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="align-middle"><small class="text-light fw-semibold">Допустимый минимальный
                                            возраст:</small></td>
                                    <td class="py-3">
                                        <p class="mb-0">{{ $video->minimum_age }}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="align-middle"><small class="text-light fw-semibold">Партнерская
                                            компания:</small></td>
                                    <td class="py-3">
                                        <p class="mb-0">{{ $video->partner_company->name ?? 'Без партнерской компании' }}
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="align-middle"><small class="text-light fw-semibold">Дата события:</small>
                                    </td>
                                    <td class="py-3">
                                        <p class="mb-0">{{ $video->event_date }}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="align-middle"><small class="text-light fw-semibold">Ссылка на видео:</small>
                                    </td>
                                    <td class="py-3">
                                        <p class="mb-0">{{ $video->video }}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="align-middle"><small
                                            class="text-light fw-semibold">Длительность(секунды):</small></td>
                                    <td class="py-3">
                                        <p class="mb-0">{{ $video->duration }}</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <hr class="m-0">
                        <h5 class="card-header">Заработок</h5>
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <td class="align-middle"><small class="text-light fw-semibold">Сумма проданных
                                            билетов без учета комиссии:</small></td>
                                    <td class="py-3">
                                        <p class="mb-0">{{ $sum_tickets }}р.</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="align-middle"><small class="text-light fw-semibold">Сумма проданных
                                            билетов:</small></td>
                                    <td class="py-3">
                                        <p class="mb-0">{{ $ticket_without_comission }}р.</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>



                        <hr class="m-0">
                        <h5 class="card-header">График</h5>
                        <div class="card-body">
                            <div id="chart">
                            </div>
                        </div>



                        <hr class="m-0">
                        <h5 class="card-header">Список просмотров</h5>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Секунд просмотрено</th>
                                    <th>Клиент(Имя)</th>
                                    <th>Клиент(Почта)</th>
                                    <th>Страна</th>
                                    <th>Дата</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @forelse ($views as $view)
                                    <tr>
                                        <td>{{ $view->seconds_viewed }}</td>
                                        <td>{{ $view->client->name ?? 'Данные отсутствуют' }}</td>
                                        <td>{{ $view->client->email ?? 'Данные отсутствуют' }}</td>
                                        <td>{{ $view->country->name ?? 'Данные отсутствуют' }}</td>
                                        <td>{{ $view->created_at }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-danger">По вашему запросу ничего не найдено.</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                        @if ($views->links()->paginator->hasPages())
                            <div class="demo-inline-spacing">
                                {{ $views->links() }}
                            </div>
                        @endif



                        <hr class="m-0">
                        <div class="row demo-vertical-spacing">
                            <div class="col">
                                <a class="btn btn-primary text-nowrap" href="{{ route('admin_views.index') }}">Назад</a>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>

        <script>
            let test = []
            const getStat = async () => {
                const id = "{{ $video->id }}"
                const data = await fetch(`/admin_views/${id}/showviews`)
                const ch = await data.json()


                console.log(ch)


                const options = {
                    chart: {
                        type: 'line',
                        height: 350,
                        locales: [{
                            "name": "en",
                            "options": {
                                "months": ["Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль",
                                    "Август",
                                    "Сентябрь", "Октябрь", "Ноябрь", "Декабрь"
                                ],
                                "shortMonths": ["Янв", "Фев", "Мар", "Апр", "Май", "Июнь", "Июль", "Авг",
                                    "Сен", "Окт",
                                    "Ноя", "Дек"
                                ],
                                "days": ["Воскресение", "Понедельник", "Вторник", "Среда", "Четверг",
                                    "Пятница",
                                    "Суббота"
                                ],
                                "shortDays": ["Вс", "Пн", "Вт", "Ср", "Чт", "Пт", "Сб"],
                                "toolbar": {
                                    "exportToSVG": "Скачать SVG",
                                    "exportToPNG": "Скачать PNG",
                                    "menu": "Меню",
                                    "selection": "Selection",
                                    "selectionZoom": "Selection Zoom",
                                    "zoomIn": "Zoom In",
                                    "zoomOut": "Zoom Out",
                                    "pan": "Panning",
                                    "reset": "Reset Zoom"
                                }
                            }
                        }],

                    },
                    series: [{
                        name: 'Просмотры',
                        data: ch
                    }],
                    xaxis: {
                        type: "datetime",

                    }
                }

                var chart = new ApexCharts(document.querySelector("#chart"), options);

                chart.render();
            }

            getStat()
        </script>
    </div>
@endsection
