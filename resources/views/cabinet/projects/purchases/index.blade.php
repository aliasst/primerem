@extends('layouts.cabinet')

@section('title', 'Список закупок')

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
                    <h2>Список закупок проекта {{$project->name}}</h2>
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
                                                                        href="{{route ('cabinet.project.purchase.edit', [$project->id, $purchase->id])}}">{{ $loop->iteration }}</a>
                                    </td>
                                    <td aria-label="Название"><a style="white-space: nowrap" class="btn-link"
                                                              href="{{route ('cabinet.project.purchase.edit', [$project->id, $purchase->id])}}">{{ $purchase->title }}</a>
                                    </td>
                                    <td aria-label="Этап">
                                        {{ $purchase->stage->title }}
                                    </td>
                                    <td aria-label="Начало работ">{{ $purchase->purchase_date ? $purchase->purchase_date->format('d.m.Y') : '' }}</td>



                                    <td aria-label="Действия">

                                        <a href="{{route ('cabinet.project.purchase.show',  [$project->id, $purchase->id])}}"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                        <a href="{{route ('cabinet.project.purchase.edit',  [$project->id, $purchase->id])}}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                    </td>


                                </tr>

                            @endforeach
                            </tbody>

                        </table>

                    @endif


                </div>


                <div class="text-center">
                    <a href="{{route('cabinet.project.purchase.create',  [$project->id])}}"
                       class="btn orange-btn orange-btn-min orange-btn-center">
                        Добавить закупку
                    </a>
                </div>

            </div>

        </div>
    </div>

@endsection
