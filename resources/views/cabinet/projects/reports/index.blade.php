@extends('layouts.cabinet')

@section('title', 'Отчеты проекта')

@section('content')

    <div class="container">
        <div class="row">


            <div class="col-12">
                <div class="back-log">
                    <div class="back-link"><a class="btn-link btn-backlink"
                                              href="{{route('cabinet.project.show', $project->id)}}">Вернуться назад</a>
                    </div>

                </div>


                <div class="text-center">
                    <h2>Отчеты проекта {{$project->name}}</h2>
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


                    @if(empty($stages->count()))

                        <h3 class="text-center mt-4">Отчетов нет</h3>
                    @else
                        <div class="stage-table-wrap">

                        @foreach($stages as  $stage)

                            <table class="stage-table">
                                <thead>
                                <tr>
                                    <th>Название <span>этапа</span></th>
                                    <th>Дата старта</th>
                                    <th>Дата завершения</th>
                                    <th>Статус</th>
                                    <th>Действия</th>
                                </tr>
                                </thead>
                                <tbody>

                                <tr class="parent-tr {{$stage->status}}">
                                    <td aria-label="Название этапа"><a style="" class="btn-link"
                                                                       href="{{route ('cabinet.project.report.show', [$project->id, $stage->id])}}">{{ $loop->iteration }}
                                            . {{ $stage->title}}</a>
                                    </td>
                                    <td aria-label="Дата старта">{{ $stage->start_date ? $stage->start_date->format('d.m.Y') : ''}}</td>
                                    <td aria-label="Дата завершения">{{ $stage->finish_date ? $stage->finish_date->format('d.m.Y') : ''}}</td>


                                    <td aria-label="Статус">
                                        @if($stage->status)
                                            {{ \App\Models\Stage::$statuses[$stage->status] }}
                                        @endif

                                    </td>
                                    <td aria-label="Действия">

                                        <a href="{{route ('cabinet.project.report.show',  [$project->id, $stage->id])}}"><i
                                                class="fa fa-eye" aria-hidden="true"></i></a>
                                        @if (Auth::user()->role != 'project_user')
                                            <a href="{{route ('cabinet.project.report.edit',  [$project->id, $stage->id])}}"><i
                                                    class="fa fa-pencil" aria-hidden="true"></i></a>
                                        @endif
                                    </td>


                                </tr>

                                @foreach($stage->child_stages as  $child_stage)

                                    <tr class="child-tr {{$child_stage->status}}">
                                        <td style="padding-left:50px;" aria-label="Название этапа"><a style=""
                                                                                                      class="btn-link"
                                                                                                      href="{{route ('cabinet.project.report.show', [$project->id, $child_stage->id])}}">{{ $child_stage->title}}</a>
                                        </td>
                                        <td aria-label="Дата старта">{{ $child_stage->start_date ? $child_stage->start_date->format('d.m.Y') : '' }}</td>
                                        <td aria-label="Дата завершения">{{ $child_stage->finish_date ? $child_stage->finish_date->format('d.m.Y') : '' }}</td>
                                        <td aria-label="Статус">
                                            @if($child_stage->status)
                                                {{ \App\Models\Stage::$statuses[$child_stage->status] }}
                                            @endif
                                        </td>
                                        <td aria-label="Действия">

                                            <a href="{{route ('cabinet.project.report.show',  [$project->id, $child_stage->id])}}"><i
                                                    class="fa fa-eye" aria-hidden="true"></i></a>
                                            @if (Auth::user()->role != 'project_user')
                                                <a href="{{route ('cabinet.project.report.edit',  [$project->id, $child_stage->id])}}"><i
                                                        class="fa fa-pencil" aria-hidden="true"></i></a>
                                            @endif
                                        </td>


                                    </tr>

                                @endforeach

                                </tbody>

                            </table>

                        @endforeach
                        </div>

                    @endif


                </div>


            </div>

        </div>
    </div>

@endsection
