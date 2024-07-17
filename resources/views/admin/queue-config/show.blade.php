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
<div class="col-md-4 col-sm-12">
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

                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <table class="table" style="width: 100%;">
                                <thead>
                                    <tr>
                                        {{-- <th style="width:40%;">Id</th> --}}
                                        <th style="width:100%; text-align:center;">Jenis Pelayanan</th>
                                        {{-- <th style="width:15%; text-align:center;">
                                            
                                        </th> --}}
                                    </tr>
                                </thead>
            
                                <tbody id="valueField">
            
                                </tbody>
                                @php($i = 0)
                                @foreach($data_pelayanan_loket as $key => $value)
                                    <tbody>
                                        <tr>
                                            <td>
                                                <input id="id-{{$i}}" name="pelayanan_loket[]" placeholder="name" type="text" class="form-control required-check " required="" value="{{$value}}">
                                            </td>
                                            {{-- <td style="text-align:center;"></td> --}}
                                        </tr>
                                    </tbody>

                                    @php($i++)
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>


        </div>
    </div>
</div>


<div class="col-md-8 col-sm-12">
    <div class="row">
        <div class="col-md-12">

        </div>
    </div>
</div>
@endsection

@push('styles')

@endpush

@push('scripts')

@endpush
