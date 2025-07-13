@extends('layouts.cabinet')

@section('title', 'Создание нового пользователя')

@section('content')

    <div class="container">

        <div class="row justify-content-center">
            <div class="col-12">
                <div class="back-log">
                    <div class="back-link"><a class="btn-link btn-backlink"
                                              href="{{ route('cabinet.project.user.index', $project->id) }}">Вернуться
                            назад</a>
                    </div>
                </div>

                <div class="card-head-new"> Регистрация нового админа</div>
                <div class="card-head-new-sub">Заполните данные, чтобы добавить админа</div>

                @include('flash-messages')


            </div>
            <div class="col-12 col-md-8">

                <div class="request-card card auth-card">

                    <div class="card-content">
                        <form method="post" action="{{ route('cabinet.project.user.store', $project->id) }}">

                            @csrf

                            <div class="row mb-3">


                                <div class="col-12">
                                    <div class="form-input">
                                        <label for="name" class="">Имя</label>
                                        <input id="name" type="text"
                                               class=" @error('name') is-invalid @enderror" name="name"
                                               value="{{ old('name') ?? '' }} " autocomplete="off">
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
                                        <label for="email" class="">Email</label>
                                        <input id="email" type="email"
                                               class=" @error('email') is-invalid @enderror" name="email"
                                               value="{{ old('email') ?? '' }} " autocomplete="off">

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

                                    <div class="check-wrap">
                                        <label for="email" class="check-wrap-label">Роль</label>
                                        <div class="form-item checkselect checkselect-js checkselect-border onecheck">
                                            <label @if(old('user') == 'project_admin') class="js-active" @endif><input
                                                    style="display:none;" type="checkbox"
                                                    name="role" value="project_admin"
                                                    @if(old('user') == 'project_admin') checked @endif >{{ \App\Models\User::$roles['project_admin'] }}
                                            </label>
                                            <label @if(old('user') == 'project_user') class="js-active" @endif><input
                                                    style="display:none;" type="checkbox"
                                                    name="role" value="project_user"
                                                    @if(old('user') == 'project_user') checked @endif >{{ \App\Models\User::$roles['project_user'] }}
                                            </label>


                                        </div>
                                    </div>


                                    @error('role')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>



                            <div class="row mb-3">


                                <div class="col-12">
                                    <div class="form-input">
                                        <label for="password" class="">Пароль</label>
                                        <input id="password" type="password"
                                               class=" @error('password') is-invalid @enderror" name="password"
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
                                        <label for="password-confirm" class="">Подтверждение пароля</label>
                                        <input id="password-confirm" type="password" class="form-control"
                                               name="password_confirmation" autocomplete="new-password">
                                    </div>


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
