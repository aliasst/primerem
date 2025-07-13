@extends('layouts.cabinet')

@section('title', 'Просмотр и редактирование проекта')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">

                <div class="back-log">
                    <div class="back-link"><a class="btn-link btn-backlink" href="{{ route('cabinet.project.index') }}">Вернуться назад</a>
                    </div>
                </div>


                <div class="card-head-new"> Редактирование проекта</div>
                <div class="card-head-new-sub"></div>

                @include('flash-messages')


            </div>
            <div class="col-12 col-md-8">

                <div class="request-card card auth-card">

                    <div class="card-content">
                        <form method="post" action="{{ route('cabinet.project.update', [$project->id] ) }}">
                            @method('put')
                            @csrf

                            <div class="row mb-3">


                                <div class="col-12">
                                    <div class="form-input">
                                        <label for="name" class="">Название проекта *</label>
                                        <input id="name" type="text"
                                               class="form-control @error('name') is-invalid @enderror" name="name"
                                               value="{{ old('name') ?? $project->name }}">
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
                                        <label for="organization" class="">Юр. лицо *</label>
                                        <input id="organization" type="text"
                                               class="form-control @error('organization') is-invalid @enderror"
                                               name="organization"
                                               value="{{ old('organization') ?? $project->organization }}">
                                    </div>

                                    @error('organization')
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
                                               class="form-control @error('email') is-invalid @enderror" name="email"
                                               value="{{ old('email') ?? $project->email }}" autocomplete="email">

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
                                        <label for="phone" class="">Телефон *</label>
                                        <input id="phone" type="tel"
                                               class="form-control @error('phone') is-invalid @enderror" name="phone"
                                               value="{{ old('phone') ?? $project->phone }}" autocomplete="phone">

                                    </div>

                                    @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <span>{{ $message }}</span>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="row mb-3">


                                <div class="col-12">
                                    <div class="form-input">
                                        <label for="details" class="">Реквизиты</label>
                                        <textarea name="details" id="details"
                                                  class="form-control @error('details') is-invalid @enderror" cols="30"
                                                  rows="6">{{ old('details') ?? $project->details }}</textarea>

                                    </div>

                                    @error('details')
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

                        <div class="row mb-3">
                            <div class="col-12 text-center">
                                <form action="{{ route('cabinet.project.destroy', $project->id) }}" method="POST"
                                      onsubmit="return confirm('Вы точно хотите удалить проект?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn-link" type="submit" onclick="">Удалить проект</button>
                                </form>

                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-12 text-center">
                                <a href="{{route('cabinet.project.copy', $project->id)}}" class="btn-link">Копировать
                                    проект (полностью)</a><br>
                                <a href="{{route('cabinet.project.copystages', $project->id)}}" class="btn-link">Копировать
                                    проект (только этапы)</a>


                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

@endsection
