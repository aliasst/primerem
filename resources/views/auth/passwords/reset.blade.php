@extends('layouts.auth')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <div class="card-head-new">Сбросить Пароль</div>
            <div class="card-head-new-sub">Введите новый пароль</div>

            @include('flash-messages')

            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <div class="col-xs-12 col-md-8">
                <div class="request-card card auth-card">

                    <div class="card-content">
                            <form method="POST" action="{{ route('password.update') }}">
                                @csrf

                                <input type="hidden" name="token" value="{{ $token }}">


                                <div class="row mb-3">


                                    <div class="col-12">
                                        <div class="form-input">
                                            <label for="email" class="">Email</label>
                                            <input id="email" type="email"
                                                   class="form-control @error('email') is-invalid @enderror" name="email"
                                                   value="{{ $email ?? old('email') }}" required autocomplete="email"
                                                   autofocus>

                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>



                                <div class="row mb-3">


                                    <div class="col-12">
                                        <div class="form-input">
                                            <label for="password" class="">Новый пароль</label>
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
                                </div>



                                <div class="row mb-3">


                                    <div class="col-12">
                                        <div class="form-input">
                                            <label for="password-confirm" class="">Подтверждение пароля</label>
                                            <input id="password-confirm" type="password" class="form-control"
                                                   name="password_confirmation" required autocomplete="new-password">
                                        </div>
                                    </div>
                                </div>




                                <div class="row">
                                    <div class="col-12">
                                        <div class="btn-row btn-row-center">
                                            <button type="submit" class="orange-btn orange-btn-min">
                                                {{ __('Отправить') }}
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
