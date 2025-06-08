@extends('layouts.cabinet')

@section('title', 'Список проектов')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">

                <div class="back-log">
                    <div class="back-link"><a class="btn-link btn-backlink" href="{{ route('cabinet.dashboard') }}">Назад</a>
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
                    <div class="logo-cell">Prime<span>REM</span></div>
                    <h2>Список всех проектов</h2>
                </div>

                @include('flash-messages')

            </div>
            <div class="col-12">

                <div class="request-list-wrap request-list-wrap_1 mb-5">


                    @if(empty($projects->count()))

                        <h3 class="text-center mt-4">Проектов нет</h3>
                    @else

                        <table class="requests">
                            <thead>
                            <tr>
                                <th>Название или id</th>
                                <th>Дата создания</th>
                                <th>Активность</th>
                                <th>Пользователи</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($projects as  $project)

                                <tr class="">
                                    <td aria-label="Название или id"><a style="white-space: nowrap" class="btn-link"
                                                                        href="{{route ('cabinet.project.edit', $project->id)}}">{{ $project->name  ??  $project->id}}</a>
                                    </td>
                                    <td aria-label="Дата создания">{{ $project->created_at->format('d.m.Y') }}</td>
                                    <td aria-label="Активность">{{ \App\Models\Project::$statuses[$project->status]  }}</td>
                                    <td aria-label="Пользователи">
                                        <a class="btn-link"
                                           href="{{route ('cabinet.project.user.index', $project->id)}}">Смотреть</a>
                                    </td>


                                </tr>

                            @endforeach
                            </tbody>

                        </table>

                    @endif


                </div>


                <div class="text-center">
                    <a href="{{route('cabinet.project.create')}}"
                       class="btn orange-btn orange-btn-min orange-btn-center">
                        Добавить проект
                    </a>
                </div>

            </div>

        </div>
    </div>

@endsection
