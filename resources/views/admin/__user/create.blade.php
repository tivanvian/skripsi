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
    <div class="col-md-6 col-sm-12">
        <div class="card mb-4">
            <div class="card-header">
                <h4>Data Account</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route($pages['create']['store']) }}" autocomplete="off" id="dataStore">
                    @csrf

                    {{-- <div class="row">
                        <div class="col-lg-6">
                            {!! FormText("NIK", "nik", "3172020000000000", true) !!}
                        </div>
                        <div class="col-lg-6">
                            {!! FormText("NPP", "npp", "0000000000", true) !!}
                        </div>
                    </div> --}}

                    <div class="row">
                        <div class="col-lg-12">
                            {!! FormText("Name", "name", "Fullname", true) !!}
                        </div>
                        {{-- <div class="col-lg-12">
                            {!! FormText("Phone", "phone", "0831231212", true) !!}
                        </div> --}}
                        <div class="col-lg-12">
                            {!! FormText("Email", "email", "email@email.com", true) !!}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            {!! FormText("Password", "password", "******", true) !!}
                        </div>

                        <div class="col-lg-6">
                            {!! FormText("Password Confirmation", "password_confirmation", "*****", true) !!}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            {!! FormSelect("Role", 'default_role', "-- Chose Role --", $roles) !!}
                        </div>

                        {{-- <div class="col-lg-6">
                            {!! FormSelect("Branch", 'branch_id', "-- Choose Branch --", $branches) !!}
                        </div> --}}
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

@endpush
