@extends('layouts.auth')

@section('title', 'Вход в Личный кабинет')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <div class="card-head-new">Вход в личный кабинет</div>
            <div class="card-head-new-sub">Заполните данные, чтобы попасть в личный кабинет</div>


            <div class="col-xs-12 col-md-8">
                <div class="request-card card auth-card">
                    <div class="card-content">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('login') }}">


                            @csrf


                            <div class="row mb-3">


                                <div class="col-12">
                                    <div class="form-input">
                                    <label for="email" class="">Email *</label>
                                    <input id="email" type="email"
                                           class=" @error('email') is-invalid @enderror"
                                           name="email"
                                           value="{{ old('email') }}" required autocomplete="off" autofocus>
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
                                        <label for="email" class="">Пароль *</label>
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




                            <div class="row mb-4">
                                <div class="col-12">
                                    <div class="btn-row btn-row-login">
                                        <button type="submit" class="orange-btn orange-btn-min">
                                            {{ __('Войти') }}
                                        </button>

                                        @if (Route::has('register'))
                                                <a class="black-link" href="{{ route('register.form') }}">
                                                    {{ __('Зарегистироваться') }}
                                                </a>

                                        @endif

                                    </div>




                                </div>
                            </div>


                            <div class="row">
                            <div class="col-12 " style="">
                                <div style="" class="forget-link text-center">
                                    <a class="btn-link" href="{{ route('password.request') }}">
                                        Забыли пароль?
                                    </a>
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
