@extends('layouts.cabinet')

@section('title', 'Редактирование этапа')

@section('content')

    <div class="container">

        <div class="row justify-content-center">


            <div class="col-12">
                <div class="back-log">
                    <div class="back-link"><a class="btn-link btn-backlink" href="{{ route('cabinet.project.stage.index',  [$project->id]) }}">Назад</a>
                    </div>
                    <div class="logout-link">
                        Вы в личном кабинете!
                        @if (Route::has('logout'))
                            <a class="btn-link btn-unlogin" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                                         document.getElementById('logout-form').submit();">
                                {{ __('Выйти') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>

                        @endif
                    </div>
                </div>


                <div class="py-5 text-center">
                    <div class="logo-cell " style="margin-bottom: 0">Prime<span>REM</span></div>
                </div>

                @include('flash-messages')


            </div>
            <div class="col-12 col-md-8">

                <div class="request-card card auth-card">
                    <div class="card-head"> Редактирование этапа</div>

                    <div class="card-content">
                        <form method="post"
                              action="{{ route('cabinet.project.stage.update',  [$project->id, $stage->id]) }}"
                              enctype="multipart/form-data">
                            @method('put')
                            @csrf


                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">Название этапа</label>

                                <div class="col-md-6">
                                    <input id="title" type="text"
                                           class="form-control @error('title') is-invalid @enderror"
                                           name="title"
                                           value="{{ old('title') ?? $stage->title }}">

                                    @error('title')
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="row mb-3">

                                <label for="status" class="col-md-4 col-form-label text-md-end">Статус</label>
                                <div class="col-md-6">
                                    <div class="form-item checkselect checkselect-js checkselect-border onecheck">
                                        <label @if($stage->status == 'status_0') class="js-active" @endif><input
                                                style="display:none;" type="checkbox"
                                                name="status" value="status_0"
                                                @if($stage->status == 'status_0') checked @endif >{{ \App\Models\Stage::$statuses['status_0'] }}
                                        </label>
                                        <label @if($stage->status == 'status_1') class="js-active" @endif><input
                                                style="display:none;" type="checkbox"
                                                name="status" value="status_1"
                                                @if($stage->status == 'status_1') checked @endif >{{ \App\Models\Stage::$statuses['status_1'] }}
                                        </label>
                                        <label @if($stage->status == 'status_2') class="js-active" @endif><input
                                                style="display:none;" type="checkbox"
                                                name="status" value="status_2"
                                                @if($stage->status == 'status_2') checked @endif >{{ \App\Models\Stage::$statuses['status_2'] }}
                                        </label>
                                        <label @if($stage->status == 'status_3') class="js-active" @endif><input
                                                style="display:none;" type="checkbox"
                                                name="status" value="status_3"
                                                @if($stage->status == 'status_3') checked @endif >{{ \App\Models\Stage::$statuses['status_3'] }}
                                        </label>


                                    </div>
                                </div>

                            </div>



                            <div class="row mb-3">
                                <label for="start_date" class="col-md-4 col-form-label text-md-end">Дата старта</label>

                                <div class="col-md-6">

                                    <input id="start_date"  type="text"
                                           class="datepicker form-control date-input @error('start_date') is-invalid @enderror"
                                           name="start_date"
                                                                                  value="{{  $stage->start_date ? $stage->start_date->format('d.m.Y') : '' }}"

                                    >


                                    @error('start_date')
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="row mb-3">
                                <label for="finish_date" class="col-md-4 col-form-label text-md-end">Дата завершения</label>

                                <div class="col-md-6">

                                    <input id="finish_date"  type="text"
                                           class="datepicker form-control date-input @error('finish_date') is-invalid @enderror"
                                           name="finish_date"
                                           value="{{  $stage->finish_date ? $stage->finish_date->format('d.m.Y') : '' }}"

                                    >


                                    @error('finish_date')
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>
                            </div>





                            <div class="row mb-2">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="orange-btn orange-btn-min">
                                        {{ __('Сохранить') }}
                                    </button>
                                </div>
                            </div>

                        </form>

                        <div class="row mt-3">
                            <div class="col-md-6 offset-md-4">
                                <form action="{{ route('cabinet.project.stage.destroy',  [$project->id, $stage->id]) }}" method="POST"
                                      onsubmit="return confirm('Вы точно хотите удалить этот этап?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn-link" type="submit" onclick="">Удалить этап</button>
                                </form>

                            </div>
                        </div>


                    </div>
                </div>

            </div>

        </div>
    </div>

@endsection
