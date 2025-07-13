@extends('layouts.cabinet')

@section('title', 'Новый акт')

@section('content')

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-12">
                <div class="back-log">
                    <div class="back-link"><a class="btn-link btn-backlink" href="{{ route('cabinet.project.act.index',  [$project->id]) }}">Венуться назад</a>
                    </div>

                </div>


                <div class="card-head-new"> Cоздание  нового акта</div>
                <div class="card-head-new-sub">Заполните данные, чтобы добавить новый акт</div>



                @include('flash-messages')


            </div>
            <div class="col-12 col-md-8">

                <div class="request-card card auth-card">

                    <div class="card-content">
                        <form method="post" action="{{ route('cabinet.project.act.store',  [$project->id]) }}" enctype="multipart/form-data">

                            @csrf

                            <div class="row mb-3">


                                <div class="col-12">
                                    <div class="form-input">
                                        <label for="act_number" class="">Номер акта</label>
                                        <input id="act_number" type="text"
                                               class="form-control @error('act_number') is-invalid @enderror" name="act_number"
                                               value="{{ old('act_number') ?? '' }}">
                                    </div>

                                    @error('act_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="row mb-3">


                                <div class="col-12">

                                    <div class="check-wrap">
                                        <label for="status" class="check-wrap-label">Статус</label>
                                        <div class="form-item checkselect checkselect-js checkselect-border onecheck">
                                            <label @if(old('status') == 'status_1') class="js-active" @endif><input
                                                    style="display:none;" type="checkbox"
                                                    name="status" value="status_1"
                                                    @if(old('status') == 'status_1') checked @endif >{{ \App\Models\Act::$statuses['status_1'] }}</label>
                                            <label @if(old('status') == 'status_2') class="js-active" @endif><input
                                                    style="display:none;" type="checkbox"
                                                    name="status" value="status_2"
                                                    @if(old('status') == 'status_2') checked @endif >{{ \App\Models\Act::$statuses['status_2'] }}</label>
                                            <label @if(old('status') == 'status_3') class="js-active" @endif><input
                                                    style="display:none;" type="checkbox"
                                                    name="status" value="status_3"
                                                    @if(old('status') == 'status_3') checked @endif >{{ \App\Models\Act::$statuses['status_3'] }}</label>


                                        </div>
                                    </div>


                                    @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>







                            <div class="row mb-3">
                                <label for="" class="col-12 col-form-label"></label>

                                <div class="col-12">
                                    <div class="files-main-wrap">
                                        <div class="file-form-wrap">

                                            <div class="file-upload my-btn">
                                                <label>
                                                    <input class="fl_inp " type="file" name="file-act">
                                                    <span>Добавить файл</span>
                                                </label>
                                            </div>
                                            <div class="file-name"></div>
                                        </div>
                                    </div>

                                    @error('file-act')
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
