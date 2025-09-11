@extends('layouts.cabinet')

@section('title', 'Просмотр закупки')

@section('content')

    <div class="container">

        <div class="row justify-content-center">


            <div class="col-12">
                <div class="back-log">
                    <div class="back-link"><a class="btn-link btn-backlink"
                                              href="{{ route('cabinet.project.purchase.index',  [$project->id]) }}">Вернуться
                            назад</a>
                    </div>

                </div>


                <div class="card-head-new"> Просмотр закупки</div>
                <div class="card-head-new-sub"></div>

                @include('flash-messages')


            </div>
            <div class="col-12 col-md-8">

                <div class="request-card card auth-card">

                    <div class="card-content">
                        <form method="post"
                              action=""
                              enctype="">
                            @csrf


                            <div class="row mb-3">


                                <div class="col-12">
                                    <div class="form-input">
                                        <label for="title" class="">Название закупки</label>
                                        <input id="title" type="text"
                                               class=""
                                               name="title"
                                               value="{{$purchase->title }}" disabled>
                                    </div>


                                </div>
                            </div>


                            <div class="row mb-3">


                                <div class="col-12">
                                    <div class="form-input">
                                        <label for="description" class="">Описание</label>
                                        <textarea name="description" id="description"
                                                  class="" cols="30"
                                                  rows="6"
                                                  disabled>{{ $purchase->description ?? '' }}</textarea>
                                    </div>


                                </div>
                            </div>


                            <div class="row mb-3">


                                <div class="col-12">
                                    <div class="form-input">
                                        <label for="stage" class="">Этап</label>
                                        <input id="stage" type="text"
                                               class=""
                                               name="stage"
                                               value="{{ $purchase->stage->title  }}" disabled>
                                    </div>


                                </div>
                            </div>


                            <div class="row mb-3">


                                <div class="col-12">
                                    <div class="form-input">
                                        <label for="purchase_date" class="">Дата закупки</label>
                                        <input id="purchase_date" type="text"
                                               class=""
                                               name=""
                                               value="{{  $purchase->purchase_date ? $purchase->purchase_date->format('d.m.Y') : '' }}"
                                               disabled
                                        >
                                    </div>


                                </div>
                            </div>


                            <div class="row mb-3">


                                <div class="col-12">
                                    <div class="form-input">
                                        <label for="comments" class="">Комментарии</label>
                                        <textarea name="comments" id="comments"
                                                  class="" cols="30"
                                                  rows="6"
                                                  disabled>{{ $purchase->comments ?? '' }}</textarea>
                                    </div>


                                </div>
                            </div>


                            <div class="row mb-3">


                                <div class="col-12">
                                    @if(!$files->isEmpty())
                                        <div class="uploaded-files">
                                            {{--                                            <div class="uploaded-files-label">Ранее загруженный счет:</div>--}}
                                            <div class="uploaded-files-inner-wrap img-upload-row">
                                                @foreach($files as $file)

                                                    @if(in_array($file->extension, ['jpg', 'jpeg', 'png'])  )

                                                        <div class="uploaded-file uploaded-img" id="{{$file->id}}">
                                                            <a class="uploaded-img-link"
                                                               data-fancybox="gallery"
                                                               data-src="{{ Storage::disk('public')->url($file->storage_path) }}"
                                                               data-caption=""
                                                            >
                                                                <img
                                                                    src="{{ Storage::disk('public')->url($file->storage_path) }}"
                                                                    width="100" alt=""/>
                                                            </a>


                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>

                                            <div class="uploaded-files-inner-wrap doc-upload-row">

                                                @foreach($files as $file)

                                                    @if(!in_array($file->extension, ['jpg', 'jpeg', 'png'])  )
                                                        <div class="uploaded-file" id="{{$file->id}}">
                                                            <a style="text-decoration: underline" target="_blank" --}}
                                                               href="{{ Storage::disk('public')->url($file->storage_path) }}">{{$file->name}}</a>
                                                        </div>
                                                    @else

                                                    @endif
                                                @endforeach

                                            </div>

                                        </div>
                                    @endif


                                </div>
                            </div>


                        </form>


                    </div>
                </div>

            </div>

        </div>
    </div>

@endsection
