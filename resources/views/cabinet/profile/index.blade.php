@extends('layouts.cabinet')

@section('title', 'Редактирование суперадмина')

@section('content')

    <div class="container">

        <div class="row justify-content-center">



            <div class="col-12">
                <div class="back-log">
{{--                    <div class="back-link"><a class="btn-link btn-backlink" href="{{ route('cabinet.superuser.index') }}">Вернуться назад</a>--}}
{{--                    </div>--}}
                </div>
                <div class="card-head-new"> Профиль пользователя {{$user->name }}</div>
                <div class="card-head-new-sub"></div>

                @include('flash-messages')


            </div>
            <div class="col-12 col-md-8">

                <div class="request-card card auth-card">
                    <div class="card-content">
                        <form method="post"
                              action="{{ route('cabinet.profile.update', $user->id) }}"
                              enctype="multipart/form-data"
                        >
                            @method('put')
                            @csrf

                            <div class="row mb-3">


                                <div class="col-12">
                                    <div class="form-input">
                                        <label for="name" class="">Имя</label>
                                        <input id="name" type="text"
                                               class=" @error('name') is-invalid @enderror" name="name"
                                               value="{{ old('name') ?? $user->name }}">
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
                                               class=" @error('email') is-invalid @enderror"
                                               name="email"
                                               value="{{ old('email') ?? $user->email }}" autocomplete="email">
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
                                        <label for="password" class="">Новый Пароль</label>
                                        <input id="password" type="password"
                                               class=" @error('password') is-invalid @enderror"
                                               name="password"
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
                                        <input id="password-confirm" type="password" class=""
                                               name="password_confirmation" autocomplete="new-password">
                                    </div>


                                </div>
                            </div>


                            <div class="row mb-5">
                                <label for="avatar" class="col-12 col-form-label text-md-end"></label>

                                <div class="col-md-6">
                                    <div class="files-main-wrap">
                                        <div class="file-form-wrap">

                                            <div class="file-upload my-btn">
                                                <label>
                                                    <input class="fl_inp " type="file" name="avatar">
                                                    <span>Добавить или изменить аватарку</span>
                                                </label>
                                            </div>
                                            <div class="file-name"></div>
                                        </div>
                                    </div>

                                    @error('avatar')
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
