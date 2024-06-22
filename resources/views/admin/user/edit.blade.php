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
<form method="POST" action="{{ $pages['page']['edit']['update'] }}" autocomplete="off" id="dataUpdate" class="theme-form row" enctype="multipart/form-data">
    @method('PUT')
    @csrf

    <div class="col-md-6 col-sm-12">
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

    <div class="col-md-6 col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="input-upload">
                            <img src="{{ ($data->UserPhoto() != null) ? Storage::url('profile/'.$data->UserPhoto()) : asset('backend/assets/imgs/theme/upload.svg') }}" alt="" id="image_profile_pictures"/>
                            <input class="form-control" name="profile_pictures" id="profile_pictures" type="file"/>
                        </div>
                    </div>
                </div>

                <div class="row pt-3">
                    <div class="col-lg-8">
                        {!! FormText("Name", "name", "Fullname", true, $data->name) !!}
                        {{-- {{dd($data)}} --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

</form>
@endsection

@push('styles')
<style>
    /* .select2-selection__choice {
        margin-top: 100px !important;
    } */

    .select2-selection__choice__remove {
        /* background-color: #3BB77E !important;
        border-color: #3BB77E !important;
        color: #FFF !important; */
        padding-top:2px !important;
        padding-right: 8px !important;
    }

    .select2-selection__choice__display {
        /* color: #000 !important; */
        margin-left: 21px;
    }


    .input-upload {
        text-align: center;
    }

    .input-upload img {
        max-width: 600px;
        margin-bottom: 50px;
        margin-top: 30px;

    }

    .input-upload-slider img {
        max-width: 100%;
        margin-bottom: 20px;
    }
</style>
@endpush

@push('scripts')
<script text="text/javascript">
    $(document).ready(function() {
        value = {!! $optionSelect !!};
        $(".select2Form").val(value).trigger('change');

        //if profile_pictures changes to image_profile_pictures
        $("#profile_pictures").change(function() {
            readURL(this, '#image_profile_pictures');
        });

        //readURL
        function readURL(input, id) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $(id).attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    });
</script>
@endpush
