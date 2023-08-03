@extends('template.main')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">
    <a href="{{ route('tags.index') }}"> Теги</a> / {{$tag->name}} </span></h4>
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
                <p class="mb-0">{{$tag->id}}</p>
              </td>
            </tr>
            <tr>
              <td class="align-middle"><small class="text-light fw-semibold">Название:</small></td>
              <td class="py-3">
                <p class="mb-0">{{$tag->name}}</p>
              </td>
            </tr>
            <tr>
              <td class="align-middle"><small class="text-light fw-semibold">Отображение:</small></td>
              <td class="py-3">
                <p class="mb-0">
                  @if ($tag->display == "true")
                  Да
                  @elseif($tag->display == "false")
                  Нет
                  @else
                  Не указано
                  @endif
                </p>
              </td>
            </tr>
          </tbody>
        </table>

        <hr class="m-0">
        <div class="row demo-vertical-spacing">
 
          <div class="col">
            <a class="btn btn-primary text-nowrap" href="{{ route('tags.index') }}">Назад</a>
          </div>
        </div>


         

      </div>
    </div>
  </div>
</div>
</div>
  @endsection