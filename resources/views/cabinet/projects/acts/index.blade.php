@extends('layouts.cabinet')

@section('title', 'Список актов')

@section('content')

    <div class="container">
        <div class="row">




            <div class="col-12">
                <div class="back-log">
                    <div class="back-link"><a class="btn-link btn-backlink" href="{{route('cabinet.project.show', $project->id)}}">Назад</a>
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
                    <div class="progress-cell">Статус Ремонта: {{$project->progress}}%</div>
                    <h2>Список актов проекта {{$project->name}}</h2>
                </div>

                @include('flash-messages')
            </div>
            <div class="col-12">
                <div class="request-list-wrap request-list-wrap_1 mb-5">


                    @if(empty($acts->count()))

                       <h3 class="text-center mt-4">Актов нет</h3>
                    @else

                        <table class="requests">
                            <thead>
                            <tr>
                                <th>Номер акта</th>
                                <th>Дата добавления</th>
                                <th>Статус</th>
                                <th>Ссылка</th>
                                <th>Действия</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($acts as  $act)

                                <tr class="">
                                    <td aria-label="Номер счета"><a style="white-space: nowrap" class="btn-link"
                                                                        href="{{route ('cabinet.project.invoice.edit', [$project->id, $act->id])}}">{{ $act->act_number}}</a>
                                    </td>
                                    <td aria-label="Дата создания">{{ $act->created_at->format('d.m.Y') }}</td>
                                    <td aria-label="Статус">
                                        {{ \App\Models\Act::$statuses[$act->status] }}
                                    </td>
                                    <td aria-label="Ссылка">
{{--                                        @if(empty($act->files->count()))--}}
                                        @foreach($act->files as $file)
                                            <a style="text-decoration: underline" target="_blank"
                                               href="{{ Storage::disk('public')->url($file->storage_path) }}">Скачать</a>
                                        @endforeach
{{--                                        @endif--}}
                                    </td>


                                    <td aria-label="Действия">

                                        <a href="{{route ('cabinet.project.act.show',  [$project->id, $act->id])}}"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                        <a href="{{route ('cabinet.project.act.edit',  [$project->id, $act->id])}}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                    </td>


                                </tr>

                            @endforeach
                            </tbody>

                        </table>

                    @endif


                </div>


                <div class="text-center">
                    <a href="{{route('cabinet.project.act.create',  [$project->id])}}"
                       class="btn orange-btn orange-btn-min orange-btn-center">
                        Добавить акт
                    </a>
                </div>

            </div>

        </div>
    </div>

@endsection
