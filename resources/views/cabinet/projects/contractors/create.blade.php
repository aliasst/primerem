@extends('layouts.cabinet')

@section('title', 'Новый подрядчик')

@section('content')

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-12">
                <div class="back-log">
                    <div class="back-link"><a class="btn-link btn-backlink"
                                              href="{{ route('cabinet.project.contractor.index',  [$project->id]) }}">Назад</a>
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
                    <div class="card-head"> Новый подрядчик</div>

                    <div class="card-content">
                        <form method="post" action="{{ route('cabinet.project.contractor.store',  [$project->id]) }}"
                              enctype="multipart/form-data">

                            @csrf


                            <div class="row mb-3">
                                <label for="title" class="col-md-4 col-form-label text-md-end">Название
                                    подрядчика </label>

                                <div class="col-md-6">
                                    <input id="title" type="text"
                                           class="form-control @error('title') is-invalid @enderror" name="title"
                                           value="{{ old('title') ?? '' }}">

                                    @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="row mb-3">

                                <label for="stage_id" class="col-md-4 col-form-label text-md-end">Этап</label>
                                <div class="col-md-6">
                                    <div class="form-item checkselect checkselect-js checkselect-border onecheck">
                                        @foreach($stages as $stage)
                                            <label @if(old('stage_id') == $stage->id) class="js-active" @endif><input
                                                    style="display:none;" type="checkbox"
                                                    name="stage_id" value="{{$stage->id}}"
                                                    @if(old('stage_id') == $stage->id) checked @endif >{{$stage->title}}
                                            </label>
                                            @foreach($stage->child_stages as  $child_stage)
                                                <label
                                                    @if(old('stage_id') == $child_stage->id) class="js-active" @endif><input
                                                        style="display:none;" type="checkbox"
                                                        name="stage_id" value="{{$child_stage->id}}"
                                                        @if(old('stage_id') == $child_stage->id) checked @endif >- {{$child_stage->title}}
                                                </label>
                                            @endforeach

                                        @endforeach


                                    </div>
                                </div>

                            </div>


                            <div class="row mb-3">
                                <label for="comments" class="col-md-4 col-form-label text-md-end">Комментарии</label>

                                <div class="col-md-6">
                                    <textarea name="comments" id="comments"
                                              class="form-control @error('comments') is-invalid @enderror" cols="30"
                                              rows="6">{{ old('comments') ?? '' }}</textarea>

                                    @error('comments')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="row mb-3">
                                <label for="start_date" class="col-md-4 col-form-label text-md-end">Начало работ</label>

                                <div class="col-md-6">
                                    <input id="start_date"
                                           type="text"
                                           class="datepicker form-control @error('start_date') is-invalid @enderror"
                                           name="start_date"
                                           autocomplete="off"
                                           value="{{  old('start_date') ?? '' }}"
                                    >
                                    @error('start_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="row mb-3">
                                <label for="finish_date" class="col-md-4 col-form-label text-md-end">Конец работ</label>

                                <div class="col-md-6">
                                    <input id="finish_date"
                                           type="text"
                                           class="datepicker form-control @error('finish_date') is-invalid @enderror"
                                           name="finish_date"
                                           autocomplete="off"
                                           value="{{  old('finish_date') ?? '' }}"
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


                    </div>
                </div>

            </div>

        </div>
    </div>

@endsection
