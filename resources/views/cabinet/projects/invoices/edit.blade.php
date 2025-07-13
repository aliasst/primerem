@extends('layouts.cabinet')

@section('title', 'Редактирование счета')

@section('content')

    <div class="container">

        <div class="row justify-content-center">


            <div class="col-12">
                <div class="back-log">
                    <div class="back-link"><a class="btn-link btn-backlink" href="{{ route('cabinet.project.invoice.index',  [$project->id]) }}">Вернуться назад</a>
                    </div>

                </div>


                <div class="card-head-new"> Редактирование счета</div>
                <div class="card-head-new-sub"></div>



                @include('flash-messages')


            </div>
            <div class="col-12 col-md-8">

                <div class="request-card card auth-card">


                    <div class="card-content">
                        <form method="post"
                              action="{{ route('cabinet.project.invoice.update',  [$project->id, $invoice->id]) }}"
                              enctype="multipart/form-data">
                            @method('put')
                            @csrf

                            <div class="row mb-3">


                                <div class="col-12">
                                    <div class="form-input">
                                        <label for="invoice_number" class="">Номер счета</label>
                                        <input id="invoice_number" type="text"
                                               class="form-control @error('invoice_number') is-invalid @enderror"
                                               name="invoice_number"
                                               value="{{ old('invoice_number') ?? $invoice->invoice_number }}">
                                    </div>

                                    @error('invoice_number')
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
                                            <label @if($invoice->status == 'status_1') class="js-active" @endif><input
                                                    style="display:none;" type="checkbox"
                                                    name="status" value="status_1"
                                                    @if($invoice->status == 'status_1') checked @endif >{{ \App\Models\Invoice::$statuses['status_1'] }}
                                            </label>
                                            <label @if($invoice->status == 'status_2') class="js-active" @endif><input
                                                    style="display:none;" type="checkbox"
                                                    name="status" value="status_2"
                                                    @if($invoice->status == 'status_2') checked @endif >{{ \App\Models\Invoice::$statuses['status_2'] }}
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
{{--                                <label for="status" class="col-md-4 col-form-label text-md-end">Счет</label>--}}

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

                                    @error('file-invoice')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="row mb-3">

                                {{--                                <label for="invoice_number" class="col-md-4 col-form-label text-md-end">Документ</label>--}}

                                <div class="col-12">
                                    <div class="files-main-wrap">
                                        <div class="file-form-wrap">

                                            <div class="file-upload my-btn">
                                                <label>
                                                    <input class="fl_inp " type="file" name="file-invoice">
                                                    <span>Добавить файл для замены</span>
                                                </label>
                                            </div>
                                            <div class="file-name"></div>
                                        </div>
                                    </div>

                                    @error('file-invoice')
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
                                <form action="{{ route('cabinet.project.invoice.destroy',  [$project->id, $invoice->id]) }}" method="POST"
                                      onsubmit="return confirm('Вы точно хотите удалить счет?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn-link" type="submit" onclick="">Удалить счет</button>
                                </form>

                            </div>
                        </div>


                    </div>
                </div>

            </div>

        </div>
    </div>

@endsection
