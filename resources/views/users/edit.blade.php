@extends('template.main')
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Пользователь {{$user->name}} /</span> Редактировать</h4>

    <div class="row">
      <div class="col-md-12">
        <div class="card mb-4">
          <h5 class="card-header">Детали профиля</h5>

          <hr class="my-0">
          <div class="card-body">
             @include('profile.partials.update-profile-information-form')
          </div>
          <hr class="my-0">
          <div class="card-body">
            @include('profile.partials.update-password-form')
         </div>
         <hr class="my-0">
         <div class="card-body">
          @include('profile.partials.delete-user-form')
       </div>
        </div>

      </div>
    </div>
  </div>

  @endsection
