@extends('template.main')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">
    <a href="{{ route('partners_companies.index') }}"> Страны</a> / {{$partners_company->name}} /</span> Информация</h4>
<div class="row">
  <!-- Inline text elements -->
  <div class="col">
    <div class="card mb-4">
      <h5 class="card-header">Информация</h5>
      <div class="card-body">

        <table class="table table-borderless">
          <tbody>
            <tr>
              <td class="align-middle"><small class="text-light fw-semibold">Id:</small></td>
              <td class="py-3">
                <p class="mb-0">{{$partners_company->id}}</p>
              </td>
            </tr>
            <tr>
              <td class="align-middle"><small class="text-light fw-semibold">Название:</small></td>
              <td class="py-3">
                <p class="mb-0">{{$partners_company->name}}</p>
              </td>
            </tr>
          </tbody>
        </table>


        <div class="row demo-vertical-spacing">
 
          <div class="col">
            <a class="btn btn-primary text-nowrap" href="{{ route('partners_companies.index') }}">Назад</a>
          </div>
        </div>


         

      </div>
    </div>
  </div>
</div>
</div>
  @endsection