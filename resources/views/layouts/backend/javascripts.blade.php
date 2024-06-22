<!-- Vendor JS-->
<script src="{{asset('backend/assets/js/vendors/jquery-3.6.0.min.js') }}"></script>
<script src="{{asset('backend/assets/js/vendors/bootstrap.bundle.min.js') }}"></script>
<script src="{{asset('backend/assets/js/vendors/select2.min.js') }}"></script>
<script src="{{asset('backend/assets/js/vendors/perfect-scrollbar.js') }}"></script>
<script src="{{asset('backend/assets/js/vendors/jquery.fullscreen.min.js') }}"></script>
<script src="{{asset('backend/assets/js/vendors/chart.js') }}"></script>

<!-- Main Script -->
<script src="{{asset('backend/assets/js/main.js?v=1.1') }}" type="text/javascript"></script>
<script src="{{asset('backend/assets/js/custom-chart.js') }}" type="text/javascript"></script>

<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

{{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}
<script src="{{asset('vendor/izitoast/dist/js/iziToast.min.js') }}" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>

{{-- <script src="{{asset('vendor/ckeditor5/ckeditor.js') }}"></script> --}}
<script src="{{asset('vendor/ckeditor/ckeditor.js')}}"></script>
<script src="{{asset('vendor/ckeditor/adapters/jquery.js')}}"></script>
<script src="{{asset('vendor/ckeditor/styles.js')}}"></script>


<script type="text/javascript">

    $(document).ready(function() {
        $(window).on("load", function () {
            // $("#preloader-active").delay(450).fadeOut("slow");
            $("body").delay(450).css({
                overflow: "visible"
            });
            $("#onloadModal").modal("show");
        });

        $("#preloader-active").delay(450).fadeOut("slow");
    });
    // Page loading

</script>

<script type="text/javascript">

    @if (session()->has('success'))
        @if(is_array(session('success')))
            @foreach (session('success') as $success)
                message = "{{ $success }}";
            @endforeach
        @else
            message = "{{ session('success') }}";
        @endif

        showToast('green', 'Success', message);
    @endif

    @if (session()->has('error'))
        @if(is_array(session('error')))
            @foreach (session('error') as $error)
                message = "{{ $error }}";
            @endforeach
        @else
            message = "{{ session('error') }}";
        @endif

        showToast('red', 'Error', message);
    @endif

    @if (session()->has('warning'))
        @if(is_array(session('warning')))
            @foreach (session('warning') as $warning)
                message = "{{ $warning }}";
            @endforeach
        @else
            message = "{{ session('warning') }}";
        @endif

        showToast('yellow', 'Warning', message);
    @endif

    @if (session()->has('info'))
        @if(is_array(session('info')))
            @foreach (session('info') as $info)
                message = "{{ $info }}";
            @endforeach
        @else
            message = "{{ session('info') }}";
        @endif

        showToast('blue', 'Info', message);
    @endif

    @if ($errors->any())
        @if(is_array($errors->all()))
            @foreach ($errors->all() as $error)
                // message = "{{ $error }}";
                showToast('red', 'Error', "{{ $error }}");
            @endforeach
        @else
            // message = "{{ $errors->all() }}";
            showToast('red', 'Error', "{{ $errors->all() }}");
        @endif

        // showToast('red', 'Error', message);
    @endif

    function showToast(type, title, message, position = 'topRight') {
        iziToast.show({
            timeout: 5000,
            resetOnHover: true,
            transitionIn: 'flipInX',
            transitionOut: 'flipOutX',
            color: type, // blue, red, green, yellow
            position: position, // bottomRight, bottomLeft, topRight, topLeft, topCenter, bottomCenter, center
            title: title,
            message: message
        });
    }

    $(function () {

    });
</script>


<script src="{{asset('vendor/sweetalert2/dist/sweetalert2.min.js') }}"></script>

<script type="text/javascript">

	$("body").on("click",".remove", function(){

		var current_object = $(this);
		var action = current_object.attr('data-action');
        var dataID = current_object.attr('data-id');

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
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
                        text: 'Data Berhasil dihapus!',
                }).then((result2) => {
                    if (result2.isConfirmed) {
                        location.reload();
                    }
                })

                current_object.closest('tr').remove();

            }
            // else {
            //     Swal.fire({
            //         icon: 'error',
            //         title: 'Oops...',
            //         text: 'Something went wrong!'
            //     })
            // }
        });

	});

    function actionDelete(action,dataID,current_object){

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });

        $.ajax({
            url: action,
            type: 'GET',
            data: {
                "id": dataID,
            },
            success: async function(response){

                await swal("Data has been deleted!", {
                    icon: "success",
                });

                await current_object.closest('tr').remove();

                await location.reload();
            },
            error: function(response){
                swal("Server Error Detected !!", {
                    icon: "error",
                });
            }
        });
    }
</script>

<script src="{{asset('vendor/select2/dist/js/select2.min.js') }}"></script>
<script text="text/javascript">
    $(document).ready(function() {
        $('.select2Form').select2({
            placeholder: "Select Item",
            allowClear: true,
        });
    });
</script>

{{-- Create Function on change session_roles to post ChangeSessionRoles --}}
<script type="text/javascript">
    $(document).ready(function() {
        $('#session_roles').on('change', function() {
            var session_roles = $(this).val();
            console.log(session_roles);
            //ajax csrf token
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                }
            });
            //ajax post
            $.ajax({
                url: "{{ route('admin.user.change_session_role') }}",
                type: "POST",
                data: {
                    session_roles: session_roles,
                },
                success: function(response) {
                    // console.log(response)
                    if (response.success == true) {

                        let timerInterval
                        Swal.fire({
                            icon: 'success',
                            title: '',
                            html: 'Harap Menunggu, halaman akan direct ke role ' + session_roles +'<br> dalam <b></b> milliseconds.',
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: () => {
                                Swal.showLoading()
                                const b = Swal.getHtmlContainer().querySelector('b')
                                timerInterval = setInterval(() => {
                                b.textContent = Swal.getTimerLeft()
                                }, 100)
                            },
                            allowOutsideClick: () => !Swal.isLoading(),
                            willClose: () => {
                                clearInterval(timerInterval)
                            }
                        }).then((result) => {
                            // console.log(response);
                            if (result.dismiss === Swal.DismissReason.timer) {
                                window.location.href = ""+response.route+"";
                            }
                        })
                    }
                },
                error: function(response) {
                    showToast('red', 'Error', response);
                }
            });
        });
    });
</script>

@stack('scripts')
