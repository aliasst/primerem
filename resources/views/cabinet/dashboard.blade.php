@extends('layouts.cabinet')

@section('title', 'Личный кабинет')

@section('content')
    <div class="container">

        <div class="col-12 mb-4">

        </div>


        <div class="text-center mb-3">

            {{--                    {{ Auth::user()->name }} <br>--}}

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



        <div class="py-5 text-center">
            <div class="logo-cell">Prime<span>REM</span></div>

            <h2>Выберите действие</h2>
        </div>

        <div class="cabinet-menu" id="cabinet-menu">
            <a href="" class="btn orange-btn orange-btn-min" role="button">Счета</a>
            <a href="" class="btn orange-btn orange-btn-min" role="button">Акты</a>
            <a href="" class="btn orange-btn orange-btn-min" role="button">Этапы</a>
            <a href="" class="btn orange-btn orange-btn-min" role="button">Отчеты</a>
            <a href="" class="btn orange-btn orange-btn-min" role="button">Подрядчики</a>
            <a href="" class="btn orange-btn orange-btn-min" role="button">Закупки</a>

        </div>
    </div>




@endsection
