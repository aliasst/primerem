@extends('layouts.cabinet')

@section('title', 'Список счетов')

@section('content')

    <div class="container">
        <div class="row">




            <div class="col-12">
                <div class="back-log">
                    <div class="back-link"><a class="btn-link btn-backlink" href="{{ route('cabinet.dashboard') }}">Назад</a>
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
                    <h2>Список счетов</h2>
                </div>

                @include('flash-messages')
            </div>
            <div class="col-12">
                <div class="request-list-wrap request-list-wrap_1 mb-5">


                    @if(empty($invoices->count()))

                       <h3 class="text-center mt-4">Счетов нет</h3>
                    @else

                        <table class="requests">
                            <thead>
                            <tr>
                                <th>Номер счета</th>
                                <th>Дата добавления</th>
                                <th>Статус</th>
                                <th>Ссылка</th>
                                <th>Действия</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($invoices as  $invoice)

                                <tr class="">
                                    <td aria-label="Номер счета"><a style="white-space: nowrap" class="btn-link"
                                                                        href="{{route ('cabinet.invoice.edit', $invoice->id)}}">{{ $invoice->invoice_number}}</a>
                                    </td>
                                    <td aria-label="Дата создания">{{ $invoice->created_at->format('d.m.Y') }}</td>
                                    <td aria-label="Статус">
                                        {{ \App\Models\Invoice::$statuses[$invoice->status] }}
                                    </td>
                                    <td aria-label="Ссылка">
{{--                                        @if(empty($invoice->files->count()))--}}
                                        @foreach($invoice->files as $file)
                                            <a style="text-decoration: underline" target="_blank"
                                               href="{{ Storage::disk('public')->url($file->storage_path) }}">Скачать</a>
                                        @endforeach
{{--                                        @endif--}}
                                    </td>


                                    <td aria-label="Действия">

                                        <a href="{{route ('cabinet.invoice.show', $invoice->id)}}"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                        <a href="{{route ('cabinet.invoice.edit', $invoice->id)}}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                    </td>


                                </tr>

                            @endforeach
                            </tbody>

                        </table>

                    @endif


                </div>


                <div class="text-center">
                    <a href="{{route('cabinet.invoice.create')}}"
                       class="btn orange-btn orange-btn-min orange-btn-center">
                        Добавить счет
                    </a>
                </div>

            </div>

        </div>
    </div>

@endsection
