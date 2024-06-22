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
<form method="POST" action="{{ $pages['page']['create']['store'] }}" autocomplete="off" id="dataStore" class="theme-form row">
    @csrf

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
            </div>
        </div>
    </div>

    <div class="col-md-8 col-sm-12">
        <div class="row">
            <div class="col-lg-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th style="width:40%;">Menu Permessions</th>
                            <th style="width:45%; text-align:center;">Access</th>
                            <th style="width:15%; text-align:center;"><button type="button" class="btn btn-sm btn-info addRow"><i class="fa fa-plus"></i></button></th>
                        </tr>
                    </thead>
                    <tbody id="rolePermession">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</form>
@endsection

@push('styles')
<style>
    .select2-selection__choice, .select2-selection__choice__remove {
        background-color: #3BB77E !important;
        border-color: #3BB77E !important;
        color: #FFF !important;
    }
</style>
@endpush

@push('scripts')
<script type="text/javascript">

    function rowTable(no){
        // i++;
        var html = '<tr>';
        html += '<td>\
            <div class="col-lg-12">\
                <select class="form-control" name="role_menus[menu_group]['+parseInt(no)+'][name]">\
                    <option value="">-- Choose Menu --</option>\
                    @foreach($multipleMenu as $key => $value)\
                        <option value="{{ $value["id"] }}">{{ $value["name"] }}</option>\
                    @endforeach\
                </select>\
            </div>\
            </td>';
        html += '<td style="text-align:center;">';
        html += '<input type="checkbox" name="role_menus[menu_group]['+parseInt(no)+'][access][]" value="create"> Create &nbsp;&nbsp;&nbsp;&nbsp;';
        html += '<input type="checkbox" name="role_menus[menu_group]['+parseInt(no)+'][access][]" value="read"> Read &nbsp;&nbsp;&nbsp;&nbsp;';
        html += '<input type="checkbox" name="role_menus[menu_group]['+parseInt(no)+'][access][]" value="update"> Update &nbsp;&nbsp;&nbsp;&nbsp;';
        html += '<input type="checkbox" name="role_menus[menu_group]['+parseInt(no)+'][access][]" value="delete"> Delete &nbsp;&nbsp;&nbsp;&nbsp;';
        html += '</td>';
        html += '<td style="text-align:center;">\
            <button type="button" class="btn btn-sm btn-danger removeRow"><i class="fa fa-trash"></i></button>\
        </td>';
        html += '</tr>';

        $('#rolePermession').append(html);
    }

    //First Row Table
    // rowTable(0);

    $(document).ready(function() {

        var i = parseInt(0);

        console.log(i);

        //addRow
        $(document).on('click', '.addRow', function() {
            rowTable(i);
            i++;
            console.log(i);
        });

        //removeRow
        $(document).on('click', '.removeRow', function() {
            $(this).closest('tr').remove();
        });
    });
</script>
@endpush
