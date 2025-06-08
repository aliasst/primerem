@extends('layouts.auth')

@section('title', 'Вход в Личный кабинет')

@section('content')
        <div class="container">
            <div class="row justify-content-center">

                <div class="col-12">
                    <div class="logo-cell"><a href="/">Prime<span>REM</span></a></div>
                </div>

                <div class="col-xs-12 col-md-7">
                    <div class="request-card card auth-card">
                        <div class="card-head ">Вход в личный кабинет</div>

                        <div class="card-content">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <form method="POST" action="{{ route('login') }}">


                                @csrf

                                <div class="row mb-3">
                                    <label for="email" class="col-md-3 col-form-label text-md-end">Email</label>

                                    <div class="col-md-8">
                                        <input id="email" type="email"
                                               class="form-control @error('email') is-invalid @enderror"
                                               name="email"
                                               value="{{ old('email') }}" required autocomplete="email" autofocus>

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                        <span>{{ $message }}</span>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="password" class="col-md-3 col-form-label text-md-end">Пароль</label>

                                    <div class="col-md-8">
                                        <input id="password" type="password"
                                               class="form-control @error('password') is-invalid @enderror"
                                               name="password" required autocomplete="current-password">

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                        <span>{{ $message }}</span>
                                    </span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="row mb-3">
                                    <div class="col-md-3"></div>

                                    <div class="col-md-8">
                                        <button type="submit" class="orange-btn orange-btn-min">
                                            {{ __('Войти') }}
                                        </button>
                                    </div>
                                </div>


                                <div class="row mb-3">
                                    <div class="col-md-3"></div>

                                    <div class="col-md-8">
                                        @if (Route::has('register'))
                                            <div class="register-link">
                                                Нет аккаунта?
                                                <a class=" btn-link" href="{{ route('register.form') }}">
                                                    {{ __('Зарегистироваться') }}
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
