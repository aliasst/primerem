@extends('layouts.auth')

@section('title', 'Регистрация')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <div class="card-head-new">Регистрация личного кабинета</div>
            <div class="card-head-new-sub">Заполните данные, чтобы зарегистрировать аккаунт</div>


            <div class="col-xs-12 col-md-8">
                <div class="request-card card auth-card">
                    <div class="card-content">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('register') }}">


                            @csrf

                            <div class="row mb-3">


                                <div class="col-12">
                                    <div class="form-input">
                                        <label for="name" class="">Ваше имя *</label>
                                        <input id="name" type="text"
                                               class=" @error('name') is-invalid @enderror"
                                               name="name"
                                               value="{{ old('name') }}" required>
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
                                        <label for="email" class="">Email *</label>
                                        <input id="email" type="email"
                                               class=" @error('email') is-invalid @enderror"
                                               name="email"
                                               value="{{ old('email') }}" required autocomplete="email" autofocus>
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
                                        <label for="password" class="">Пароль *</label>
                                        <input id="password" type="password"
                                               class="form-control @error('password') is-invalid @enderror"
                                               name="password" required autocomplete="current-password">
                                    </div>

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                                                    <span>{{ $message }}</span>
                                                                </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="row mb-3">


                                <div class="col-12">
                                    <div class="form-input">
                                        <label for="password-confirm" class="">Подтверждение пароля *</label>
                                        <input id="password-confirm" type="password"
                                               class="form-control"
                                               name="password_confirmation" required autocomplete="">
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">


                                <div class="col-12">
                                    <div class="form-input">
                                        <label class="docs-send_popup-checkbox">
                                            <input type="checkbox" class="docs-send_popup-checkbox-input" checked>
                                            <span class="docs-send_popup-checkbox-text">
               Я ознакомлен(а) и соглашаюсь с <a href="/" target="_blank">Политикой конфиденциальности</a>.
               </span>
                                        </label>
                                    </div>
                                </div>
                            </div>


                            <div class="row mb-3">
                                <div class="col-12">
                                    <div class="btn-row btn-row-center">
                                        <button type="submit" class="orange-btn orange-btn-min">
                                            {{ __('Зарегистрироваться') }}
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
