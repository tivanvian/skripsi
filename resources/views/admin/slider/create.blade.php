@extends('layouts.__backend.app')

@section('page-title-bar', isset($pages['title-bar']) ? '| '.$pages['title-bar'] : '| Title Bar')

@section('page-title', isset($pages['page']['create']['title']) ? $pages['page']['create']['title'] : 'Title Page')

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
        {!! ButtonAction(['save'], $pages, $pagesSubChild['active']) !!}
    </div>
</div>
@endsection

@section('page-content__body')
<form method="POST" action="{{ $pages['page']['create']['store'] }}" autocomplete="off" id="dataStore" class="row g-3" enctype="multipart/form-data">
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

</form>
@endsection

@push('styles')

@endpush

@push('scripts')

@endpush
