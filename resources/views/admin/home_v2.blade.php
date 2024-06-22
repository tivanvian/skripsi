@extends('layouts.__backend.app')

@section('page-title-bar', isset($pages['title-bar']) ? '| '.$pages['title-bar'] : '| Title Bar')

@section('page-title', isset($pages['page']['index']['title']) ? $pages['page']['index']['title'] : 'Title Page')

@section('page-breadcrumb')
    <li class="breadcrumb-item text-black">
        <a href="{{ (isset($pages) ? route($pages['page']['home']) : '#') }}">
            {{ isset($pages) ? $pages['page']['breadcrumb']['parent'] : 'Parent' }}
        </a>
    </li>

    @if(isset($pages['page']['breadcrumb']['child']))
        <li class="breadcrumb-item @if(isset($pages['page']['breadcrumb']['subChild'])) @else active @endif">
            @if(isset($pages['page']['breadcrumb']['subChild']))
                <a href="{{ (isset($pages) ? route($pages['page']['breadcrumb']['child']['url']) : '#') }}">
                    {{ isset($pages) ? $pages['page']['breadcrumb']['parent'] : 'Parent' }}
                </a>
            @else
                <strong>{{ isset($pages) ? $pages['page']['breadcrumb']['child']['title'] : 'Child Title' }}</strong>
            @endif
        </li>
    @endif

    @if(isset($pages['page']['breadcrumb']['subChild']))
    <li class="breadcrumb-item active">
        <strong>{{ isset($pages) ? $pages['page']['breadcrumb']['subChild'] : 'subChild' }}</strong>
    </li>
    @endif
@endsection

@section('page-content')
<div class="row widget-grid">
    <div class="col-xxl-4 col-sm-6 box-col-6">
      <div class="card profile-box">
        <div class="card-body">
          <div class="media media-wrapper justify-content-between">
            <div class="media-body">
              <div class="greeting-user">
                <h4 class="f-w-600">Welcome to cuba</h4>
                <p>Here whats happing in your account today</p>
                <div class="whatsnew-btn">&nbsp;</div>
              </div>
            </div>
            <div>
              <div class="clockbox">
                <svg id="clock" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 600 600">
                  <g id="face">
                    <circle class="circle" cx="300" cy="300" r="253.9"></circle>
                    <path class="hour-marks" d="M300.5 94V61M506 300.5h32M300.5 506v33M94 300.5H60M411.3 107.8l7.9-13.8M493 190.2l13-7.4M492.1 411.4l16.5 9.5M411 492.3l8.9 15.3M189 492.3l-9.2 15.9M107.7 411L93 419.5M107.5 189.3l-17.1-9.9M188.1 108.2l-9-15.6"></path>
                    <circle class="mid-circle" cx="300" cy="300" r="16.2"></circle>
                  </g>
                  <g id="hour">
                    <path class="hour-hand" d="M300.5 298V142"></path>
                    <circle class="sizing-box" cx="300" cy="300" r="253.9"></circle>
                  </g>
                  <g id="minute">
                    <path class="minute-hand" d="M300.5 298V67">   </path>
                    <circle class="sizing-box" cx="300" cy="300" r="253.9"></circle>
                  </g>
                  <g id="second">
                    <path class="second-hand" d="M300.5 350V55"></path>
                    <circle class="sizing-box" cx="300" cy="300" r="253.9">   </circle>
                  </g>
                </svg>
              </div>
              <div class="badge f-10 p-0" id="txt"></div>
            </div>
          </div>
          <div class="cartoon"><img class="img-fluid" src="{{ asset('themes/assets/images/dashboard/cartoon.svg') }}" alt="vector women with leptop"></div>
        </div>
      </div>
    </div>
  </div>
@endsection
