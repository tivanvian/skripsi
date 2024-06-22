<!-- Vendor JS-->
<script src="{{asset('frontend/assets/js/vendor/modernizr-3.6.0.min.js') }}"></script>
<script src="{{asset('frontend/assets/js/vendor/jquery-3.6.0.min.js') }}"></script>
<script src="{{asset('frontend/assets/js/vendor/jquery-migrate-3.3.0.min.js') }}"></script>
<script src="{{asset('frontend/assets/js/vendor/bootstrap.bundle.min.js') }}"></script>
<script src="{{asset('frontend/assets/js/plugins/slick.js') }}"></script>
<script src="{{asset('frontend/assets/js/plugins/jquery.syotimer.min.js') }}"></script>
<script src="{{asset('frontend/assets/js/plugins/wow.js') }}"></script>
<script src="{{asset('frontend/assets/js/plugins/perfect-scrollbar.js') }}"></script>
<script src="{{asset('frontend/assets/js/plugins/magnific-popup.js') }}"></script>
<script src="{{asset('frontend/assets/js/plugins/select2.min.js') }}"></script>
<script src="{{asset('frontend/assets/js/plugins/waypoints.js') }}"></script>
<script src="{{asset('frontend/assets/js/plugins/counterup.js') }}"></script>
<script src="{{asset('frontend/assets/js/plugins/jquery.countdown.min.js') }}"></script>
<script src="{{asset('frontend/assets/js/plugins/images-loaded.js') }}"></script>
<script src="{{asset('frontend/assets/js/plugins/isotope.js') }}"></script>
<script src="{{asset('frontend/assets/js/plugins/scrollup.js') }}"></script>
<script src="{{asset('frontend/assets/js/plugins/jquery.vticker-min.js') }}"></script>
<script src="{{asset('frontend/assets/js/plugins/jquery.theia.sticky.js') }}"></script>
<script src="{{asset('frontend/assets/js/plugins/jquery.elevatezoom.js') }}"></script>
<!-- Template  JS -->
<script src="{{asset('frontend/assets/js/main.js?v=5.5') }}"></script>
<script src="{{asset('frontend/assets/js/shop.js?v=5.5') }}"></script>

<script src="{{asset('vendor/izitoast/dist/js/iziToast.min.js') }}" type="text/javascript"></script>



<script type="text/javascript">

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
</script>

@guest
@else
<script type="text/javascript">
    //fetch count cart
    async function fetch_count_cart() {
        $.ajax({
            url: "{{ route('product.getCartData') }}",
            method: "GET",
            success: function (data) {

                //data count to span cartCount
                $('.cartCount').html(data.count);

                //data.dataCart to cartList
                var html = '';
                if(data.dataCart.length == 0){
                    html += '<li>';
                    html += '<div class="shopping-cart-title">';
                    html += '<h4><a href="#">No Item</a></h4>';
                    html += '</div>';
                    html += '</li>';
                } else {
                    $.each(data.dataCart, function(key, value) {
                        // console.log([key, value, value.product_unit_name, value.qty, value.product.name]);\
                        var url = value.image;
                        html += '<li>';
                        html += '<div class="shopping-cart-img">';
                        html += '<a href="#"><img alt="Nest" src="'+url+'" /></a>';
                        html += '</div>';
                        html += '<div class="shopping-cart-title">';
                        html += '<h4><a href="#">'+value.product.name+'</a></h4>';
                        html += '<h4><a href="#">'+value.product_unit_name+'</a></h4>';
                        html += '<h4><span>'+value.qty+' x</span></h4>';
                        html += '</div>';
                        html += '</li>';
                    });

                }


                $('#listCart').html(html);
                $('#listCartMoblie').html(html);

            }
        });
    }

    fetch_count_cart();
</script>

<script src="{{asset('vendor/sweetalert2/dist/sweetalert2.min.js') }}"></script>
@endguest

