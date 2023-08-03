@extends('template.main')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">
    <a href="{{ route('countries.index') }}"> Страны</a> / {{$country->name}} </span></h4>
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
              <td class="align-middle"><small class="text-light fw-semibold">Id:</small></td>
              <td class="py-3">
                <p class="mb-0">{{$country->id}}</p>
              </td>
            </tr>
            <tr>
              <td class="align-middle"><small class="text-light fw-semibold">Название:</small></td>
              <td class="py-3">
                <p class="mb-0">{{$country->name}}</p>
              </td>
            </tr>
          </tbody>
        </table>

        <hr class="m-0">
        <div class="row demo-vertical-spacing">
 
          <div class="col">
            <a class="btn btn-primary text-nowrap" href="{{ route('countries.index') }}">Назад</a>
          </div>
        </div>


         

      </div>
    </div>
  </div>
</div>
</div>
  @endsection