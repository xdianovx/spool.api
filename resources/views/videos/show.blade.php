@extends('template.main')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">
    <a href="{{ route('videos.index') }}"> Видео</a> / {{$video->name}} </h4>
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
                  <svg xmlns="http://www.w3.org/2000/svg" height="240" width="240" viewBox="0 0 24 24"
                      style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
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
              <td class="align-middle"><small class="text-light fw-semibold">Id:</small></td>
              <td class="py-3">
                <p class="mb-0">{{$video->id}}</p>
              </td>
            </tr>
            <tr>
              <td class="align-middle"><small class="text-light fw-semibold">Название:</small></td>
              <td class="py-3">
                <p class="mb-0">{{$video->name}}</p>
              </td>
            </tr>
            <tr>
              <td class="align-middle"><small class="text-light fw-semibold">Слаг:</small></td>
              <td class="py-3">
                <p class="mb-0">{{$video->slug}}</p>
              </td>
            </tr>
            <tr>
              <td class="align-middle"><small class="text-light fw-semibold">Родительская категория:</small></td>
              <td class="py-3">
                <p class="mb-0">
                  @if (!empty($video->parent->name))
                    {{ $video->parent->name }}
                  @else
                    Без родительской категории
                  @endif
                </p>
              </td>
            </tr>
            <tr>
              <td class="align-middle"><small class="text-light fw-semibold">Дата создания:</small></td>
              <td class="py-3">
                <p class="mb-0">{{$video->created_at}}</p>
              </td>
            </tr>
            <tr>
              <td class="align-middle"><small class="text-light fw-semibold">Сортировка:</small></td>
              <td class="py-3">
                <p class="mb-0">{{$video->sort}}</p>
              </td>
            </tr>
          </tbody>
        </table>

        <hr class="m-0">
        <div class="row demo-vertical-spacing">
 
          <div class="col">
            <a class="btn btn-primary text-nowrap" href="{{ route('videos.index') }}">Назад</a>
          </div>
        </div>


         

      </div>
    </div>
  </div>
</div>
</div>
  @endsection