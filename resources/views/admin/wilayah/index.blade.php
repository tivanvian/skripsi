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
        {!! ButtonAction(['create'], $pages) !!}
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

	});
</script>
@endpush
