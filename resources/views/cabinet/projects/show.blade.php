@extends('layouts.cabinet')

@section('title', 'Личный кабинет')

@section('content')
    <div class="container">
        <div class="row">


            <div class="col-12 ">
                <div class="back-log">

                    <div class="back-link">
                        @if (Auth::user()->role == 'superadmin')
                            <a class="btn-link btn-backlink"
                               href="{{ route('cabinet.project.index') }}">Вернуться назад</a>
                        @endif
                    </div>
                </div>


                <div class=" text-center">
                    <h2>Выберите действие для проекта {{$project->name}}</h2>
                </div>

                <div class="progress-section">
                <div class="progress-cell">Статус Ремонта: {{round($project->progress, 1)}}%</div>

                <div class="progress-wrap-m progress-m" data-progress-percent="{{$project->progress}}">
                    <div class="progress-bar-m progress-m"></div>
                </div>
                </div>

            </div>


            <div class="col-12 ">
                <div class="cabinet-menu" id="cabinet-menu">
                    <a class="cabinet-menu-item" href="{{route('cabinet.project.invoice.index', $project->id)}}"
                       role="button">
                        <div class="menu-item-ico"><img class=""
                                                        src="{{url('/img/icons/invoice.svg')}}"
                                                        alt=""/></div>
                        <div class="menu-item-name">Счета</div>
                        <div class="menu-item-linc">Смотреть</div>
                    </a>
                    <a class="cabinet-menu-item" href="{{route('cabinet.project.act.index', $project->id)}}"

                    >
                        <div class="menu-item-ico"><img class=""
                                                        src="{{url('/img/icons/act.svg')}}"
                                                        alt=""/></div>
                        <div class="menu-item-name">Акты</div>
                        <div class="menu-item-linc">Смотреть</div>
                    </a>
                    <a class="cabinet-menu-item" href="{{route('cabinet.project.stage.index', $project->id)}}"
                       role="button">
                        <div class="menu-item-ico"><img class=""
                                                        src="{{url('/img/icons/stage.svg')}}"
                                                        alt=""/></div>
                        <div class="menu-item-name">Этапы</div>
                        <div class="menu-item-linc">Смотреть</div>
                    </a>
                    <a class="cabinet-menu-item" href="{{route('cabinet.project.report.index', $project->id)}}"
                       role="button"><div class="menu-item-ico"><img class=""
                                                                     src="{{url('/img/icons/report.svg')}}"
                                                                     alt=""/></div>
                        <div class="menu-item-name">Отчеты</div>
                        <div class="menu-item-linc">Смотреть</div></a>
                    <a class="cabinet-menu-item" href="{{route('cabinet.project.contractor.index', $project->id)}}"
                       role="button"><div class="menu-item-ico"><img class=""
                                                                     src="{{url('/img/icons/contractor.svg')}}"
                                                                     alt=""/></div>
                        <div class="menu-item-name">Подрядчики</div>
                        <div class="menu-item-linc">Смотреть</div></a>
                    <a class="cabinet-menu-item" href="{{route('cabinet.project.purchase.index', $project->id)}}"
                       role="button"><div class="menu-item-ico"><img class=""
                                                                     src="{{url('/img/icons/purchase.svg')}}"
                                                                     alt=""/></div>
                        <div class="menu-item-name">Закупки</div>
                        <div class="menu-item-linc">Смотреть</div></a>

                </div>
            </div>
        </div>
    </div>

@endsection
