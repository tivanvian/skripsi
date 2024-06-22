@extends('layouts.backend.main')

@section('content-title', $pages['edit']['title'] ?? '-')

@section('content-header')
<div class="content-header">
    <div>
        <h2 class="content-title card-title">{{ $pages['edit']['title'] ?? '-' }}</h2>
    </div>
    <div>
        <a href="{{ route($pages['index']) }}" class="btn btn-light rounded font-sm mr-5 text-body hover-up"><i class="material-icons md-arrow-back"></i> Back</a>
        <button type="submit" form="dataUpdate" class="btn btn-md rounded font-sm hover-up">Update</button>
    </div>
</div>
@endsection


@section('content-body')
<div class="row">
    <div class="col-md-12">
        <div class="card mb-4">
            <div class="card-header">
                <h4>Data Account</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route($pages['edit']['update'], $data) }}" autocomplete="off" id="dataUpdate">
                    @method('PUT')
                    @csrf

                    <div class="row">
                        <div class="col-md-4">

                            <div class="row">
                                <div class="col-md-12">
                                    {!! FormText("Name", "name", "Fullname", true, $data->name) !!}
                                </div>

                                <div class="col-md-12">
                                    {!! FormSelect("Default Route", 'default_route', "-- Choose Default Route --", $singleMenu, true, $data->default_route) !!}
                                </div>

                                <div class="col-md-4">
                                    <label class="form-check ">
                                        <input class="form-check-input" type="checkbox" @if($data->is_active == true) checked @endif name="is_active" />
                                        <span class="form-check-label"> Active </span>
                                    </label>
                                </div>
                            </div>

                        </div>


                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th style="width:40%;">Menu Permessions</th>
                                                <th style="width:45%; text-align:center;">Access</th>
                                                <th style="width:15%; text-align:center;"><button type="button" class="btn btn-sm btn-info addRow"><i class="material-icons md-add"></i></button></th>
                                            </tr>
                                        </thead>

                                        <tbody id="rolePermession">

                                        </tbody>
                                        @php($i = 1)
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
                                                        <button type="button" class="btn btn-sm btn-danger removeRow"><i class="material-icons md-delete"></i></button>
                                                    </td>
                                                </tr>
                                            </tbody>

                                            @php($i++)
                                        @endforeach


                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>


</div>
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
    var i = 0 + {{ $data->roleMenus()->count() }};

    function rowTable(){
        i++;
        var html = '<tr>';
        html += '<td>\
            <div class="col-lg-12">\
                <select class="form-control" name="role_menus[menu_group]['+parseInt(i)+'][name]">\
                    <option value="">-- Choose Menu --</option>\
                    @foreach($multipleMenu as $key => $value)\
                        <option value="{{ $value["id"] }}">{{ $value["name"] }}</option>\
                    @endforeach\
                </select>\
            </div>\
            </td>';
        html += '<td style="text-align:center;">';
        html += '<input type="checkbox" name="role_menus[menu_group]['+parseInt(i)+'][access][]" value="create"> Create &nbsp;&nbsp;&nbsp;&nbsp;';
        html += '<input type="checkbox" name="role_menus[menu_group]['+parseInt(i)+'][access][]" value="read"> Read &nbsp;&nbsp;&nbsp;&nbsp;';
        html += '<input type="checkbox" name="role_menus[menu_group]['+parseInt(i)+'][access][]" value="update"> Update &nbsp;&nbsp;&nbsp;&nbsp;';
        html += '<input type="checkbox" name="role_menus[menu_group]['+parseInt(i)+'][access][]" value="delete"> Delete &nbsp;&nbsp;&nbsp;&nbsp;';
        html += '</td>';
        html += '<td style="text-align:center;">\
            <button type="button" class="btn btn-sm btn-danger removeRow"><i class="material-icons md-delete"></i></button>\
        </td>';
        html += '</tr>';

        $('#rolePermession').append(html);
    }

    $(document).ready(function() {
        //Add Row in userPermession With Input Select

        //addRow
        $(document).on('click', '.addRow', function() {
            rowTable();
        });

        //removeRow
        $(document).on('click', '.removeRow', function() {
            $(this).closest('tr').remove();
        });
    });
</script>
@endpush
