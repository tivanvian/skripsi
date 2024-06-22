@stack('scripts')
<script text="text/javascript">
    var select2 = document.getElementsByClassName('select2-dropdown');

    //add select2mt20 to select2
    for (var i = 0; i < select2.length; i++) {
        select2[i].classList.add('select2mt20');
    }
</script>


<script src="{{asset('vendor/select2/dist/js/select2.min.js') }}"></script>
<script text="text/javascript">
    $(document).ready(function() {
        $('.select2Form').select2({
            placeholder: "Select Item",
            allowClear: true,
            // tags: true,
            // templateResult: function(data) {
            //     console.log({data})
            //     return $(data.text);
            // },

            // templateSelection: function(data) {
            //     return $(data.text);
            // }
        });
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

<script src="{{asset('vendor/izitoast/dist/js/iziToast.min.js') }}" type="text/javascript"></script>
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



<script type="text/javascript">
    var url = "{{ route('change.lang') }}";

    $('#changeLangEN').on('click', function() {
        window.location.href = url + "?lang=en";
    });

    $('#changeLangID').on('click', function() {
        window.location.href = url + "?lang=id";
    });
</script>



{{-- Create Function on change session_roles to post ChangeSessionRoles --}}
<script type="text/javascript">
    function changeRole(role){
        var session_roles = role;
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
    }

    $(document).ready(function() {
        $('#session_roles').on('change', function() {
            changeRole($(this).val());
        });
    });
</script>
