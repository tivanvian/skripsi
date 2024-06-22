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
<form method="POST" action="{{ route($pages['edit']['update'], $data) }}" autocomplete="off" id="dataUpdate" enctype="multipart/form-data">
    @method('PUT')
    @csrf

    <div class="row">
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header">
                    <h4>Data Account</h4>
                </div>
                <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                {!! FormText("Email", "email", "email@email.com", true, $data->email) !!}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                {!! FormSelect("Default Role", 'default_role', "-- Chose Role --", $roles, true, $data->getDefaultRole()) !!}
                            </div>

                            <div class="col-lg-12">
                                {!! FormSelect2("User Roles", 'user_role', "-- Select Role --", $multipleRole, true, true, $dataRole) !!}
                            </div>

                            <div class="col-lg-12">
                                {!! FormText("Password", "password", "******", false) !!}
                            </div>

                            <div class="col-lg-12">
                                {!! FormText("Password Confirmation", "password_confirmation", "*****", false) !!}
                            </div>

                            <div class="col-lg-6">
                                <label class="form-check">
                                    <input class="form-check-input" type="checkbox" @if($data->is_confirmed == true) checked @endif name="is_confirmed" />
                                    <span class="form-check-label"> Confirmed </span>
                                </label>
                            </div>

                            <div class="col-lg-6">
                                <label class="form-check">
                                    <input class="form-check-input" type="checkbox" @if($data->is_active == true) checked @endif name="is_active" />
                                    <span class="form-check-label"> Active </span>
                                </label>
                            </div>

                        </div>

                        <div class="row">

                        </div>

                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">
                    <h4>Data Profile</h4>
                </div>
                <div class="card-body">

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="input-upload">
                                    <img src="{{ ($data->UserPhoto() != null) ? Storage::url('profile/'.$data->UserPhoto()) : asset('backend/assets/imgs/theme/upload.svg') }}" alt="" id="image_profile_pictures"/>
                                    <input class="form-control" name="profile_pictures" id="profile_pictures" type="file"/>
                                </div>
                            </div>
                        </div>


                        {{-- <div class="row pt-3">
                            <div class="col-lg-6">
                                {!! FormText("NIK", "nik", "3172020000000000", true, $data->nik) !!}
                            </div>
                            <div class="col-lg-6">
                                {!! FormText("NPP", "npp", "0000000000", true, $data->npp) !!}
                            </div>
                        </div> --}}

                        <div class="row pt-3">
                            <div class="col-lg-8">
                                {!! FormText("Name", "name", "Fullname", true, $data->name) !!}
                            </div>
                            {{-- <div class="col-lg-4">
                                {!! FormText("Phone", "phone", "0831231212", true, $data->phone) !!}
                            </div> --}}
                        </div>

                        {{-- <div class="row">
                            <div class="col-lg-6">
                                {!! FormText("Job Position", "job_position", "Job Position", false, $profile->job_position ?? '') !!}
                            </div>

                            <div class="col-lg-6">
                                {!! FormText("Marital Status", "marital_status", "marital", false, $profile->marital_status ?? '') !!}
                            </div>

                            <div class="col-lg-6">
                                {!! FormSelect("Gender", 'gender', "-- Choose Gender --", $genders, false, $profile->gender ?? '') !!}
                            </div>

                            <div class="col-lg-6">
                                {!! FormText("About", "about", "about", false, $profile->about ?? '') !!}
                            </div>

                            <div class="col-lg-6">
                                {!! FormText("Place of Birth", "place_of_birth", "Place of Birth", false, $profile->place_of_birth ?? '') !!}
                            </div>

                            <div class="col-lg-6">
                                {!! FormDate("Date of Birth", "date_of_birth", "Date of Birth", false, false, $profile->date_of_birth ?? '') !!}
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="identity_address">Identity Address</label>
                                    <textarea class="form-control w-100" name="identity_address" id="identity_address" rows="2" placeholder="Identity Address">{{ $profile->identity_address ?? '' }}</textarea>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                {!! FormSelect("Identity Region", 'identity_region_id', "-- Choose Region --", $regions, false, $profile->identity_region_id ?? '') !!}
                            </div>

                        </div> --}}

                        <hr>

                        {{-- <div class="row">
                            <div class="col-lg-6">
                                {!! FormText("Office Type", "office_type", "Office", false, $profile->office_type ?? '') !!}
                            </div>

                            <div class="col-lg-6">
                                {!! FormText("Office Name", "office_name", "Office Name", false, $profile->office_name ?? '') !!}
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="office_address">Identity Address</label>
                                    <textarea class="form-control w-100" name="office_address" id="office_address" rows="2" placeholder="Office Address">{{ $profile->office_address ?? '' }}</textarea>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                {!! FormSelect("Office Region", 'office_region_id', "-- Choose Region --", $regions, false, $profile->office_region_id ?? '') !!}
                            </div>

                            <div class="col-lg-6">
                                {!! FormText("Office Postal Code", "office_postal_code", "Postal Code", false, $profile->office_postal_code ?? '') !!}
                            </div>
                        </div> --}}




                </div>
            </div>
        </div>
    </div>

</form>
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
        value = {!! TextToArray($dataRole) !!};
        $(".select2Form").val(value).trigger('change');

        //if profile_pictures changes to image_profile_pictures
        $("#profile_pictures").change(function() {
            readURL(this, '#image_profile_pictures');
        });

        //readURL
        function readURL(input, id) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $(id).attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    });
</script>
@endpush
