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
    <div class="col-md-8 col-sm-12">
        <div class="card mb-4">

            <div class="card-body">
                <form method="POST" action="{{ route($pages['create']['store']) }}" autocomplete="off" id="dataStore">
                    @csrf

                    <div class="row no-resource">
                        <div class="col-lg-12">
                            {!! FormText("Name Group", "name", "name group", true) !!}
                        </div>
                    </div>

                    <div class="row no-resource">
                        <div class="col-lg-12">
                            {!! FormText("Description Group", "description", "description group", true) !!}
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('styles')

@endpush

@push('scripts')
<script type="text/javascript">
    //if resources unchecked show no-resource
    // $(document).ready(function() {
    //     if ($('input[name="resources"]').is(':checked')) {
    //         $('.no-resource').hide();
    //         $('.required-check').prop('required', false);
    //     } else {
    //         $('.no-resource').show();
    //         $('.required-check').prop('required', true);
    //     }

    //     //on change resources checked
    //     $('input[name="resources"]').change(function() {
    //         if ($(this).is(':checked')) {
    //             $('.no-resource').hide();
    //             $('.required-check').prop('required', false);
    //         } else {
    //             $('.no-resource').show();
    //             $('.required-check').prop('required', false);
    //         }
    //     });
    // });
</script>
@endpush
