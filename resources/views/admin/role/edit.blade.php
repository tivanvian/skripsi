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
<form method="POST" action="{{ $pages['page']['edit']['update'] }}" autocomplete="off" id="dataUpdate" class="theme-form row">
    @method('PUT')
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
            <div class="col-md-12">
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
                    @php($i = 0)
                    @foreach($data->roleMenus()->get() as $key => $value)
                        <tbody>
                            <tr>
                                <td>
                                    <select class="form-control" name="role_menus[menu_group][{{$i}}][name]">
                                        <option value="">-- Choose Menu --</option>
                                        @foreach($multipleMenu as $key => $v)
                                            <option value="{{ $v["id"] }}" @if($v["id"] === $value->menu_group) selected @endif>
                                                {{ $v["name"] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td style="text-align:center;">
                                    <input type="checkbox" name="role_menus[menu_group][{{$i}}][access][]" value="create" @if(in_array('create', $value->access)) checked @endif> Create &nbsp;&nbsp;&nbsp;&nbsp;
                                    <input type="checkbox" name="role_menus[menu_group][{{$i}}][access][]" value="read" @if(in_array('read', $value->access)) checked @endif> Read &nbsp;&nbsp;&nbsp;&nbsp;
                                    <input type="checkbox" name="role_menus[menu_group][{{$i}}][access][]" value="update" @if(in_array('update', $value->access)) checked @endif> Update &nbsp;&nbsp;&nbsp;&nbsp;
                                    <input type="checkbox" name="role_menus[menu_group][{{$i}}][access][]" value="delete" @if(in_array('delete', $value->access)) checked @endif> Delete &nbsp;&nbsp;&nbsp;&nbsp;
                                </td>
                                <td style="text-align:center;">
                                    <button type="button" class="btn btn-sm btn-danger removeRow"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                        </tbody>

                        @php($i++)
                    @endforeach


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
<script text="text/javascript">
    $(document).ready(function() {
        value = {!! TextToArray($data->menus) !!};
        $(".select2Form").val(value).trigger('change');
    });
</script>

<script type="text/javascript">

    function rowTable(no){
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

    $(document).ready(function() {
        var i = parseInt({{ $data->roleMenus()->count() }});

        console.log(i);

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
@endpush
