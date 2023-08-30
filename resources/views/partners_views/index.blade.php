@extends('template.main')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Видеоролики /</span></h4>
        <div class="card">
            <h5 class="card-header">Список</h5>


            <hr class="m-0">
            <div class="card-body">
                <form class="d-flex" action="{{ route('partner_videos.search') }}" method="get">
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
                                <th>Название</th>
                                <th>Категория</th>
                                <th>Дата события</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @forelse ($videos as $video)
                                <tr>
                                    <td>{{ $video->name }}</td>
                                    <td>{{ $video->category->name ?? 'Без категории'}}</td>
                                    <td>{{$video->event_date}}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{ route('partner_video.show', $video->id) }}">
                                                    <i class="menu-icon tf-icons bx bx-detail"></i> Детали</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-danger">По вашему запросу ничего не найдено.</td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                    @if ($videos->links()->paginator->hasPages())
                        <div class="demo-inline-spacing">
                            {{ $videos->links() }}
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>

@endsection
