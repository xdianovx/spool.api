@extends('template.main')
@section('content')


<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Страны /</span> Список</h4>

    <!-- Basic Bootstrap Table -->
    <div class="card">
      <div class="table-responsive text-nowrap">
        <table class="table">
          <thead>
            <tr>
              <th>Id</th>
              <th>Название</th>
              <th>Редактировать</th>
            </tr>
          </thead>
          <tbody class="table-border-bottom-0">
@foreach ($countries as $country)
<tr>
    <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$country->id}}</strong></td>
    <td>{{$country->name}}</td>
    <td>
      <div class="dropdown">
        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
          <i class="bx bx-dots-vertical-rounded"></i>
        </button>
        <div class="dropdown-menu">
          {{-- <a class="dropdown-item" href="{{ route('country.show', $country->id) }}"><i class="menu-icon tf-icons bx bx-detail"></i> Показать</a> --}}
          <a class="dropdown-item" href="{{ route('country.edit', $country->id) }}"><i class="bx bx-edit-alt me-1"></i> Редактировать</a>
          <a class="dropdown-item" href="{{ route('country.destroy', $country->id) }}"><i class="bx bx-trash me-1"></i> Удалить</a>
        </div>
      </div>
    </td>
  </tr>  
@endforeach

          </tbody>
        </table>
      </div>
    </div>
    <!--/ Basic Bootstrap Table -->

  </div>


@endsection