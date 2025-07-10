@extends('layouts.cabinet')

@section('title', 'Личный кабинет')

@section('content')
    <div class="container">
        <div class="row justify-content-center">


            <div class="col-12 ">
                <div class="back-log">
                    {{--                    <div class="back-link"></div>--}}
                    {{--                    <div class="logout-link">--}}
                    {{--                        Вы в личном кабинете!--}}
                    {{--                        @if (Route::has('logout'))--}}
                    {{--                            <a class="btn-link btn-unlogin" href="{{ route('logout') }}"--}}
                    {{--                               onclick="event.preventDefault();--}}
                    {{--                                                                         document.getElementById('logout-form').submit();">--}}
                    {{--                                {{ __('Выйти') }}--}}
                    {{--                            </a>--}}
                    {{--                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">--}}
                    {{--                                @csrf--}}
                    {{--                            </form>--}}

                    {{--                        @endif--}}
                    {{--                    </div>--}}
                </div>


                <div class="py-2 text-center">
                    <h2 class="text-center">Выберите действие</h2>
                </div>

            </div>

            @if (Auth::user()->role == 'superadmin')
                <div class="col-xs-12 col-md-10 ">
                    <div class="cabinet-menu-superadmin" id="cabinet-menu-superadmin">

                        <a href="{{route('cabinet.project.index')}}" class="cabinet-menu-superadmin-item">
                            <div class="cabinet-menu-superadmin-item-img"><img class=""
                                                                               src="{{url('/img/project.svg')}}"
                                                                               alt=""/></div>
                            <div class="cabinet-menu-superadmin-item-span"> Проекты</div>
                        </a>

                        <a href="{{route('cabinet.superuser.index')}}" class="cabinet-menu-superadmin-item">
                            <div class="cabinet-menu-superadmin-item-img"><img class=""
                                                                               src="{{url('/img/admin.svg')}}"
                                                                               alt=""/></div>
                            <div class="cabinet-menu-superadmin-item-span"> Главные админы</div>
                        </a>


                    </div>
                </div>
            @endif

            {{--            <div class="col-12 ">--}}
            {{--                <div class="cabinet-menu" id="cabinet-menu">--}}
            {{--                    <a href="" class="btn orange-btn orange-btn-min" role="button">Счета</a>--}}
            {{--                    <a href="" class="btn orange-btn orange-btn-min" role="button">Акты</a>--}}
            {{--                    <a href="" class="btn orange-btn orange-btn-min" role="button">Этапы</a>--}}
            {{--                    <a href="" class="btn orange-btn orange-btn-min" role="button">Отчеты</a>--}}
            {{--                    <a href="" class="btn orange-btn orange-btn-min" role="button">Подрядчики</a>--}}
            {{--                    <a href="" class="btn orange-btn orange-btn-min" role="button">Закупки</a>--}}

            {{--                </div>--}}
            {{--            </div>--}}
        </div>
    </div>

@endsection
