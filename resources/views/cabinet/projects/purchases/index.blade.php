@extends('layouts.cabinet')

@section('title', 'Список закупок')

@section('content')

    <div class="container">
        <div class="row">




            <div class="col-12">
                <div class="back-log">
                    <div class="back-link"><a class="btn-link btn-backlink" href="{{route('cabinet.project.show', $project->id)}}">Вернуться назад</a>
                    </div>

                </div>


                <div class="text-center">
                    <h2>Список закупок проекта {{$project->name}}</h2>
                </div>

                <div class="progress-section">
                    <div class="progress-cell">Статус Ремонта: {{round($project->progress, 1)}}%</div>

                    <div class="progress-wrap-m progress-m" data-progress-percent="{{$project->progress}}">
                        <div class="progress-bar-m progress-m"></div>
                    </div>
                </div>

                <div class="action action-sort action-sort-min">
                    <span class="stitle">Сортировать по: </span>
                    <div class="sort-active" >
                        <span>{{$sortCurrent}}</span>
                        <i class="mobi-accord-ico"></i>
                        <div class="menu">
                            <ul id="sort-list">
                                <li data-sort="title">По названию</li>
                                <li data-sort="created_at">По дате создания</li>
                                <li data-sort="updated_at">По дате изменения</li>
                            </ul>

                        </div>
                    </div>


                </div>

                @include('flash-messages')
            </div>
            <div class="col-12">
                <div class="request-list-wrap request-list-wrap_1 mb-5">


                    @if(empty($purchases->count()))

                       <h3 class="text-center mt-4">Закупок нет</h3>
                    @else

                        <table class="requests">
                            <thead>
                            <tr>
                                <th>Номер</th>
                                <th>Название</th>
                                <th>Этап</th>
                                <th>Дата закупки</th>
                                <th>Действия</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($purchases as  $purchase)

                                <tr class="">
                                    <td aria-label="Номер"><a style="white-space: nowrap" class="btn-link"
                                                                        href="{{route ('cabinet.project.purchase.show', [$project->id, $purchase->id])}}">{{ $loop->iteration }}</a>
                                    </td>
                                    <td aria-label="Название"><a style="white-space: nowrap" class="btn-link"
                                                              href="{{route ('cabinet.project.purchase.show', [$project->id, $purchase->id])}}">{{ $purchase->title }}</a>
                                    </td>
                                    <td aria-label="Этап">
                                        {{ $purchase->stage->title }}
                                    </td>
                                    <td aria-label="Начало работ">{{ $purchase->purchase_date ? $purchase->purchase_date->format('d.m.Y') : '' }}</td>



                                    <td aria-label="Действия">

                                        <a href="{{route ('cabinet.project.purchase.show',  [$project->id, $purchase->id])}}"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                        @if (Auth::user()->role != 'project_user')
                                        <a href="{{route ('cabinet.project.purchase.edit',  [$project->id, $purchase->id])}}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
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
                    <a href="{{route('cabinet.project.purchase.create',  [$project->id])}}"
                       class="btn orange-btn orange-btn-min orange-btn-center">
                        Добавить закупку
                    </a>
                </div>
                @endif

            </div>

        </div>
    </div>

@endsection
