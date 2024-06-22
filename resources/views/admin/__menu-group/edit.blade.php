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
    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-header">
                <h4>Data Account</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route($pages['edit']['update'], $data) }}" autocomplete="off" id="dataUpdate">
                    @method('PUT')
                    @csrf

                    <div class="row">
                        <div class="col-lg-8">
                            {!! FormText("Name Group", "name", "name group", true, $data->name) !!}
                        </div>

                        <div class="col-lg-2">
                            <label class="form-check pt-4">
                                <input class="form-check-input" type="checkbox" @if($data->is_active == true) checked @endif name="is_active" />
                                <span class="form-check-label"> Active </span>
                            </label>
                        </div>
                    </div>

                    <div class="row no-resource">
                        <div class="col-lg-12">
                            {!! FormText("Description Group", "description", "description group", true, $data->description) !!}
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
<script text="text/javascript">
    $(document).ready(function() {
        value = {!! TextToArray($data->menus) !!};
        $(".select2Form").val(value).trigger('change');
    });
</script>
@endpush
