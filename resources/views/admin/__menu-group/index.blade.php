@extends('layouts.backend.main')

@section('content-title', $pages['title'] ?? '-')

@section('content-header')
<div class="content-header">
    <div>
        <h2 class="content-title card-title">{{ $pages['title'] ?? '-' }}</h2>
        <p>{{ $pages['description'] ?? '-' }}</p>
    </div>
    @if(in_array('create', CheckAccess()))
        <div>
            <a href="{{ route($pages['create']['url']) }}" class="btn btn-primary"><i class="material-icons md-plus"></i> Create new</a>
        </div>
    @else
    @endif

</div>
@endsection


@section('content-body')
<div class="card mb-4">
    <header class="card-header">
        <div class="row gx-3">
            <div class="col-lg-4 col-md-6 me-auto">
                <input type="text" autocomplete="none" name="search" id="search" class="form-control" placeholder="{{ __('Search...') }}">
            </div>
            <div class="col-lg-2 col-md-3 col-6">
                <select class="form-select" id="status">
                    <option value="">All</option>
                    <option value="true">Active</option>
                    <option value="false">Inactive</option>
                </select>
            </div>
            <div class="col-lg-2 col-md-3 col-6">
                <select class="form-select" id="showing" name="table_data_length" aria-controls="table_data">
                    <option value="10">Show 10</option>
                    <option value="25">Show 25</option>
                    <option value="50">Show 50</option>
                    <option value="100">Show 100</option>
                </select>
            </div>
        </div>
    </header>
    <!-- card-header end// -->
    <div class="card-body">
        <div class="table-responsive">
            <!-- table-responsive.// -->

            <div class="table-responsive">
                <table class="table table-hover" id="table_data" style="width: 99%;">
                    <thead>
                        <tr>
                            <th width="30%">{{__('Name') }}</th>
                            <th width="40%">{{__('Description') }}</th>
                            <th width="15%">{{__('Status Active') }}</th>
                            <th width="15%">{{__('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- card-body end// -->
</div>

@endsection

@push('styles')
<style>
    .page-item.active .page-link{
        background: #3BB77E !important;
        border-color: #3BB77E !important;
        color: #fff !important;
    }
</style>
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
			ajax: "{{ route($pages['index']) }}",
			columns: [
                    // {data: 'DT_RowIndex', name: 'DT_RowIndex'},
					{data: 'name', name: 'name'},
					{data: 'description', name: 'description'},
                    {data: 'status', name: 'status'},
					{data: 'action', name: 'action', orderable: false, searchable: false, align:"center"},
			],
			columnDefs: [
				{ className: 'text-center', targets: [2, 3] },
			],
			rowReorder: {
				selector: 'td:nth-child(1)'
			},
            // pagingType : "simple",
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

	});
</script>
@endpush
