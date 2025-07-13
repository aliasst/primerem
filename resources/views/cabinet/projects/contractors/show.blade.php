@extends('layouts.cabinet')

@section('title', 'Просмотр подрядчика')

@section('content')

    <div class="container">

        <div class="row justify-content-center">


            <div class="col-12">
                <div class="back-log">
                    <div class="back-link"><a class="btn-link btn-backlink"
                                              href="{{ route('cabinet.project.contractor.index',  [$project->id]) }}">Вернуться
                            назад</a>
                    </div>

                </div>


                <div class="card-head-new"> Просмотр подрядчика</div>
                <div class="card-head-new-sub"></div>


                @include('flash-messages')


            </div>
            <div class="col-12 col-md-8">

                <div class="request-card card auth-card">


                    <div class="card-content">
                        <form method="post"
                              action=""
                              enctype="">
                            @csrf


                            <div class="row mb-3">


                                <div class="col-12">
                                    <div class="form-input">
                                        <label for="title" class="">Название подрядчика</label>
                                        <input id="title" type="text"
                                               class=""
                                               name="title"
                                               value="{{$contractor->title }}" disabled>
                                    </div>


                                </div>
                            </div>


                            <div class="row mb-3">


                                <div class="col-12">
                                    <div class="form-input">
                                        <label for="stage" class="">Этап</label>
                                        <input id="stage" type="text"
                                               class=""
                                               name="stage"
                                               value="{{ $contractor->stage->title  }}" disabled>
                                    </div>


                                </div>
                            </div>



                            <div class="row mb-3">


                                <div class="col-12">
                                    <div class="form-input">
                                        <label for="start_date" class="">Начало работ</label>
                                        <input id="start_date" type="text"
                                               class=""
                                               name="start_date"
                                               value="{{  $contractor->start_date ? $contractor->start_date->format('d.m.Y') : '' }}"
                                               disabled
                                        >
                                    </div>


                                </div>
                            </div>


                            <div class="row mb-3">


                                <div class="col-12">
                                    <div class="form-input">
                                        <label for="finish_date" class="">Конец работ</label>
                                        <input id="finish_date" type="text"
                                               class=""
                                               name="finish_date"
                                               value="{{  $contractor->finish_date ? $contractor->finish_date->format('d.m.Y') : '' }}"
                                               disabled
                                        >
                                    </div>


                                </div>
                            </div>


                            <div class="row mb-3">


                                <div class="col-12">
                                    <div class="form-input">
                                        <label for="comments" class="">Комментарии</label>
                                        <textarea name="comments" id="comments"
                                                  class="" cols="30"
                                                  rows="6"
                                                  disabled>{{ $contractor->comments ?? '' }}</textarea>
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