<script type="text/javascript">
    //fetch params category
    async function fetchParamsCategory() {
        $.ajax({
            url: "{{ route('params.category') }}",
            method: "GET",
            success: function (data) {
                // data to option_category

                var html = '';
                html += '<option value="all">All Category</option>';
                $.each(data, function(key, value) {
                    html += '<option value="'+value.id+'">'+value.name+'</option>';
                });

                $('#option_category').html(html);

            }
        });
    }

    fetchParamsCategory();

    //option_category on change
    $('#option_category').on('change', function() {
        var category = $(this).val();
        console.log(category);
    });
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js">
</script>
<script type="text/javascript">
    var route = "{{ route('product.get') }}";

    var $input = $('#search');

    $input.typeahead({
        scrollHeight: '100',
        autoSelect: true,
        openLinkInNewTab: true,
        source: function (query, process) {
            var category = $('#option_category').val();
            return $.get(route, {
                query: query,
                category: category
            }, function (data) {

                map = {};
                items = [];

                var dataItems = data.data;
                // console.log(dataItems);
                $.each(dataItems, function (i, item) {
                    map[item.name] = item;
                    items.push(item.name);
                });

                // map['all'] = {
                //     slug: 'all',
                //     name: 'Lihat Semua',
                //     category: 'all',
                //     url : "/"
                // };

                // items.push("all");
                // console.log(map);
                // console.log(items);
                process(items);
            })
        },highlighter: function(item) {;
            // console.log('===========');
            // console.log(item);
            html = '';
            html += '<div class="d-flex" style="width:510px; z-index:10000 !important;">';
                html += '<div class="product-img product-img-zoom" style="margin-top:5px; margin-left:-6px;">';
                    html += '<a href="'+map[item].url+'">';
                        html += '<img class="img-sm-2 img-thumbnail" src="'+map[item].image+'" alt="" />';
                    html += '</a>';
                html += '</div>';
                html += '<div class="" style="display: flex; align-items: center; justify-content: center; flex-direction: column !important;">';
                    html += '<a href="'+map[item].url+'" style="margin-left:15px;">'+item+'</a>';
                    // html += '<br>';
                    html += '<span style="margin-top:-5px; margin-left:5px; font-size:9pt;" class="text-muted">'+map[item].category+'</span>';
                html += '</div>';
            html += '</div>';
            // html += '</li>';
            // console.log(item);
            // console.log(map['all']);
            return (html);
        },updater: function(item){
            location.href = map[item].url;
            return '';
        },displayText: function (item) {
            console.log(item);
            return item;
        }
    });

    // $input.change(function() {
    // var current = $input.typeahead("getActive");
    // if (current) {
    //     // Some item from your model is active!
    //     if (current.name == $input.val()) {
    //     // This means the exact match is found. Use toLowerCase() if you want case insensitive match.
    //     } else {
    //     // This means it is only a partial match, you can either add a new item
    //     // or take the active if you don't want new items
    //     }
    // } else {

    //     // if empty
    //     // console.log('not found');

    //     console.log('not found');
    //     $input.typeahead({
    //         source: [
    //             {id: "someId1", name: "Display name 1"},
    //             {id: "someId2", name: "Display name 2"}
    //         ],
    //         autoSelect: true
    //     });
    //     // html = '';
    //     // html += '<li>';
    //     //     html += '<a class="dropdown-item" href="#" role="option">';
    //     //         html += '<div class="d-flex" style="width:510px; z-index:10000 !important;">';
    //     //             html += '<div class="" style="display: flex; align-items: center; justify-content: center; flex-direction: column !important;">';
    //     //                 html += 'Item Not Found';
    //     //             html += '</div>';
    //     //         html += '</div>';
    //     //     html += '</a>';
    //     // html += '</li>';

    //     //Apend to typeahead
    //     // $('.typeahead').html(html);
    //     // return (html);
    // }
    // });
</script>

@stack('scripts')
