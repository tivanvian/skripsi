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
<form method="POST" action="{{ $pages['page']['edit']['update'] }}" autocomplete="off" id="dataUpdate" class="row g-3">
    @method('PUT')
    @csrf

    <div class="col-md-12 col-sm-12">
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
                                            <th style="width:20%; text-align:center;">Alias</th>
                                            <th style="width:65%; text-align:center;">Jenis Pelayanan</th>
                                            <th style="width:15%; text-align:center;"><button type="button" class="btn btn-sm btn-info addRow"><i class="fa fa-plus"></i></button></th>
                                        </tr>
                                    </thead>
                
                                    <tbody id="valueField">
                
                                    </tbody>
                                    @php($i = 0)
                                    @if($data_pelayanan_loket)
                                        @foreach($data_pelayanan_loket as $key => $value)
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <input id="alias-{{$key}}" name="pelayanan_loket[{{$key}}][alias]" placeholder="name" type="text" class="form-control required-check " required="" value="{{$value['alias']}}">
                                                    </td>
                                                    <td>
                                                        <input id="id-{{$key}}" name="pelayanan_loket[{{$key}}][nama]" placeholder="name" type="text" class="form-control required-check " required="" value="{{$value['nama']}}">
                                                    </td>
                                                    <td style="text-align:center;">
                                                        <button type="button" class="btn btn-sm btn-danger removeRow"><i class="fa fa-trash"></i></button>
                                                    </td>
                                                </tr>
                                            </tbody>

                                            @php($i++)
                                        @endforeach
                                    @endif
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

@endpush

@push('scripts')
<script type="text/javascript">

    function rowTable(no){
        var html = '<tr>';
            html += '<td>\
                <input id="alias-'+parseInt(no)+'" name="pelayanan_loket['+no+'][alias]" placeholder="name" type="text" class="form-control required-check " required="">\
            </td>';
            html += '<td>\
                <input id="value-'+parseInt(no)+'" name="pelayanan_loket['+no+'][nama]" placeholder="name" type="text" class="form-control required-check " required="">\
            </td>';
        html += '<td style="text-align:center;">\
            <button type="button" class="btn btn-sm btn-danger removeRow"><i class="fa fa-trash"></i></button>\
        </td>';
        html += '</tr>';

        $('#valueField').append(html);
    }

    $(document).ready(function() {
        var i = parseInt({{ count($data_pelayanan_loket) }});

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
