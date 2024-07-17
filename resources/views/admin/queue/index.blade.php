@extends('layouts.__backend.app')

@section('page-title-bar', isset($pages['title-bar']) ? '| '.$pages['title-bar'] : '| Title Bar')

@section('page-title', isset($pages['page']['index']['title']) ? $pages['page']['index']['title'] : 'Title Page')

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
    <div class="col-sm-8 theme-form">
        @include('admin.__partials.datatable')
    </div>
    <div class="col-sm-4 d-flex justify-content-end align-items-center">
        {!! ButtonAction([], $pages) !!}
    </div>
</div>
@endsection

@section('page-content__body')
<div class="col-md-12 col-sm-12">
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="display" id="table_data" style="width: 99%;">
                    <thead>
                        <tr>
                            @foreach ($tableProperties['columns'] as $table)
                                <th width="{{$table['width']}}">{{$table['label']}}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@push('styles')
@endpush

@push('scripts')
<script type="text/javascript">
    $(function () {

		var table = $('#table_data');

		table.DataTable({
			sDom: 'rt<"row"<"col-sm-4"l><"col-sm-4"i><"col-sm-4"p>>',
			info: false,
            bLengthChange : false,
			responsive: true,
			processing: true,
			serverSide: true,
            sorting: false,
			ajax: "{{ $pages['page']['index']['url'] }}",
			columns: [
                    @foreach ($tableProperties['columns'] as $table)
                        @if($table["slug"] != 'action')
                            {data: '{{$table["slug"]}}', name: '{{$table["slug"]}}'},
                        @else
                            {data: 'action', name: 'action', orderable: false, searchable: false, align: "center"},
                        @endif
                    @endforeach
			],
			columnDefs: [
                @foreach ($tableProperties['columnDefs'] as $defs)
				    { className: '{{$defs["className"]}}', targets: JSON.parse("[{{$defs['targets']}}]") },
                @endforeach
			],
			rowReorder: {
				selector: 'td:nth-child(1)'
			},
		});

		var tablee = $('#table_data').DataTable();

        $('#search').on('keyup', function() {
            tablee.search(this.value).draw();
        });

        $('#status').on('change', function() {
            tablee.search(this.value).draw();
        });

        $('#showing').val(tablee.page.len());
        $('#showing').change( function() {
            tablee.page.len(this.value).draw();
        });

		$.fn.dataTable.ext.errMode = () => tablee.draw();

        $('#search').each(function() {
			$(this).attr('data-remember', $(this).val());
		});

        $('#reset').click(function() {
			$('#search').each(function() {
				$(this).val($(this).attr('data-remember'));
			});

			tablee.search(this.value).draw();
		});

        //refresh on background every 5 second
        setInterval(function() {
            tablee.ajax.reload(null, false);
        }, 10000);

        //btnCall fetch get from data-action
        $(document).on('click', '.btnCall', async function() {
            //cursor not-allowed and disabled button
            $(this).css('cursor', 'not-allowed').attr('disabled', 'disabled');

            var url = $(this).data('action');

            await $.ajax({
                url: url,
                type: 'GET',
                success: function(response) {

                    if(response['success'] == true){
                        //cursor pointer and enabled button
                        $('.btnCall').css('cursor', 'pointer').removeAttr('disabled');

                        iziToast.show({
                            timeout: 5000,
                            resetOnHover: true,
                            transitionIn: 'flipInX',
                            transitionOut: 'flipOutX',
                            color: 'blue', // blue, red, green, yellow
                            position: 'topRight', // bottomRight, bottomLeft, topRight, topLeft, topCenter, bottomCenter, center
                            title: 'Success',
                            message: 'Antrian Berhasil Dipanggil'
                        });
                    } else {
                        iziToast.show({
                            timeout: 5000,
                            resetOnHover: true,
                            transitionIn: 'flipInX',
                            transitionOut: 'flipOutX',
                            color: 'red', // blue, red, green, yellow
                            position: 'topRight', // bottomRight, bottomLeft, topRight, topLeft, topCenter, bottomCenter, center
                            title: 'Error',
                            message: 'Server Error !!'
                        });
                    }
                    
                }
            });
        });


        $("body").on("click",".btnFinish", function(){

        var current_object = $(this);
        var action = current_object.attr('data-action');
        var dataID = current_object.attr('data-id');

        Swal.fire({
            title: 'Apakah Anda Yakin untuk selesaikan Antrian ini ?',
            text: "",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            showLoaderOnConfirm: true,
            preConfirm: () => {
                return fetch(action, {
                    method: "GET",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    }
                })
                .then(response => {

                    if (!response.ok) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: response.statusText
                        })
                    }

                    return response;
                })
            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {

            if (result.isConfirmed && result.value.ok) {

                Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Antrian Selesai',
                }).then((result2) => {
                    if (result2.isConfirmed) {
                        // location.reload();
                        tablee.ajax.reload(null, false);
                    }
                })

                // current_object.closest('tr').remove();

                tablee.ajax.reload(null, false);

            }
        });

        });
	});
</script>
@endpush
