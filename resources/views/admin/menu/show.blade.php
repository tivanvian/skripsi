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
        {!! ButtonAction(['create'], $pages, $pagesSubChild['active']) !!}
    </div>
</div>
@endsection

@section('page-content__body')
{{-- <div class="col-md-6 col-sm-12">
    <div class="card">
        <div class="card-body row g-3">
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
</div> --}}

<div class="col-md-12 col-sm-12">
    <div class="card">
        <div class="card-body">
            Menu Group List
            <br><br>
            <div class="row">

              @foreach ($listMenu as $menu)
              
                
              <div class="col-xxl-12 col-md-12">
                <div class="d-flex justify-content-between" style="border: 1px solid #efefef; border-radius: 5px; padding: 15px;">
                  <h6>
                    <div class="d-flex">
                      <i class="icofont {{$menu->icon}}" style="height: 1cap; margin-top:3px;"></i>
                      &nbsp;
                      {{$menu->title}}
                    </div>
                    <small style="color: darkgrey; font-size:0.7em;">{{$menu->route}}</small>
                  </h6>

                  <div>
                    @php

                    $dataLink = [
                        'show' => [
                            'url'     => route("admin.menu.show.list", $menu->id),
                            'label'   => "View",
                        ],
                        'edit' => [
                            'url'     => route("admin.menu.edit", $menu->id),
                            'label'   => "Edit",
                        ],
                        'delete' => [
                            'url'     => route("admin.menu.delete", $menu->id),
                            'id'      => $menu->id,
                            'label'   => "Delete",
                        ],
                    ];

                    @endphp

                    {!! ButtonAction(['update', 'delete', 'show'], $dataLink) !!}
                  </div>

                </div>
              </div>

              @endforeach


            </div>
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

@endpush
