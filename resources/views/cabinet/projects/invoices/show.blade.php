@extends('layouts.cabinet')

@section('title', 'Просмотр счета')

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
                    <div class="card-head">Просмотр счета</div>

                    <div class="card-content">
                        <form method="post"
                              action=""
                              enctype="">
                            @csrf


                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">Номер счета</label>

                                <div class="col-md-6">
                                    <input id="invoice_number" type="text"
                                           class="form-control"
                                           name="invoice_number"
                                           value="{{$invoice->invoice_number }}" disabled>
                                </div>
                            </div>


                            <div class="row mb-3">

                                <label for="status" class="col-md-4 col-form-label text-md-end">Статус</label>
                                <div class="col-md-6">
                                    <input id="status" type="text"
                                           class="form-control"
                                           name="status"
                                           value="{{ \App\Models\Invoice::$statuses[$invoice->status] }}" disabled>
                                </div>

                            </div>


                            <div class="row mb-3">
                                <label for="status" class="col-md-4 col-form-label text-md-end">Счет</label>

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
                                </div>
                            </div>







                        </form>



                    </div>
                </div>

            </div>

        </div>
    </div>

@endsection
