@extends('layouts.cabinet')

@section('title', 'Список актов')

@section('content')

    <div class="container">
        <div class="row">




            <div class="col-12">
                <div class="back-log">
                    <div class="back-link"><a class="btn-link btn-backlink" href="{{route('cabinet.project.show', $project->id)}}">Вернуться назад</a>
                    </div>
                </div>


                <div class="text-center">
                    <h2>Список актов проекта {{$project->name}}</h2>
                </div>

                <div class="progress-section">
                    <div class="progress-cell">Статус Ремонта: {{round($project->progress, 1)}}%</div>

                    <div class="progress-wrap-m progress-m" data-progress-percent="{{$project->progress}}">
                        <div class="progress-bar-m progress-m"></div>
                    </div>
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
                                                                        href="{{route ('cabinet.project.invoice.show', [$project->id, $act->id])}}">{{ $act->act_number}}</a>
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
                                        @if (Auth::user()->role != 'project_user')
                                        <a href="{{route ('cabinet.project.act.edit',  [$project->id, $act->id])}}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                        @endif
                                    </td>


                                </tr>

                            @endforeach
                            </tbody>

                        </table>

                    @endif


                </div>

                @if (Auth::user()->role != 'project_user')
                <div class="text-center">
                    <a href="{{route('cabinet.project.act.create',  [$project->id])}}"
                       class="btn orange-btn orange-btn-min orange-btn-center">
                        Добавить акт
                    </a>
                </div>
                @endif

            </div>

        </div>
    </div>

@endsection
