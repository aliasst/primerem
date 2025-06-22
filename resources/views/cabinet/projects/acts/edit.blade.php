@extends('layouts.cabinet')

@section('title', 'Редактирование акта')

@section('content')

    <div class="container">

        <div class="row justify-content-center">


            <div class="col-12">
                <div class="back-log">
                    <div class="back-link"><a class="btn-link btn-backlink" href="{{ route('cabinet.project.invoice.index',  [$project->id]) }}">Назад</a>
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
                    <div class="card-head"> Редактирование счета</div>

                    <div class="card-content">
                        <form method="post"
                              action="{{ route('cabinet.project.act.update',  [$project->id, $act->id]) }}"
                              enctype="multipart/form-data">
                            @method('put')
                            @csrf


                            <div class="row mb-3">
                                <label for="act_number" class="col-md-4 col-form-label text-md-end">Номер счета</label>

                                <div class="col-md-6">
                                    <input id="act_number" type="text"
                                           class="form-control @error('act_number') is-invalid @enderror"
                                           name="act_number"
                                           value="{{ old('act_number') ?? $act->act_number }}">

                                    @error('act_number')
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="row mb-3">

                                <label for="status" class="col-md-4 col-form-label text-md-end">Статус</label>
                                <div class="col-md-6">
                                    <div class="form-item checkselect checkselect-js checkselect-border onecheck">
                                        <label @if($act->status == 'status_1') class="js-active" @endif><input
                                                style="display:none;" type="checkbox"
                                                name="status" value="status_1"
                                                @if($act->status == 'status_1') checked @endif >{{ \App\Models\Act::$statuses['status_1'] }}
                                        </label>
                                        <label @if($act->status == 'status_2') class="js-active" @endif><input
                                                style="display:none;" type="checkbox"
                                                name="status" value="status_2"
                                                @if($act->status == 'status_2') checked @endif >{{ \App\Models\Act::$statuses['status_2'] }}
                                        </label>
                                        <label @if($act->status == 'status_3') class="js-active" @endif><input
                                                style="display:none;" type="checkbox"
                                                name="status" value="status_3"
                                                @if($act->status == 'status_3') checked @endif >{{ \App\Models\Act::$statuses['status_2'] }}
                                        </label>


                                    </div>
                                </div>

                            </div>


                            <div class="row mb-3">
                                <label for="status" class="col-md-4 col-form-label text-md-end">Акт</label>

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
                                                    <input class="fl_inp " type="file" name="file-act">
                                                    <span>Добавить файл для замены</span>
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
                                <form action="{{ route('cabinet.project.act.destroy',  [$project->id, $act->id]) }}" method="POST"
                                      onsubmit="return confirm('Вы точно хотите удалить акт?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn-link" type="submit" onclick="">Удалить акт</button>
                                </form>

                            </div>
                        </div>


                    </div>
                </div>

            </div>

        </div>
    </div>

@endsection
