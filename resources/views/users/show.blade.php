@extends('template.main')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">
      <a href="{{ route('users.index') }}"> Администраторы</a> / Пользователь {{$user->name}} /</span> Информация о профиле</h4>
<div class="row">
    <!-- Inline text elements -->
    <div class="col">
      <div class="card mb-4">
        <h5 class="card-header">Информация о профиле</h5>
        <div class="card-body">

          <table class="table table-borderless">
            <tbody>
              <tr>
                <td class="align-middle"><small class="text-light fw-semibold">Id профиля:</small></td>
                <td class="py-3">
                  <p class="mb-0">{{$user->id}}</p>
                </td>
              </tr>
              <tr>
                <td class="align-middle"><small class="text-light fw-semibold">Имя:</small></td>
                <td class="py-3">
                  <p class="mb-0">{{$user->name}}</p>
                </td>
              </tr>
              <tr>
                <td><small class="text-light fw-semibold">Фамилия:</small></td>
                <td class="py-3">
                  <p class="mb-0">{{$user->surname}}</p>
                </td>
              </tr>
              <tr>
                <td><small class="text-light fw-semibold">Email:</small></td>
                <td class="py-3">
                  <p class="mb-0">{{$user->email}}</p>
                </td>
              </tr>
              <tr>
                <td><small class="text-light fw-semibold">Номер телефона:</small></td>
                <td class="py-3">
                  <p class="mb-0">{{$user->phone_number}}</p>
                </td>
              </tr>
              <tr>
                <td><small class="text-light fw-semibold">Роль:</small></td>
                <td class="py-3">
                  <p class="mb-0">{{$user->role}}</p>
                </td>
              </tr>
              <tr>
                <td><small class="text-light fw-semibold">Дата последнего входа:</small></td>
                <td class="py-3">
                  <p class="mb-0">{{$user->last_login_date}}</p>
                </td>
              </tr>
              <tr>
                <td><small class="text-light fw-semibold">Дата регистрации:</small></td>
                <td class="py-3">
                  <p class="mb-0">{{$user->created_at}}</p>
                </td>
              </tr>
              <tr>
                <td><small class="text-light fw-semibold">Партнерская компания:</small></td>
                <td>
                  <p class="mb-0">
                    {{$user->partner_company->name ?? 'Без партнерской компании'}}</p>
                </td>
              </tr>
            </tbody>
          </table>


          <div class="row demo-vertical-spacing">
   
            <div class="col">
              <a class="btn btn-primary text-nowrap" href="{{ route('users.index') }}">Назад</a>
            </div>
          </div>


           

        </div>
      </div>
    </div>
  </div>
</div>
  @endsection