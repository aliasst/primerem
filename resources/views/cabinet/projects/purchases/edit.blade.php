@extends('layouts.cabinet')

@section('title', 'Редактирование закупки')

@section('content')

    <div class="container">

        <div class="row justify-content-center">


            <div class="col-12">
                <div class="back-log">
                    <div class="back-link"><a class="btn-link btn-backlink" href="{{ route('cabinet.project.purchase.index',  [$project->id]) }}">Назад</a>
                    </div>

                </div>


                <div class="card-head-new"> Редактирование закупки</div>
                <div class="card-head-new-sub">Отредактируйте данные, чтобы изменить закупку</div>


                @include('flash-messages')


            </div>
            <div class="col-12 col-md-8">

                <div class="request-card card auth-card">


                    <div class="card-content">
                        <form method="post"
                              action="{{ route('cabinet.project.purchase.update',  [$project->id, $purchase->id]) }}"
                              enctype="multipart/form-data">
                            @method('put')
                            @csrf

                            <div class="row mb-3">


                                <div class="col-12">
                                    <div class="form-input">
                                        <label for="title" class="">Название закупки</label>
                                        <input id="title" type="text"
                                               class=" @error('title') is-invalid @enderror"
                                               name="title"
                                               value="{{ old('title') ?? $purchase->title }}">
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
                                                  class=" @error('comments') is-invalid @enderror" cols="30"
                                                  rows="6">{{ old('comments') ?? $purchase->description }}</textarea>

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
                                                  rows="6">{{ old('comments') ?? $purchase->comments }}</textarea>

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
                                        <input id="purchase_date"  type="text"
                                               class="datepicker date-input @error('start_date') is-invalid @enderror"
                                               name="purchase_date"
                                               value="{{  $purchase->purchase_date ? $purchase->purchase_date->format('d.m.Y') : '' }}"

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
