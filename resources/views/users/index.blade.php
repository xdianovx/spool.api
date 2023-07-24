@extends('template.main')
@section('content')


<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Пользователи /</span> Список</h4>   
    <!-- Basic Bootstrap Table -->
    <div class="card">
      <div class="card-body">
        <div class="demo-inline-spacing">
          <a type="button" class="btn btn-outline-secondary fw-semibold" href="{{ route('user.create') }}">Добавить</a>
        </div>
      </div>
      <hr class="m-0">
      <div class="table-responsive text-nowrap">
        <table class="table">
          <thead>
            <tr>
              <th>Id</th>
              <th>Имя</th>
              <th>Email</th>
              <th>Роль</th>
              <th>Редактировать</th>
            </tr>
          </thead>
          <tbody class="table-border-bottom-0">
@foreach ($users as $user)
<tr>
    <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$user->id}}</strong></td>
    <td>{{$user->name}}</td>
    <td>
        {{$user->email}}
    </td>
    <td><span class="badge bg-label-primary me-1">{{$user->role}}</span></td>
    <td>
      <div class="dropdown">
        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
          <i class="bx bx-dots-vertical-rounded"></i>
        </button>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="{{ route('user.show', $user->id) }}"><i class="menu-icon tf-icons bx bx-detail"></i> Показать</a>
          <a class="dropdown-item" href="{{ route('user.edit', $user->id) }}"><i class="bx bx-edit-alt me-1"></i> Редактировать</a>
          <a class="dropdown-item" href="{{ route('user.destroy', $user->id) }}"><i class="bx bx-trash me-1"></i> Удалить</a>
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