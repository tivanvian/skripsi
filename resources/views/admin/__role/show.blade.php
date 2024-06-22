@extends('layouts.backend.main')

@section('content-title', $pages['show']['title'] ?? '-')

@section('content-header')
<div class="content-header">
    <a href="{{ route($pages['index']) }}" class="btn btn-sm btn-brand"><i class="material-icons md-arrow_back"></i> Go back </a>
</div>
@endsection


@section('content-body')
<div class="card mb-4">
    <div class="card-header bg-brand-2" style="height: 150px"></div>
    <div class="card-body">
        <div class="row">
            <div class="col-xl col-lg flex-grow-0" style="flex-basis: 230px">
                <div class="img-thumbnail shadow w-100 bg-white position-relative text-center" style="height: 190px; width: 200px; margin-top: -120px">
                    <img src="{{ asset("backend/assets/imgs/people/avatar-2.png") }}" class="center-xy img-fluid" alt="Logo Brand" />
                </div>
            </div>
            <!--  col.// -->
            <div class="col-xl col-lg">
                <h3>{{ $data->name }}</h3>
                <p>NIK : {{ $data->nik }} | NPP : {{ $data->npp }}</p>
            </div>
            <!--  col.// -->
            <div class="col-xl-4 text-md-end">
                {!! ButtonEdit(["url" => route($pages['edit']['url'], $data), "label" => "Edit Profile", "icon" => "md-launch"]) !!}
                {{-- <a href="{{ route($pages['edit']['url'], $data) }}" class="btn btn-sm btn-brand"><i class="material-icons md-launch"></i> Update Profiles</a> --}}
            </div>
            <!--  col.// -->
        </div>
        <!-- card-body.// -->
        <hr class="my-4" />
        <div class="row g-4">
            <!--  col.// -->
            <div class="col-sm-6 col-lg-4 col-xl-3">
                <h6>Contacts</h6>
                <p>
                    Manager: Jerome Bell <br />
                    info@example.com <br />
                    (229) 555-0109, (808) 555-0111
                </p>
            </div>
            <!--  col.// -->
            <div class="col-sm-6 col-lg-4 col-xl-3">
                <h6>Address</h6>
                <p>
                    Country: California <br />
                    Address: Ranchview Dr. Richardson <br />
                    Postal code: 62639
                </p>
            </div>
            <!--  col.// -->
            <!--  col.// -->
        </div>
        <!--  row.// -->
    </div>
    <!--  card-body.// -->
</div>
@endsection

@push('styles')

@endpush

@push('scripts')

@endpush
