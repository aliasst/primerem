@extends('layouts.cabinet')

@section('title', 'Список пользователей проекта')

@section('content')

    <div class="container">
        <div class="row">

            <div class="col-12">
                <div class="back-log">
                    <div class="back-link"><a class="btn-link btn-backlink" href="{{ route('cabinet.project.index') }}">Назад</a>
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
                    <h2>Список пользователей проекта {{$project->name}}</h2>
                </div>

                @include('flash-messages')
            </div>
            <div class="col-12">
                <div class="request-list-wrap request-list-wrap_1 mb-5">


                    @if(empty($users->count()))

                        {{--                            <h3 class="text-center mt-4">Заявок нет</h3>--}}
                    @else

                        <table class="requests">
                            <thead>
                            <tr>
                                <th>Имя</th>
                                <th>Дата создания</th>
                                <th>Роль</th>
                                <th>E-mail</th>
                                <th>Активность</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($users as  $user)

                                <tr class="">
                                    <td aria-label="Имя"><a style="white-space: nowrap" class="btn-link"
                                                                        href="{{route ('cabinet.project.user.edit', [$project->id, $user->id])}}">{{ $user->name}}</a>
                                    </td>
                                    <td aria-label="Дата создания">{{ $user->created_at->format('d.m.Y') }}</td>
                                    <td aria-label="Роль">
                                        {{ \App\Models\User::$roles[$user->role] }}
                                    </td>
                                    <td aria-label="E-mail">{{ $user->email }}</td>


                                    <td aria-label="Активность">{{ \App\Models\User::$statuses[$user->status]  }}</td>


                                </tr>

                            @endforeach
                            </tbody>

                        </table>

                    @endif


                </div>


                <div class="text-center">
                    <a href="{{route('cabinet.project.user.create', $project->id)}}"
                       class="btn orange-btn orange-btn-min orange-btn-center">
                        Добавить пользователя
                    </a>
                </div>

            </div>

        </div>
    </div>

@endsection
