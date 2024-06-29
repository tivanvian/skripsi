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
        {!! ButtonAction(['edit'], $pages, false, $routeBack) !!}
    </div>
</div>
@endsection

@section('page-content__body')
<div class="col-md-8 col-sm-12">
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ $pages['page']['edit']['update'] }}" autocomplete="off" id="dataUpdate" class="row g-3">
                @method('PUT')
                @csrf

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

            </form>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .font-preview {
        font-size: 30px;
    }

    #icon-preview {
        margin-top: 25px;
        margin-left: 20px;
    }
</style>
@endpush

@push('scripts')
<script>
$('#icon').on('change', function() {
    var icon = $(this).val();
    $('#icon-preview').html('');
    // $('#icon-preview').removeClass().addClass(icon);
    console.log(icon);
    //insert i in div id icon-preview
    $('#icon-preview').html('<i class="font-preview icofont '+icon+'"></i>');
});
</script>
@endpush
