@extends('layouts.auth')

@section('title', 'Вход в Личный кабинет')

@section('content')
    <section class="main">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="request-card card auth-card">
                        <div class="card-head">Регистрация</div>

                        <div class="card-content">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                {{--                        <div class="row mb-3">--}}
                                {{--                            <label for="name" class="col-md-4 col-form-label text-md-end">Имя</label>--}}

                                {{--                            <div class="col-md-6">--}}
                                {{--                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>--}}

                                {{--                                @error('name')--}}
                                {{--                                    <span class="invalid-feedback" role="alert">--}}
                                {{--                                        <strong>{{ $message }}</strong>--}}
                                {{--                                    </span>--}}
                                {{--                                @enderror--}}
                                {{--                            </div>--}}
                                {{--                        </div>--}}


                                <div class="row mb-3">
                                    <label for="name" class="col-md-4 col-form-label text-md-end">Ваше имя</label>

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
                                    <label for="email" class="col-md-4 col-form-label text-md-end">Email</label>

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
                                    <label for="password" class="col-md-4 col-form-label text-md-end">Пароль</label>

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
                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-end">Подтверждение
                                        пароля</label>

                                    <div class="col-md-6">
                                        <input id="password-confirm" type="password" class="form-control"
                                               name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                </div>

                                <div class="row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="orange-btn orange-btn-min">
                                            {{ __('Отправить') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
