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
                               href="{{ route('cabinet.project.index') }}">Назад</a>
                        @endif
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

                    <h2>Выберите действие для проекта {{$project->name}}</h2>
                </div>

            </div>


            <div class="col-12 ">
                <div class="cabinet-menu" id="cabinet-menu">
                    <a href="{{route('cabinet.project.invoice.index', $project->id)}}"
                       class="btn orange-btn orange-btn-min" role="button">Счета</a>
                    <a href="{{route('cabinet.project.act.index', $project->id)}}" class="btn orange-btn orange-btn-min"
                       role="button">Акты</a>
                    <a href="{{route('cabinet.project.stage.index', $project->id)}}"
                       class="btn orange-btn orange-btn-min" role="button">Этапы</a>
                    <a href="{{route('cabinet.project.report.index', $project->id)}}"
                       class="btn orange-btn orange-btn-min" role="button">Отчеты</a>
                    <a href="{{route('cabinet.project.contractor.index', $project->id)}}"
                       class="btn orange-btn orange-btn-min" role="button">Подрядчики</a>
                    <a href="{{route('cabinet.project.purchase.index', $project->id)}}"
                       class="btn orange-btn orange-btn-min" role="button">Закупки</a>

                </div>
            </div>
        </div>
    </div>

@endsection
