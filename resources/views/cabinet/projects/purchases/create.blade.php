@extends('layouts.cabinet')

@section('title', 'Новая закупка')

@section('content')

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-12">
                <div class="back-log">
                    <div class="back-link"><a class="btn-link btn-backlink"
                                              href="{{ route('cabinet.project.purchase.index',  [$project->id]) }}">Вернуться
                            назад</a>
                    </div>

                </div>


                <div class="card-head-new">Cоздание новой закупки</div>
                <div class="card-head-new-sub">Заполните данные, чтобы добавить новую закупку</div>

                @include('flash-messages')


            </div>
            <div class="col-12 col-md-8">

                <div class="request-card card auth-card">


                    <div class="card-content">
                        <form method="post" action="{{ route('cabinet.project.purchase.store',  [$project->id]) }}"
                              enctype="multipart/form-data">

                            @csrf

                            <div class="row mb-3">


                                <div class="col-12">
                                    <div class="form-input">
                                        <label for="title" class="">Название закупки</label>
                                        <input id="title" type="text"
                                               class="form-control @error('title') is-invalid @enderror" name="title"
                                               value="{{ old('title') ?? '' }}">
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
                                    <div class="form-input">
                                        <label for="description" class="">Описание</label>
                                        <textarea name="description" id="description"
                                                  class="form-control @error('description') is-invalid @enderror"
                                                  cols="30"
                                                  rows="6">{{ old('description') ?? '' }}</textarea>
                                    </div>

                                    @error('description')
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
                                                <label
                                                    @if(old('stage_id') == $stage->id) class="js-active" @endif><input
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
                                                  class="form-control @error('comments') is-invalid @enderror" cols="30"
                                                  rows="6">{{ old('comments') ?? '' }}</textarea>
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
                                        <label for="purchase_date" class="">Дата закупки</label>
                                        <input id="purchase_date"
                                               type="text"
                                               class="datepicker form-control @error('purchase_date') is-invalid @enderror"
                                               name="purchase_date"
                                               autocomplete="off"
                                               value="{{  old('purchase_date') ?? '' }}"
                                        >
                                    </div>

                                    @error('purchase_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="row mb-3">
                                <label for="file-purchase" class="col-12 col-form-label text-md-end"></label>

                                <div class="col-md-6">
                                    <div class="files-main-wrap">
                                        <div class="file-form-wrap">

                                            <div class="file-upload my-btn">
                                                <label>
                                                    <input class="fl_inp " type="file" name="file-purchase[]">
                                                    <span>Добавить файл</span>
                                                </label>
                                            </div>
                                            <div class="file-name"></div>
                                        </div>
                                    </div>

                                    @error('file-purchase')
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


                    </div>
                </div>

            </div>

        </div>
    </div>

@endsection
