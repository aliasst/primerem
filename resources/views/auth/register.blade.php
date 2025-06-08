@extends('layouts.auth')

@section('title', 'Регистрация')

@section('content')
        <div class="container">
            <div class="row justify-content-center">

                <div class="col-12">
                    <div class="logo-cell"><a href="/">Prime<span>REM</span></a></div>
                </div>

                <div class="col-xs-12 col-md-8">
                    <div class="request-card card auth-card">
                        <div class="card-head">Регистрация</div>

                        <div class="card-content">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf



                                <div class="row mb-3">
                                    <label for="name" class="col-md-5 col-form-label text-md-end">Ваше имя</label>

                                    <div class="col-md-6">
                                        <input id="name" type="name"
                                               class="form-control @error('name') is-invalid @enderror" name="name"
                                               value="{{ old('name') }}" required >

                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="row mb-3">
                                    <label for="email" class="col-md-5 col-form-label text-md-end">Email</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email"
                                               class="form-control @error('email') is-invalid @enderror" name="email"
                                               value="{{ old('email') }}" required autocomplete="email">

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="password" class="col-md-5 col-form-label text-md-end">Пароль</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password"
                                               class="form-control @error('password') is-invalid @enderror"
                                               name="password" required autocomplete="new-password">

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label for="password-confirm" class="col-md-5 col-form-label text-md-end">Подтверждение
                                        пароля</label>

                                    <div class="col-md-6">
                                        <input id="password-confirm" type="password" class="form-control"
                                               name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6 offset-md-5">
                                        <button type="submit" class="orange-btn orange-btn-min">
                                            {{ __('Отправить') }}
                                        </button>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-5"></div>

                                    <div class="col-md-6">
                                        @if (Route::has('register'))
                                            <div class="register-link">
                                                Уже есть аккаунт?
                                                <a class=" btn-link" href="{{ route('login.form') }}">
                                                    {{ __('Войти') }}
                                                </a>
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
