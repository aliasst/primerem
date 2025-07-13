@extends('layouts.cabinet')

@section('title', 'Редактирование подрядчика')

@section('content')

    <div class="container">

        <div class="row justify-content-center">


            <div class="col-12">
                <div class="back-log">
                    <div class="back-link"><a class="btn-link btn-backlink" href="{{ route('cabinet.project.contractor.index',  [$project->id]) }}">Вернуться назад</a>
                    </div>
                </div>


                <div class="card-head-new"> Редактирование подрядчика</div>
                <div class="card-head-new-sub">Отредактируйте данные, чтобы изменить подрядчика</div>

                @include('flash-messages')


            </div>
            <div class="col-12 col-md-8">

                <div class="request-card card auth-card">

                    <div class="card-content">
                        <form method="post"
                              action="{{ route('cabinet.project.contractor.update',  [$project->id, $contractor->id]) }}"
                              enctype="multipart/form-data">
                            @method('put')
                            @csrf


                            <div class="row mb-3">


                                <div class="col-12">
                                    <div class="form-input">
                                        <label for="title" class="">Название подрядчика</label>
                                        <input id="title" type="text"
                                               class=" @error('title') is-invalid @enderror"
                                               name="title"
                                               value="{{ old('title') ?? $contractor->title }}">
                                    </div>

                                    @error('title')
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="row mb-3">


                                <div class="col-12">

                                    <div class="check-wrap">
                                        <label for="stage_id" class="check-wrap-label">Этап</label>
                                        <div class="form-item checkselect checkselect-js checkselect-border onecheck">
                                            @foreach($stages as $stage)
                                                <label @if($contractor->stage_id == $stage->id) class="js-active" @endif><input
                                                        style="display:none;" type="checkbox"
                                                        name="stage_id" value="{{$stage->id}}"
                                                        @if($contractor->stage_id == $stage->id) checked @endif >{{$stage->title}}
                                                </label>
                                                @foreach($stage->child_stages as  $child_stage)
                                                    <label
                                                        @if($contractor->stage_id == $child_stage->id) class="js-active" @endif><input
                                                            style="display:none;" type="checkbox"
                                                            name="stage_id" value="{{$child_stage->id}}"
                                                            @if($contractor->stage_id == $child_stage->id) checked @endif >- {{$child_stage->title}}
                                                    </label>
                                                @endforeach

                                            @endforeach


                                        </div>
                                    </div>


                                    @error('stage_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="row mb-3">


                                <div class="col-12">
                                    <div class="form-input">
                                        <label for="comments" class="">Комментарии</label>
                                        <textarea name="comments" id="comments"
                                                  class=" @error('comments') is-invalid @enderror" cols="30"
                                                  rows="6">{{ old('comments') ?? $contractor->comments }}</textarea>
                                    </div>

                                    @error('comments')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="row mb-3">


                                <div class="col-12">
                                    <div class="form-input">
                                        <label for="start_date" class="">Начало работ</label>
                                        <input id="start_date"  type="text"
                                               class="datepicker form-control date-input @error('start_date') is-invalid @enderror"
                                               name="start_date"
                                               value="{{  $contractor->start_date ? $contractor->start_date->format('d.m.Y') : '' }}"

                                        >
                                    </div>

                                    @error('start_date')
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="row mb-3">


                                <div class="col-12">
                                    <div class="form-input">
                                        <label for="finish_date" class="">Конец работ</label>
                                        <input id="finish_date"  type="text"
                                               class="datepicker form-control date-input @error('finish_date') is-invalid @enderror"
                                               name="finish_date"
                                               value="{{  $contractor->finish_date ? $contractor->finish_date->format('d.m.Y') : '' }}"

                                        >
                                    </div>

                                    @error('finish_date')
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>
                            </div>








                            <div class="row mb-3">
                                <div class="col-12">
                                    <div class="btn-row btn-row-center">
                                        <button type="submit" class="orange-btn orange-btn-min">
                                            {{ __('Сохранить') }}
                                        </button>
                                    </div>


                                </div>
                            </div>

                        </form>

                        <div class="row mt-3">
                            <div class="col-12 text-center">
                                <form action="{{ route('cabinet.project.contractor.destroy',  [$project->id, $contractor->id]) }}" method="POST"
                                      onsubmit="return confirm('Вы точно хотите удалить подрядчика?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn-link" type="submit" onclick="">Удалить подрядчика</button>
                                </form>

                            </div>
                        </div>


                    </div>
                </div>

            </div>

        </div>
    </div>

@endsection
