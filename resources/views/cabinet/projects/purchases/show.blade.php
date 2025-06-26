@extends('layouts.cabinet')

@section('title', 'Просмотр закупки')

@section('content')

    <div class="container">

        <div class="row justify-content-center">


            <div class="col-12">
                <div class="back-log">
                    <div class="back-link"><a class="btn-link btn-backlink" href="{{ route('cabinet.project.contractor.index',  [$project->id]) }}">Назад</a>
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
                    <div class="card-head">Просмотр закупки</div>

                    <div class="card-content">
                        <form method="post"
                              action=""
                              enctype="">
                            @csrf


                            <div class="row mb-3">
                                <label for="title" class="col-md-4 col-form-label text-md-end">Название закупки</label>

                                <div class="col-md-6">
                                    <input id="title" type="text"
                                           class="form-control"
                                           name="title"
                                           value="{{$purchase->title }}" disabled>
                                </div>
                            </div>


                            <div class="row mb-3">
                                <label for="description" class="col-md-4 col-form-label text-md-end">Описание</label>

                                <div class="col-md-6">
                                    <textarea name="description" id="description"
                                              class="form-control" cols="30"
                                              rows="6"
                                              disabled>{{ $purchase->description ?? '' }}</textarea>
                                </div>
                            </div>


                            <div class="row mb-3">

                                <label for="stage" class="col-md-4 col-form-label text-md-end">Этап</label>
                                <div class="col-md-6">
                                    <input id="stage" type="text"
                                           class="form-control"
                                           name="stage"
                                           value="{{ $purchase->stage->title  }}" disabled>
                                </div>

                            </div>


                            <div class="row mb-3">
                                <label for="purchase_date" class="col-md-4 col-form-label text-md-end">Дата закупки</label>

                                <div class="col-md-6">
                                    <input id="purchase_date" type="text"
                                           class="form-control"
                                           name="purchase_date"
                                           value="{{  $purchase->purchase_date ? $purchase->purchase_date->format('d.m.Y') : '' }}"
                                           disabled
                                    >

                                </div>
                            </div>





                            <div class="row mb-3">
                                <label for="comments" class="col-md-4 col-form-label text-md-end">Комментарии</label>

                                <div class="col-md-6">
                                    <textarea name="comments" id="comments"
                                              class="form-control" cols="30"
                                              rows="6"
                                              disabled>{{ $purchase->comments ?? '' }}</textarea>
                                </div>
                            </div>










                        </form>



                    </div>
                </div>

            </div>

        </div>
    </div>

@endsection
