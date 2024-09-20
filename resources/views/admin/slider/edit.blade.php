@extends('layouts.__backend.app')

@section('page-title-bar', isset($pages['title-bar']) ? '| '.$pages['title-bar'] : '| Title Bar')

@section('page-title', isset($pages['page']['edit']['title']) ? $pages['page']['edit']['title'] : 'Title Page')

@section('page-breadcrumb')
    <li class="breadcrumb-item text-black">
        <a href="{{ (isset($pages) ? $pages['page']['home'] : '#') }}">
            {{ isset($pages) ? $pages['page']['breadcrumb']['parent'] : 'Parent' }}
        </a>
    </li>

    @if(isset($pages['page']['breadcrumb']['child']))
        <li class="breadcrumb-item @if(isset($pagesSubChild) && $pagesSubChild['active']) @else active @endif">
            @if(isset($pagesSubChild) && $pagesSubChild['active'])
                <a href="{{ (isset($pages) ? $pages['page']['breadcrumb']['child']['url'] : '#') }}">
                    {{ isset($pages) ? $pages['page']['breadcrumb']['child']['title'] : 'Parent' }}
                </a>
            @else
                <strong>{{ isset($pages) ? $pages['page']['breadcrumb']['child']['title'] : 'Child Title' }}</strong>
            @endif
        </li>
    @endif

    @if(isset($pagesSubChild) && $pagesSubChild['active'])
        <li class="breadcrumb-item active">
            <strong>{{ isset($pagesSubChild['active']) ? $pagesSubChild['title'] : 'subChild' }}</strong>
        </li>
    @endif
@endsection

@section('page-content')
<div class="row mb-4">
    <div class="col-sm-12 d-flex justify-content-end align-items-center">
        {!! ButtonAction(['edit'], $pages, $pagesSubChild['active']) !!}
    </div>
</div>
@endsection

@section('page-content__body')
<form method="POST" action="{{ $pages['page']['edit']['update'] }}" autocomplete="off" id="dataUpdate" class="row g-3" enctype="multipart/form-data">
    @method('PUT')
    @csrf

    <div class="col-md-12 col-sm-12">
        <div class="card">
            <div class="card-body">

                    @foreach ($formGenerator as $form)
                        @if(isset($form['column']['active']) && $form['column']['active'])
                            <div class="{{ $form['class']}}">
                                <div class="row">
                                    @foreach ($form['column']['columns'] as $formChild)
                                        <div class="{{$formChild['class']}}">
                                            {!! $formChild['form'] !!}
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @else
                            <div class="{{$form['class']}}">
                                {!! $form['form'] !!}
                            </div>
                        @endif
                    @endforeach


            </div>
        </div>
    </div>

    <div class="col-md-12 col-sm-12">
        <div class="card">
            <div class="card-body">
                @if($data->extension == 'jpg' || $data->extension == 'png' || $data->extension == 'jpeg')
                    <img src="{{ url($data->url) }}" class="img-fluid mb-3" alt="Image" width="30%">
                @endif

                @if($data->extension == 'mp4' || $data->extension == 'avi' || $data->extension == 'webm')
                    <video width="1280" height="720" controls>
                        <source src="{{ url($data->url) }}" type="video/{{ $data->extension }}">
                    </video>
                @endif
            </div>
        </div>
    </div>

</form>
@endsection

@push('styles')

@endpush

@push('scripts')

@endpush
