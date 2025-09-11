@extends('layouts.cabinet')

@section('title', 'Редактирование этапа')

@section('content')

    <div class="container">

        <div class="row justify-content-center">


            <div class="col-12">
                <div class="back-log">
                    <div class="back-link"><a class="btn-link btn-backlink"
                                              href="{{ route('cabinet.project.stage.index',  [$project->id]) }}">Вернуться
                            назад</a>
                    </div>

                </div>


                <div class="card-head-new"> Редактирование этапа</div>
                <div class="card-head-new-sub">Отредактируйте данные, чтобы изменить этап</div>


                @include('flash-messages')


            </div>
            <div class="col-12 col-md-8">

                <div class="request-card card auth-card">


                    <div class="card-content">
                        <form method="post"
                              action="{{ route('cabinet.project.stage.update',  [$project->id, $stage->id]) }}"
                              enctype="multipart/form-data">
                            @method('put')
                            @csrf


                            <div class="row mb-3">


                                <div class="col-12">
                                    <div class="form-input">
                                        <label for="title" class="">Название этапа</label>
                                        <input id="title" type="text"
                                               class="form-control @error('title') is-invalid @enderror"
                                               name="title"
                                               value="{{ old('title') ?? $stage->title }}">
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
                                        <label for="status" class="check-wrap-label">Статус</label>
                                        <div class="form-item checkselect checkselect-js checkselect-border onecheck">
                                            {{--                                        <label @if($stage->status == 'status_0') class="js-active" @endif><input--}}
                                            {{--                                                style="display:none;" type="checkbox"--}}
                                            {{--                                                name="status" value="status_0"--}}
                                            {{--                                                @if($stage->status == 'status_0') checked @endif >{{ \App\Models\Stage::$statuses['status_0'] }}--}}
                                            {{--                                        </label>--}}
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


                                    @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="row mb-3">


                                <div class="col-12">
                                    <div class="form-input">
                                        <label for="start_date" class="">Дата старта</label>
                                        <input id="start_date" type="text"
                                               class="datepicker form-control date-input @error('start_date') is-invalid @enderror"
                                               name="start_date"
                                               value="{{  $stage->start_date ? $stage->start_date->format('d.m.Y') : '' }}"

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
                                        <label for="finish_date" class="">Дата завершения</label>
                                        <input id="finish_date" type="text"
                                               class="datepicker form-control date-input @error('finish_date') is-invalid @enderror"
                                               name="finish_date"
                                               value="{{  $stage->finish_date ? $stage->finish_date->format('d.m.Y') : '' }}"

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
                                    <div class="form-input">
                                        <label for="comments" class="">Комментарии</label>
                                        <textarea name="comments" id="comments"
                                                  class="form-control @error('comments') is-invalid @enderror" cols="30"
                                                  rows="6">{{ old('comments') ?? $stage->comments }}</textarea>
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
                                    @if(!$files->isEmpty())
                                        <div class="uploaded-files">
                                            {{--                                            <div class="uploaded-files-label">Ранее загруженный счет:</div>--}}
                                            <div class="uploaded-files-inner-wrap img-upload-row">
                                                @foreach($files as $file)

                                                        @if(in_array($file->extension, ['jpg', 'jpeg', 'png'])  )

                                                        <div class="uploaded-file uploaded-img" id="{{$file->id}}">
                                                        <a       class="uploaded-img-link"
                                                                data-fancybox="gallery"
                                                                data-src="{{ Storage::disk('public')->url($file->storage_path) }}"
                                                                data-caption=""
                                                            >
                                                                <img
                                                                    src="{{ Storage::disk('public')->url($file->storage_path) }}"
                                                                    width="100" alt=""/>
                                                            </a>
                                                            <div> <a class="btn-link js-delete-stage-file" href="#" data-id="{{$file->id}}">Удалить</a></div>


                                                        </div>
                                                        @endif
                                                @endforeach
                                            </div>

                                            <div class="uploaded-files-inner-wrap doc-upload-row">

                                                    @foreach($files as $file)

                                                        @if(!in_array($file->extension, ['jpg', 'jpeg', 'png'])  )
                                                            <div class="uploaded-file" id="{{$file->id}}">
                                                                <a style="text-decoration: underline" target="_blank"--}}
                                                                   href="{{ Storage::disk('public')->url($file->storage_path) }}">{{$file->name}}</a> (<a class="btn-link js-delete-stage-file" href="#" data-id="{{$file->id}}">Удалить</a>)
                                                            </div>
                                                        @else

                                                        @endif
                                                    @endforeach

                                            </div>

                                        </div>
                                    @endif

                                    @error('file-invoice')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="row mb-3">

                                <div class="col-12">
                                    <div class="files-main-wrap">
                                        <div class="file-form-wrap">

                                            <div class="file-upload my-btn">
                                                <label>
                                                    <input class="fl_inp fl_inp_multi" type="file" name="file-stage[]">
                                                    <span>Добавить файл</span>
                                                </label>
                                            </div>
                                            <div class="file-name"></div>
                                        </div>
                                    </div>

                                    @error('file-stage')
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
                                <form action="{{ route('cabinet.project.stage.destroy',  [$project->id, $stage->id]) }}"
                                      method="POST"
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
