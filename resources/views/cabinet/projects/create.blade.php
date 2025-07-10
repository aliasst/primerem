@extends('layouts.cabinet')

@section('title', 'Создание нового проекта')

@section('content')

    <div class="container">

        <div class="row justify-content-center">



            <div class="col-12">

                <div class="back-log">
                    <div class="back-link"><a class="btn-link btn-backlink" href="{{ route('cabinet.project.index') }}">Назад</a>
                    </div>
                </div>

                <div class="card-head-new"> Cоздание  нового проекта</div>
                <div class="card-head-new-sub">Заполните данные, чтобы добавить новый проект</div>


                @include('flash-messages')


            </div>
            <div class="col-12 col-md-8">

                <div class="request-card card auth-card">
                    <div class="card-content">
                        <form method="post" action="{{ route('cabinet.project.store') }}">

                            @csrf

                            <div class="row mb-3">


                                <div class="col-12">
                                    <div class="form-input">
                                        <label for="name" class="">Название проекта *</label>
                                        <input id="name" type="text"
                                               class=" @error('name') is-invalid @enderror"
                                               name="name"
                                               value="{{ old('name') }}" required autocomplete="off" autofocus>
                                    </div>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <span>{{ $message }}</span>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">


                                <div class="col-12">
                                    <div class="form-input">
                                        <label for="organization" class="">Юр. лицо *</label>
                                        <input id="organization" type="text"
                                               class=" @error('organization') is-invalid @enderror"
                                               name="organization"
                                               value="{{ old('organization') }}" required autocomplete="off" >
                                    </div>

                                    @error('organization')
                                    <span class="invalid-feedback" role="alert">
                                        <span>{{ $message }}</span>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="row mb-3">


                                <div class="col-12">
                                    <div class="form-input">
                                        <label for="email" class="">Email *</label>
                                        <input id="email" type="email"
                                               class=" @error('email') is-invalid @enderror"
                                               name="email"
                                               value="{{ old('email') }}" required autocomplete="off" >
                                    </div>

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <span>{{ $message }}</span>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="row mb-3">


                                <div class="col-12">
                                    <div class="form-input">
                                        <label for="phone" class="">Телефон *</label>
                                        <input id="phone" type="tel"
                                               class=" @error('phone') is-invalid @enderror"
                                               name="phone"
                                               value="{{ old('phone') }}" required autocomplete="off" >
                                    </div>

                                    @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <span>{{ $message }}</span>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="row mb-3">


                                <div class="col-12">
                                    <div class="form-input">
                                        <label for="details" class="">Реквизиты</label>
                                        <textarea name="details" id="details"
                                                  class=" @error('details') is-invalid @enderror" cols="30"
                                                  rows="6">{{ old('details') ?? '' }}</textarea>
                                    </div>

                                    @error('details')
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
                                            {{ __('Добавить') }}
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
