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
<form method="POST" action="{{ $pages['page']['create']['store'] }}" autocomplete="off" id="dataStore" class="row">
    @csrf

    <div class="col-md-6 col-sm-12">
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
    </div>

    <div class="col-md-6 col-sm-6">
        <div class="row">

            {{-- <div class="col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-body">

                        <div class="row g-3">

                            <div class="col-xl-12 col-sm-12">
                                <h6 class="txt-primary">{{ __('Config Table, Migration, Model, Request') }}</h6>
                                <hr class="txt-primary">
                            </div>

                            <div class="col-xl-8 col-sm-8">
                                {!! FormText("Name Table", "name_table", "Name of Table DB", true) !!}
                            </div>

                            <div class="col-xl-12 col-sm-12">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th style="width:30%;">{{ __('Column') }}</th>
                                            <th style="width:25%; text-align:center;">{{ __('Attribute')}}</th>
                                            <th style="width:15%; text-align:center;">{{ __('Length')}}</th>
                                            <th style="width:10%; text-align:center;">{{ __('Nullable')}}</th>
                                            <th style="width:15%; text-align:center;"><button type="button" class="btn btn-sm btn-info addRowColumn"><i class="fa fa-plus"></i></button></th>
                                        </tr>
                                    </thead>

                                    <tbody id="columnTable">
                                    </tbody>
                                </table>
                            </div>

                        </div>

                    </div>
                </div>
            </div> --}}

            <div class="col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-body">

                        <div class="row g-3">

                            <div class="col-xl-12 col-sm-12">
                                <h6 class="txt-primary">{{ __('Controller, Model and Service') }}</h6>
                                <hr class="txt-primary">
                            </div>

                            <div class="col-xl-8 col-sm-8">
                                {!! FormText("Name Controller", "controller", "Name for Controller", false) !!}
                            </div>

                            <div class="col-xl-4 col-sm-4">
                                {!! FormText("Alias Controller", "alias_controller", "Alias of Controller", false) !!}
                            </div>

                            <div class="col-xl-6 col-sm-6">
                                {!! FormText("Name Model", "model", "Name for Model", false) !!}
                            </div>

                            <div class="col-xl-6 col-sm-6">
                                {!! FormText("Name Services", "service", "Name for Services", false) !!}
                            </div>

                            <div class="col-xl-6 col-sm-6">
                                {!! FormText("Name Request", "request", "Name for Request", false) !!}
                            </div>

                            <div class="col-xl-6 col-sm-6">
                                {!! FormText("Name Table", "table", "Name for Table", false) !!}
                            </div>

                        </div>

                    </div>
                </div>
            </div>

            {{-- //Role Access --}}
            <div class="col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-body row">

                        <div class="col-xl-12 col-sm-12">
                            <h6 class="txt-primary">{{ __("Role Access Menu") }}</h6>
                            <hr class="txt-primary">
                        </div>

                        <div class="col-xl-12 col-sm-12">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th style="width:30%;">{{ __('Role') }}</th>
                                        <th style="width:55%; text-align:center;">{{ __('Access')}}</th>
                                        <th style="width:15%; text-align:center;"><button type="button" class="btn btn-sm btn-info addRow"><i class="fa fa-plus"></i></button></th>
                                    </tr>
                                </thead>

                                <tbody id="rolePermession">
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>


</form>
@endsection

@push('styles')
<style>
    .font-preview {
        font-size: 30px;
    }

    #icon-preview {
        margin-top: 25px;
        margin-left: 30px;
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

<script type="text/javascript">

    function rowTable(no){
        var html = '<tr>';
        html += '<td>\
            <div class="col-lg-12">\
                <select class="form-select form-select-sm" name="role_access['+parseInt(no)+'][role]">\
                    <option value="">-- Choose Menu --</option>\
                    @foreach($params["role"] as $key => $value)\
                        <option value="{{ $value["id"] }}">{{ $value["name"] }}</option>\
                    @endforeach\
                </select>\
            </div>\
            </td>';
        html += '<td style="text-align:center;">';
        html += '<input type="checkbox" name="role_access['+parseInt(no)+'][access][]" value="create"> Create &nbsp;&nbsp;&nbsp;&nbsp;';
        html += '<input type="checkbox" name="role_access['+parseInt(no)+'][access][]" value="read"> Read &nbsp;&nbsp;&nbsp;&nbsp;';
        html += '<input type="checkbox" name="role_access['+parseInt(no)+'][access][]" value="update"> Update &nbsp;&nbsp;&nbsp;&nbsp;';
        html += '<input type="checkbox" name="role_access['+parseInt(no)+'][access][]" value="delete"> Delete &nbsp;&nbsp;&nbsp;&nbsp;';
        html += '</td>';
        html += '<td style="text-align:center;">\
            <button type="button" class="btn btn-sm btn-danger removeRow"><i class="fa fa-trash"></i></button>\
        </td>';
        html += '</tr>';

        $('#rolePermession').append(html);
    }

    $(document).ready(function() {
        var i = 0;

        //addRow
        $(document).on('click', '.addRow', function() {
            rowTable(i++);
        });

        //removeRow
        $(document).on('click', '.removeRow', function() {
            $(this).closest('tr').remove();
        });
    });
</script>


<script type="text/javascript">

    function rowTableColumn(no){
        var html = '<tr>';
        html += '<td style="text-align:center;">';
        html += '<input class="form-control form-control-sm" type="text" name="column['+parseInt(no)+'][field]">';
        html += '</td>';
        html += '<td>\
            <div class="col-lg-12">\
                <select class="form-select form-select-sm" name="column['+parseInt(no)+'][attribute]">\
                    <option value="">-- Choose Menu --</option>\
                    @foreach($params["type_data"] as $key => $value)\
                        <option value="{{ $value["id"] }}">{{ $value["name"] }}</option>\
                    @endforeach\
                </select>\
            </div>\
            </td>';
        html += '<td style="text-align:center;">';
        html += '<input class="form-control form-control-sm" type="text" name="column['+parseInt(no)+'][length]">';
        html += '</td>';
        html += '<td style="text-align:center;">';
        html += '<input type="checkbox" name="column['+parseInt(no)+'][nullable]" value="nullable">';
        html += '</td>';
        html += '<td style="text-align:center;">\
            <button type="button" class="btn btn-sm btn-danger removeRowColumn"><i class="fa fa-trash"></i></button>\
        </td>';
        html += '</tr>';

        $('#columnTable').append(html);
    }

    $(document).ready(function() {
        var i = 0;

        //addRow
        $(document).on('click', '.addRowColumn', function() {
            rowTableColumn(i++);
        });

        //removeRow
        $(document).on('click', '.removeRowColumn', function() {
            $(this).closest('tr').remove();
        });
    });
</script>
@endpush
