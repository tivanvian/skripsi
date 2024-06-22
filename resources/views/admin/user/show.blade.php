@extends('layouts.__backend.app')

@section('page-title-bar', isset($pages['title-bar']) ? '| '.$pages['title-bar'] : '| Title Bar')

@section('page-title', isset($pages['page']['show']['title']) ? $pages['page']['show']['title'] : 'Title Page')

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
        {!! ButtonAction(['edit_show'], $pages, $pagesSubChild['active']) !!}
    </div>
</div>
@endsection

@section('page-content__body')
<div class="col-xl-4 col-sm-6 col-xxl-3 col-ed-4 box-col-4">
    <div class="card social-profile">
      <div class="card-body">
        <div class="social-img-wrap">
          <div class="social-img"><img src="{{ $picture }}" alt="profile"></div>
          <div class="edit-icon">
            <svg>
              <use href="{{asset("themes/assets/svg/icon-sprite.svg#profile-check")}}"></use>
            </svg>
          </div>
        </div>
        <div class="social-details">
            <h5 class="mb-1">
                <a href="social-app.html"> {{ $data->name }} </a>
            </h5>
            <span class="f-light">{{ $data->email }}</span><br>
            <span class="f-light">{{ $data->getDefaultRole() }}</span>
          <ul class="card-social">
            <li><a href="https://www.facebook.com/" target="_blank"><i class="fa fa-facebook"></i></a></li>
            <li><a href="https://accounts.google.com/" target="_blank"><i class="fa fa-google-plus"></i></a></li>
            <li><a href="https://twitter.com/" target="_blank"><i class="fa fa-twitter"></i></a></li>
            <li><a href="https://www.instagram.com/" target="_blank"><i class="fa fa-instagram"></i></a></li>
            <li><a href="https://rss.app/" target="_blank"><i class="fa fa-rss"></i></a></li>
          </ul>
          <ul class="social-follow">
            <li>
              <h5 class="mb-0">1,908</h5><span class="f-light">Posts</span>
            </li>
            <li>
              <h5 class="mb-0">34.0k</h5><span class="f-light">Followers</span>
            </li>
            <li>
              <h5 class="mb-0">897</h5><span class="f-light">Following</span>
            </li>
          </ul>
        </div>
      </div>
    </div>
</div>


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

    });
</script>
@endpush
