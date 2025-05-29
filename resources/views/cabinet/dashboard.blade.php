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
    </div>

@endsection
