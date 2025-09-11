@extends('layouts.cabinet')

@section('title', 'Создание нового суперадмина')

@section('content')

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-12">
                <div class="back-log">
                    <div class="back-link"><a class="btn-link btn-backlink" href="{{ route('cabinet.superuser.index') }}">Вернуться назад</a>
                    </div>

                </div>


                <div class="card-head-new"> Регистрация нового суперадмина</div>
                <div class="card-head-new-sub">Заполните данные, чтобы добавить суперадмина</div>



                @include('flash-messages')


            </div>
            <div class="col-12 col-md-8">

                <div class="request-card card auth-card">


                    <div class="card-content">
                        <form method="post" action="{{ route('cabinet.superuser.store') }}">

                            @csrf

                            <div class="row mb-3">


                                <div class="col-12">
                                    <div class="form-input">
                                        <label for="name" class="">Имя</label>
                                        <input id="name" type="text"
                                               class=" @error('name') is-invalid @enderror" name="name"
                                               value="{{ old('name') ?? '' }}">
                                    </div>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>



                            <div class="row mb-3">


                                <div class="col-12">
                                    <div class="form-input">
                                        <label for="name" class="">Email</label>
                                        <input id="email" type="email"
                                               class="form-control @error('email') is-invalid @enderror" name="email"
                                               value="{{ old('email') }}" autocomplete="email">
                                    </div>

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="row mb-3">


                                <div class="col-12">
                                    <div class="form-input">
                                        <label for="name" class="">Пароль</label>
                                        <input id="password" type="password"
                                               class="form-control @error('password') is-invalid @enderror" name="password"
                                               autocomplete="new-password">
                                    </div>

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="row mb-3">


                                <div class="col-12">
                                    <div class="form-input">
                                        <label for="name" class="">Подтверждение пароля</label>
                                        <input id="password-confirm" type="password" class="form-control"
                                               name="password_confirmation" autocomplete="new-password">
                                    </div>

                                    @error('password')
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
