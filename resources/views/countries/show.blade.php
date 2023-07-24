@extends('template.main')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Запись {{$country->name}} /</span> Информация о записи</h4>
<div class="row">
    <!-- Inline text elements -->
    <div class="col">
      <div class="card mb-4">
        <div class="card-body">
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
        </div>
      </div>
    </div>
  </div>
</div>
  @endsection