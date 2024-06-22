@extends('landing')

@push('styles')
@endpush

@section('content')
<main class="main">

    <section class="home-slider position-relative">
        <div class="container">
            <div class="home-slide-cover mt-30">
                <div class="hero-slider-1 style-4 dot-style-1 dot-style-1-position-1">
                    @foreach ($sliders as $slider)
                        <a href="{{ ($slider->link != null) ? $slider->link : '#' }}" @if($slider->link == null) disabled style="cursor: default;" @else target="_blank" @endif>
                            <div class="single-hero-slider single-animation-wrap" style="background-image: url({{ ($slider->SliderPhoto() != null) ? Storage::url('slider/'.$slider->SliderPhoto()) : asset('frontend/assets/imgs/slider/slider-1.png') }})">
                            </div>
                        </a>
                    @endforeach
                </div>
                <div class="slider-arrow hero-slider-1-arrow"></div>
            </div>
        </div>
    </section>

    <section class="bg-grey-1 section-padding pt-100 pb-80">
        <div class="container">

            <div class="row product-grid" id="product_list">

            </div>

            <div class="pagination-area mt-20 mb-20">
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center" id="product_paging">

                    </ul>
                </nav>
            </div>
        </div>
    </section>
</main>
@endsection

@push('styles')
<style>
    ul.slick-dots{
        bottom: -40px !important;
    }
</style>
@endpush

@push('scripts')
<script type="text/javascript">

    $(document).ready(function() {
        renderProduct();
    });

    async function renderProduct(page = '{{ route("product.get") }}'){
        //Preloader
        await $('#preloader-active').show();

        // ajax Header
        await $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        await $.ajax({
            url: page,
            type: "GET",
            success: function(data) {

                //Render Data list
                var html = '';
                $.each(data.data, function(key, value) {
                    html += '<div class="col-lg-1-5 col-md-4 col-12 col-sm-6">';
                    html += '<div class="product-cart-wrap mb-30">';
                    html += '<div class="product-img-action-wrap">';
                        html += '<div class="product-img product-img-zoom">';
                            html += '<a href="'+value.url+'">';
                                html += '<img class="img-lg img-thumbnail" src="'+value.image+'" alt="" />';
                            html += '</a>';
                        html += '</div>';
                    html += '</div>';
                    html += '<div class="product-content-wrap">';
                    html += '<div class="product-category" style="margin-left:6px; margin-top:5px;">';
                    html += '<a href="'+value.url+'">'+value.category+'</a>';
                    html += '</div>';
                    html += '<h2 style="margin-left:6px; margin-top:5px;"><a href="'+value.url+'">'+value.name+'</a></h2>';
                    html += '<div class="product-card-bottom">';
                    html += '<div class="add-cart">';
                    // html += '<a class="add" href="shop-cart.html"><i class="fi-rs-shopping-cart mr-5"></i>Add </a>';
                    html += '<a class="add" href="'+value.url+'" style="margin-left:6px; margin-top:5px;">Detail </a>';
                    html += '</div>';
                    html += '</div>';
                    html += '</div>';
                    html += '</div>';
                    html += '</div>';
                });

                $("#product_list").html(html);

                //Paging HTML
                var paging = '';

                if(data.prev_page_url !== null){
                    paging += '<li class="page-item">\
                                <a class="page-link" onclick=renderProduct("'+data.prev_page_url+'")><i class="fi-rs-arrow-small-left"></i></a>\
                            </li>';
                }

                paging += '<li class="page-item active"><a class="page-link" href="#">'+data.current_page+'</a></li>';

                if(data.next_page_url !== null){
                    paging += '<li class="page-item">\
                                <a class="page-link" onclick=renderProduct("'+data.next_page_url+'")><i class="fi-rs-arrow-small-right"></i></a>\
                            </li>';
                }

                $("#product_paging").html(paging);
            },
        });

        //hide Preloader
        await $("#preloader-active").fadeOut("slow");
    }


</script>
@endpush
