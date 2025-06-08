@extends('layouts.cabinet')

@section('title', 'Создание нового пользователя')

@section('content')

    <div class="container">

        <div class="row justify-content-center">
            <div class="col-12">
                <div class="back-log">
                    <div class="back-link"><a class="btn-link btn-backlink" href="{{ route('cabinet.project.user.index', $project->id) }}">Назад</a>
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
                    <div class="card-head"> Cоздание  нового пользователя</div>

                    <div class="card-content">
                        <form method="post" action="{{ route('cabinet.project.user.store', $project->id) }}">

                            @csrf


                            <div class="row mb-3">
                                <label for="name" class="col-md-5 col-form-label text-md-end">Имя</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                           class="form-control @error('name') is-invalid @enderror" name="name"
                                           value="{{ old('name') ?? '' }}">

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
                                           value="{{ old('email') }}" autocomplete="email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="row mb-3">

                                <label for="password" class="col-md-5 col-form-label text-md-end">Роль</label>
                                <div class="col-md-6">
                                    <div class="form-item checkselect checkselect-js checkselect-border onecheck">
                                        <label @if(old('user') == 'project_admin') class="js-active" @endif><input
                                                style="display:none;" type="checkbox"
                                                name="role" value="project_admin"
                                                @if(old('user') == 'project_admin') checked @endif >{{ \App\Models\User::$roles['project_admin'] }}</label>
                                        <label @if(old('user') == 'project_user') class="js-active" @endif><input
                                                style="display:none;" type="checkbox"
                                                name="role" value="project_user"
                                                @if(old('user') == 'project_user') checked @endif >{{ \App\Models\User::$roles['project_user'] }}</label>


                                    </div>
                                </div>

                            </div>

                            <div class="row mb-3">
                                <label for="password" class="col-md-5 col-form-label text-md-end">Пароль</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                           class="form-control @error('password') is-invalid @enderror" name="password"
                                           autocomplete="new-password">

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
                                           name="password_confirmation" autocomplete="new-password">
                                </div>
                            </div>



                            <div class="row mb-2">
                                <div class="col-md-6 offset-md-5">
                                    <button type="submit" class="orange-btn orange-btn-min">
                                        {{ __('Сохранить') }}
                                    </button>
                                </div>
                            </div>

                        </form>


                    </div>
                </div>

            </div>

        </div>
    </div>

@endsection
