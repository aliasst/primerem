@extends('layouts.cabinet')

@section('title', 'Просмотр акта')

@section('content')

    <div class="container">

        <div class="row justify-content-center">


            <div class="col-12">
                <div class="back-log">
                    <div class="back-link"><a class="btn-link btn-backlink" href="{{ route('cabinet.project.act.index',  [$project->id]) }}">Вернуться назад</a>
                    </div>

                </div>


                <div class="card-head-new"> Просмотр акта</div>
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
                                        <label for="act_number" class="">Номер акта</label>
                                        <input id="act_number" type="text"
                                               class=""
                                               name="act_number"
                                               value="{{$act->act_number }}" disabled>
                                    </div>


                                </div>
                            </div>



                            <div class="row mb-3">


                                <div class="col-12">
                                    <div class="form-input">
                                        <label for="status" class="">Статус</label>
                                        <input id="status" type="text"
                                               class=""
                                               name="status"
                                               value="{{ \App\Models\Invoice::$statuses[$act->status] }}" disabled>
                                    </div>


                                </div>
                            </div>





                            <div class="row mb-3">

                                <div class="col-12">
                                    @if(!$files->isEmpty())
                                        <div class="uploaded-files">
{{--                                            <div class="uploaded-files-label">Ранее загруженный счет:</div>--}}
                                            <div class="uploaded-files-inner-wrap">
                                                @foreach($files as $file)
                                                    <div class="uploaded-file" id="{{$file->id}}">
                                                        <a style="text-decoration: underline" target="_blank"
                                                           href="{{ Storage::disk('public')->url($file->storage_path) }}">{{$file->name}}</a>
                                                    </div>

                                                @endforeach
                                            </div>

                                        </div>
                                    @endif
                                </div>
                            </div>







                        </form>



                    </div>
                </div>

            </div>

        </div>
    </div>

@endsection
