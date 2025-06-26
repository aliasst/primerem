@extends('layouts.cabinet')

@section('title', 'Редактирование закупки')

@section('content')

    <div class="container">

        <div class="row justify-content-center">


            <div class="col-12">
                <div class="back-log">
                    <div class="back-link"><a class="btn-link btn-backlink" href="{{ route('cabinet.project.purchase.index',  [$project->id]) }}">Назад</a>
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
                    <div class="card-head"> Редактирование закупки</div>

                    <div class="card-content">
                        <form method="post"
                              action="{{ route('cabinet.project.purchase.update',  [$project->id, $purchase->id]) }}"
                              enctype="multipart/form-data">
                            @method('put')
                            @csrf


                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">Название закупки</label>

                                <div class="col-md-6">
                                    <input id="title" type="text"
                                           class="form-control @error('title') is-invalid @enderror"
                                           name="title"
                                           value="{{ old('title') ?? $purchase->title }}">

                                    @error('title')
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="row mb-3">
                                <label for="description" class="col-md-4 col-form-label text-md-end">Описание</label>

                                <div class="col-md-6">
                                    <textarea name="description" id="description"
                                              class="form-control @error('comments') is-invalid @enderror" cols="30"
                                              rows="6">{{ old('comments') ?? $purchase->comments }}</textarea>

                                    @error('comments')
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
                                            <label @if($purchase->stage_id == $stage->id) class="js-active" @endif><input
                                                    style="display:none;" type="checkbox"
                                                    name="stage_id" value="{{$stage->id}}"
                                                    @if($purchase->stage_id == $stage->id) checked @endif >{{$stage->title}}
                                            </label>
                                            @foreach($stage->child_stages as  $child_stage)
                                                <label
                                                    @if($purchase->stage_id == $child_stage->id) class="js-active" @endif><input
                                                        style="display:none;" type="checkbox"
                                                        name="stage_id" value="{{$child_stage->id}}"
                                                        @if($purchase->stage_id == $child_stage->id) checked @endif >- {{$child_stage->title}}
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
                                              rows="6">{{ old('comments') ?? $purchase->comments }}</textarea>

                                    @error('comments')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="row mb-3">
                                <label for="purchase_date" class="col-md-4 col-form-label text-md-end">Дата закупки</label>

                                <div class="col-md-6">

                                    <input id="purchase_date"  type="text"
                                           class="datepicker form-control date-input @error('start_date') is-invalid @enderror"
                                           name="purchase_date"
                                           value="{{  $purchase->purchase_date ? $purchase->purchase_date->format('d.m.Y') : '' }}"

                                    >


                                    @error('start_date')
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
                                <form action="{{ route('cabinet.project.purchase.destroy',  [$project->id, $purchase->id]) }}" method="POST"
                                      onsubmit="return confirm('Вы точно хотите удалить закупку?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn-link" type="submit" onclick="">Удалить закупку</button>
                                </form>

                            </div>
                        </div>


                    </div>
                </div>

            </div>

        </div>
    </div>

@endsection
