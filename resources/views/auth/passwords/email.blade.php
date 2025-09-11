@extends('layouts.auth')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <div class="card-head-new">Восстановить Пароль</div>
            <div class="card-head-new-sub">Введите email, чтобы восстановить пароль</div>

            @include('flash-messages')

            <div class="col-xs-12 col-md-8">
                    <div class="request-card card auth-card">

                        <div class="card-content">

                            @if (session('status'))
                            <div class="alert alert-success mb-2" role="alert">
                                {{ session('status') }}
                            </div>
                            @endif

                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf

                                <div class="row mb-3">


                                    <div class="col-12">
                                        <div class="form-input">
                                            <label for="email" class="">Email *</label>
                                            <input id="email" type="email"
                                                   class="form-control @error('email') is-invalid @enderror" name="email"
                                                   value="{{ old('email') }}" required autocomplete="email" autofocus>

                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                    </div>
                                </div>
                                </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="btn-row btn-row-center">
                                                <button type="submit" class="orange-btn orange-btn-min">
                                                    {{ __('Восстановить') }}
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
