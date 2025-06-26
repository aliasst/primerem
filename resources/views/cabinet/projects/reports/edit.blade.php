@extends('layouts.cabinet')

@section('title', 'Редактирование отчеты')

@section('content')

    <div class="container">

        <div class="row justify-content-center">


            <div class="col-12">
                <div class="back-log">
                    <div class="back-link"><a class="btn-link btn-backlink" href="{{ route('cabinet.project.report.index',  [$project->id]) }}">Назад</a>
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
                    <div class="card-head"> Редактирование отчета</div>

                    <div class="card-content">
                        <form method="post"
                              action="{{ route('cabinet.project.report.update',  [$project->id, $stage->id]) }}"
                              enctype="multipart/form-data">
                            @method('put')
                            @csrf


                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">Название этапа</label>

                                <div class="col-md-6">
                                    <input id="title" type="text"
                                           class="form-control"
                                           name="title"
                                           value="{{ $stage->title }}"
                                           disabled
                                    >

                                </div>
                            </div>


                            <div class="row mb-3">
                                <label for="status" class="col-md-4 col-form-label text-md-end">Статус</label>

                                <div class="col-md-6">
                                    <input id="status" type="text"
                                           class="form-control"
                                           name="status"
                                           value="{{ \App\Models\Stage::$statuses[$stage->status] ?? '' }}"
                                           disabled
                                    >

                                </div>
                            </div>


                            <div class="row mb-3">
                                <label for="start_date" class="col-md-4 col-form-label text-md-end">Дата старта</label>

                                <div class="col-md-6">
                                    <input id="start_date" type="text"
                                           class="form-control"
                                           name="start_date"
                                           value="{{  $stage->start_date ? $stage->start_date->format('d.m.Y') : '' }}"
                                           disabled
                                    >

                                </div>
                            </div>


                            <div class="row mb-3">
                                <label for="status" class="col-md-4 col-form-label text-md-end">Дата завершения</label>

                                <div class="col-md-6">
                                    <input id="status" type="text"
                                           class="form-control"
                                           name="status"
                                           value="{{  $stage->finish_date ? $stage->finish_date->format('d.m.Y') : '' }}"
                                           disabled
                                    >

                                </div>
                            </div>












                            <div class="row mb-3">
                                <label for="comments" class="col-md-4 col-form-label text-md-end">Комментарии</label>

                                <div class="col-md-6">
                                    <textarea name="comments" id="comments"
                                              class="form-control @error('comments') is-invalid @enderror" cols="30"
                                              rows="6">{{ old('comments') ?? $stage->comments }}</textarea>

                                    @error('comments')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="row mb-3">
                                <label for="status" class="col-md-4 col-form-label text-md-end">Файлы отчета</label>

                                <div class="col-md-6">
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

                                    @error('file-invoice')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="row mb-3">
                                <div class="col-md-4"></div>
                                {{--                                <label for="invoice_number" class="col-md-4 col-form-label text-md-end">Документ</label>--}}

                                <div class="col-md-6">
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
