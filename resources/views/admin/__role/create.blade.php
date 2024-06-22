@extends('layouts.backend.main')

@section('content-title', $pages['create']['title'] ?? '-')

@section('content-header')
<div class="content-header">
    <div>
        <h2 class="content-title card-title">{{ $pages['create']['title'] ?? '-' }}</h2>
    </div>
    <div>
        <a href="{{ route($pages['index']) }}" class="btn btn-light rounded font-sm mr-5 text-body hover-up"><i class="material-icons md-arrow-back"></i> Back</a>
        <button type="submit" form="dataStore" class="btn btn-md rounded font-sm hover-up">Save</button>
    </div>
</div>
@endsection


@section('content-body')
<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="card mb-4">
            <div class="card-header">
                <h4>Data Role</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route($pages['create']['store']) }}" autocomplete="off" id="dataStore">
                    @csrf

                    <div class="row">
                        <div class="col-lg-4">
                            <div class="row">
                                <div class="col-lg-12">
                                    {!! FormText("Name", "name", "Fullname", true) !!}
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    {!! FormSelect("Default Route", 'default_route', "-- Choose Default Route --", $singleMenu, true) !!}
                                </div>
                            </div>

                            {{-- <div class="row">
                                <div class="col-lg-12">
                                    {!! FormSelect2("Menu", 'menus', "-- Choose Menu --", $multipleMenu) !!}
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-2">
                                    <label class="form-check pt-4">
                                        <input class="form-check-input" type="checkbox" name="access[create]" value="create"/>
                                        <span class="form-check-label"> Create </span>
                                    </label>
                                </div>
                                <div class="col-lg-2">
                                    <label class="form-check pt-4">
                                        <input class="form-check-input" type="checkbox" name="access[read]" value="read"/>
                                        <span class="form-check-label"> Read </span>
                                    </label>
                                </div>
                                <div class="col-lg-2">
                                    <label class="form-check pt-4">
                                        <input class="form-check-input" type="checkbox" name="access[update]" value="update"/>
                                        <span class="form-check-label"> Update </span>
                                    </label>
                                </div>
                                <div class="col-lg-2">
                                    <label class="form-check pt-4">
                                        <input class="form-check-input" type="checkbox" name="access[delete]" value="delete"/>
                                        <span class="form-check-label"> Delete </span>
                                    </label>
                                </div>
                            </div> --}}
                        </div>

                        <div class="col-lg-8">
                            <div class="row">
                                <div class="col-lg-12">
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
<script type="text/javascript">
    var i = 0;

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

    //First Row Table
    rowTable();

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
