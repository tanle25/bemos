@extends('master')
@section('title')
    Trang chủ
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('vendor/owl-carousel/owl.carousel.min.css') }}">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" />
@endsection
@section('content')
    <section class="container-fluid p-0">
        <div class="slider-wrapper theme-custom m-0">
            <div id=nivo-slider class=nivoSlider>
                @foreach ($banners as $banner)
                    <img src="{{ asset($banner->image) }}" data-thumb="{{ asset($banner->image) }}"
                        data-transition="" alt="">
                @endforeach
            </div>
        </div>
    </section>
    <div class="best-selling-wrapper container-fluid mw-100">
        <div class="compnent-title pt-5"><h4>Sản phẩm bán chạy</h4></div>
        <div class="owl-carousel bestselling">
            @foreach ($related_products as $related )
            <a class="product-link" href="{{route('detail.show',$related->slug)}}">
                <div class="mb-2">
                    <div class="card-image"><img class="img-top mh-100"
                            src="{{$related->avatar}}"
                            alt="Hình ảnh của {{$related->name}}"></div>
                    <div class="card-text">
                        <p class="card-name"
                            title="{{$related->name}}">
                            {{$related->name}}</p>
                        <h4 class="card-price font-weight-bold">{{number_format($related->price)}} đ</h4>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>

    <section class="container-fluid p-4 p-mobile-0">
        <div class="popular-brands-wrapper">

            <div id="carousel-popular-brands" class="carousel slide carousel-multi-item v-2 popular-brands"
                data-interval="false">
                <div class="compnent-title">
                    <h4>Nội thất văn phòng</h4>
                    <h6>Những thương hiệu được người tiêu dùng lựa chọn, phổ biến trên thị trường</h6>
                </div>
                <ol class="carousel-indicators popular-brand-indicators">
                    @php
                        $count = 0;
                    @endphp
                    @foreach ($parentCategory as $indicator)
                        <li data-target="#carousel-popular-brands" data-slide-to="{{ $count++ }}" @if ($loop->first) class="active" @endif></li>

                    @endforeach

                </ol>
                @if (Agent::isDesktop())
                <div class="carousel-inner v-2" role="listbox">
                    {{-- $allCategories for all --}}
                    @foreach ($parentCategory as $category)
                        {{-- @dd($category) --}}
                        <div class="row carousel-item @if ($loop->first) active @endif">
                            <div class="col-md-8 brand-image">
                                <a href="{{route('categorymenu.show',$category->slug)}}">
                                    <img class="img-top w-100 lazy" data-src="{{ $category->image }}"
                                        alt="Hình ảnh nhà sản xuất NTVP Bàn Giám Đốc">
                                </a>
                            </div>
                            <div class="col-12 col-md-4 pop-product-list">
                                @foreach ($category->products->take(4) as $product)
                                    <a class="product-link" href="{{route('detail.show',$product->slug)}}">
                                        <div class="row pop-product-item">
                                            <div class="col-sm-4 col-6">
                                                <div class="mb-2">
                                                    <div class="card-image"><img class="img-top w-100 mh-100 lazy"
                                                            data-src="{{ $product->avatar }}" alt="{{ $product->name }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="card-text">
                                                    <p class="card-name" title="">
                                                        {{ $product->name }}</p>
                                                    <h4 class="card-price font-weight-bold">
                                                        {{ number_format($product->price) }}đ</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endforeach

                </div>
                @else
                <div class="carousel-inner v-2" role="listbox">
                    {{-- $allCategories for all --}}
                    @foreach ($parentCategory as $category)
                        {{-- @dd($category) --}}
                        <div class="row carousel-item @if ($loop->first) active @endif">


                                @foreach ($category->products->take(4) as $product)
                                <div class="col-6 pop-product-list">
                                    <a href="{{route('detail.show',$product->slug)}}">
                                        <div class="row pop-product-item">
                                                <div class="col-12 p-0">
                                                    <div class="card-image"><img class="img-top w-100 mh-100 lazy"
                                                            data-src="{{ $product->avatar }}" alt="{{ $product->name }}">
                                                    </div>
                                                </div>
                                            <div class="col-12 p-0">
                                                <div class="card-text">
                                                    <p class="card-name" title="">
                                                        {{ $product->name }}</p>
                                                    <h4 class="card-price font-weight-bold">
                                                        {{ number_format($product->price) }}đ</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                @endforeach

                        </div>
                    @endforeach

                </div>
                @endif
                <a class="carousel-control-prev carousel-control-nav" href="#carousel-popular-brands" role="button"
                    data-slide="prev"> <span class="carousel-control-icon" aria-hidden="true"><i
                            class="fas fa-chevron-left"></i></span> <span class="sr-only"> </span> </a> <a
                    class="carousel-control-next carousel-control-nav" href="#carousel-popular-brands" role="button"
                    data-slide="next"> <span class="carousel-control-icon" aria-hidden="true"> <i
                            class="fas fa-chevron-right"></i></span> <span class="sr-only"></span> </a>
            </div>

        </div>
    </section>


    {{-- @if (Agent::isDesktop()) --}}
        @foreach ($colections as $catagory_name => $colection)
            {{-- @dd($colection) --}}
            <section class="category-section">
                <div class="border-top-width" style="border-top: 2px solid {{$categories->where('name', $catagory_name)->first()->color}} "></div>

                <div class="container">
                    <div class="row ">
                        <div class="col-2 ">
                            <div class="category-title-mobie ">
                                <a href="{{route('categorymenu.show',$categories->where('name', $catagory_name)->first()->slug)}}">
                                <h4 class="text-uppercase text-left"
                                    style="color: {{ $categories->where('name', $catagory_name)->first()->color }}">
                                    {{ $catagory_name }}</h4>
                                </a>
                            </div>
                        </div>
                        <div class="col-3 popular-right-colunm h-100">
                            <img class="mh-100 w-100 lazy"
                                data-src="{{ asset($categories->where('name', $catagory_name)->first()->banner) }}"
                                alt="{{ $catagory_name }}">
                        </div>
                        <div class="col-7" style="padding: 18px 5px">
                            <div class="row">
                                @foreach ($colection as $product)
                                    <div class="col-4 mb-3 thumb">
                                        <a class="product-link" href="{{ route('detail.show', $product->slug) }}">
                                            <img class="w-100 lazy" data-src="{{ asset($product->avatar) }}"
                                                alt="{{ $product->name }}">
                                        </a>
                                        <div class="category-item card-text mt-3">
                                            <a class="product-link" href="{{ route('detail.show', $product->slug) }}">
                                                <p>{{ $product->name }}</p>
                                                @if ($product->promotion_price != null)
                                                    <h4 class="card-price font-weight-bold text-decoration">
                                                        {{ number_format($product->price) }}
                                                        <span>&#8363;</span>
                                                    </h4>
                                                    <h4 class="card-price font-weight-bold">
                                                        {{ number_format($product->promotion_price) }}
                                                        <span>&#8363;</span>
                                                    </h4>
                                                @else
                                                    <h4 class="card-price font-weight-bold">
                                                        {{ number_format($product->price) }}
                                                        <span>&#8363;</span>
                                                    </h4>
                                                @endif
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="border-bottom-width"></div>
            </section>
        @endforeach
    {{-- @else
        @foreach ($categories as $category)
            <section class="container mobile">
                <h3 class="text-center text-uppercase mt-3 mb-3" style="color: {{ $category->color }}">
                    {{ $category->name }}</h3>
                <div style="border-top: 2px solid {{ $category->color }}"></div>

                <div class="row">
                    @foreach ($category->products->take(4)->sortByDesc('created_at') as $product)

                        <div class="col-6 p-2 mb-3">
                            <div class="p-1 border">
                                <a href="{{ route('detail.show', $product->slug) }}">
                                    <div class="thumb border-bottom">

                                        <img class="w-100 lazy" data-src="{{ asset($product->avatar) }}"
                                            alt="{{ $product->name }}">
                                    </div>
                                    <div class="col-12 pt-3">
                                        <h6 class="text-center w-100">{{ $product->name}}</h6>
                                        <div class="text-center">
                                            <span><b>{{ number_format($product->price) }}</b> </span>
                                        </div>
                                        @if ($product->promotion_price != null)
                                            <div class="text-center">
                                                <span class="text-decoration-line-through"> <b>
                                                        {{ number_format($product->promotion_price) }}</b></span>
                                            </div>
                                        @endif

                                    </div>
                                </a>

                            </div>

                        </div>

                    @endforeach
                </div>
            </section>
        @endforeach

    @endif --}}
@endsection

@section('js')
    <script src="{{ asset('js/jquery.lazy-master/jquery.lazy.js') }}"></script>
    <script src="{{ asset('vendor/owl-carousel/owl.carousel.min.js') }}"></script>
    <script>
        $(function() {
            $('.lazy').Lazy();
        });
        $(document).ready(function() {
            $(".owl-carousel").owlCarousel({
                items: 6,
                margin:5,
                nav:true,
                lazyLoad:true,
                navText : ['<i class="fa fa-angle-left" aria-hidden="true"></i>','<i class="fa fa-angle-right" aria-hidden="true"></i>'],
                responsive:{
                        0:{
                            items:2,
                            nav:true
                        },
                        600:{
                            items:2,
                            nav:false
                        },
                        1000:{
                            items:6,
                            nav:true,
                            loop:false
                        }
                    }
            });
        });
    </script>
@endsection
