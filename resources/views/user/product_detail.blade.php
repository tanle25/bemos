@extends('master')
@section('css')
    <link rel="stylesheet" href="{{asset('Plugins/fancybox-master/dist/jquery.fancybox.min.css')}}">
@endsection
@section('title')
    {{ $product->name ?? '' }}
@endsection
@section('content')
    <section class="container p-0">
        <div class="breadcrumb mt-3">
            <ul itemscope="" itemtype="http://schema.org/BreadcrumbList">
                <li><span> <a href="/"> <span>TRANG CHỦ</span> </a> </span> <span class="delimiter">/</span></li>
                @if ($parent != null)
                    <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem"><a
                            class="text-uppercase" href="{{ route('categorymenu.show', $parent->slug) }}"
                            title="BÀN VĂN PHÒNG" itemprop="item"> <span itemprop="name">{{ $parent->name }}</span> </a>
                        <span class="delimiter">/</span>
                        <meta itemprop="position" content="1">
                    </li>
                @endif

                <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem"><a class="text-uppercase"
                        href="{{ route('categorymenu.show', $product->category_slug) }}" title="BÀN VĂN PHÒNG"
                        itemprop="item"> <span itemprop="name">{{ $product->category_name }}</span> </a> <span
                        class="delimiter">/</span>
                    <meta itemprop="position" content="1">
                </li>
                <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem"><strong
                        class="current-item text-uppercase" itemprop="name">{{ $product->name }}</strong> <span
                        itemprop="item" itemscope="" itemtype="http://schema.org/Thing" id="/ban-giam-doc-bmg"> </span>
                    <meta itemprop="position" content="3">
                </li>
            </ul>
        </div>
        <div class="row h-maxcontent">
            <div class="col-md-6">
                <div class="swiper-container gallery-slider">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            {{-- <a href="{{asset($product->avatar)}}" class="fancybox" title="Sample title"><img src="{{ asset($product->avatar) }}" /></a> --}}
                            <a href="{{asset($product->avatar)}}" class="fancybox">
                            <img class=" w-100" src="{{ asset($product->avatar) }}"
                                alt="{{ $product->name }}"></a>
                            </div>
                        @foreach (json_decode($product->images) as $image)
                            <div class="swiper-slide">
                                <a href="{{asset($image)}}" class="fancybox">
                                <img src="{{ asset($image) }}" alt="{{ $product->name }}">
                                </a>
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>

                <div class="swiper-container gallery-thumbs">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide"><img src="{{ asset($product->avatar) }}" alt="{{ $product->name }}">
                        </div>
                        @foreach (json_decode($product->images) as $image)
                            <div class="swiper-slide"><img src="{{ asset($image) }}" alt=""></div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-6 overview">
                <h3 class="text-uppercase pb-3 border-bottom">{{ $product->name }}</h3>
                <p class="short-description">{{ $product->short_description }}</p>
                <div class="font-9 mb-1">
                    @php
                        $avg_star = round($product->reviews->avg('rating'), 1);
                        $total_review = $product->reviews->count();
                    @endphp

                    {{-- <span>{{$avg_star}}</span> --}}

                    <div class="mb-3 text-warning">
                        @for ($i = 0; $i < 5; $i++)
                            @if ($avg_star > $i) @if ($avg_star < $i + 1)
                                <i class="fas fa-star-half-alt"></i>
                            @else
                                <i class="fas fa-star"></i> @endif
                            @else
                                <i class="far fa-star"></i>
                            @endif
                        @endfor
                        @if ($product->reviews->count()>0)
                        <a class="px-2 py-1 text-success mb-3" href="#review">
                            <span> {{ $product->reviews->count() }} </span>
                            Đánh giá
                        </a>
                        @endif

                    </div>
                    @if ($total_review <= 0)
                        <div class="mb-3 product-no-reviews">
                            <a class="text-dark" href="javascript:void(0)" id="myBtn">Hãy là người đầu tiên đánh giá sản phẩm này.</a>
                        </div>

                    @endif
                    <div class="mb-3">
                        <span>Sản phẩm tiêu biểu: NTVP Bàn Giám Đốc</span>
                    </div>

                    <div class="mb-3">
                        <span>Mã SKU: {{ $product->sku }}</span>
                    </div>


                    @if ($product->promotion_price != null)
                        <div class="d-flex justify-content-around" style="width: 300px">
                            <h5><strong class="text-decoration"> {{ number_format($product->price) }} đ</strong></h5>

                            <h5><strong> {{ number_format($product->promotion_price) }} đ</strong></h5>
                        </div>
                    @else
                        <h5><strong> {{ number_format($product->price) }} đ</strong></h5>
                    @endif

                    <div class="row">
                        <div class="col-md-6 col-12 p-0">
                            <form action="{{ route('cart.store') }}" method="post">
                                @csrf
                                <div class="input-group">

                                    <input type="hidden" name="product_name" value="{{ $product->name }}" id="">
                                    <input type="hidden" name="product_sku" value="{{ $product->sku }}" id="">
                                    <input type="hidden" name="product_price" value="{{ $product->price }}" id="">
                                    <input type="hidden" name="product_promotion" value="{{ $product->promotion_price }}"
                                        id="">
                                    <input type="hidden" name="product_id" value="{{ $product->id }}" id="">
                                    <input type="hidden" name="product_avatar" value="{{ asset($product->avatar )}}" id="">
                                    <input type="hidden" name="product_slug" value="{{ $product->slug }}" id="">
                                    <div class="add-to-cart d-flex">
                                        <div class="quantily">
                                            <input class="form-control rounded-0" type="text" value="1" name="quantily" id="">
                                        </div>
                                        <button type="submit" class="btn-addtocart bg-primary-color">Cho vào giỏ hàng</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </section>
    <section class="container p-0">
        <div class="mt-5 image-inner">
            {!! $product->description !!}
        </div>


        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Đánh giá sản phẩm <strong>
                                {{ $product->name }}</strong></h5>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('review.store') }}" class="review-form row">
                            @csrf
                            <div class="col-12">
                                <div class="my-2">
                                    <span class="d-block d-md-inline">Chọn đánh giá của bạn</span>
                                    @for ($i = 1; $i < 6; $i++)
                                        <span class="text-warning rating-star">
                                            <input @if ($i == 5) checked @endif type="radio" name="rating" value="{{ $i }}" class="d-none"
                                                id="star-{{ $i }}">
                                            <label data-star="{{ $i }}" for="star-{{ $i }}"><i
                                                    class="c-pointer fas fa-star"></i></label>
                                        </span>
                                    @endfor
                                </div>
                            </div>
                            <div class="col-12">
                                <textarea name="content" class="@error('content') is-invalid @enderror  form-control" id=""
                                    cols="30" rows="5">{{ old('content') }}</textarea>
                                @error('content')
                                    <div id="" class="error invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <div class="col-12 mt-2">
                                <button id="review"
                                    class="rounded-0 float-right btn btn-success font-9 font-weight-bold">GỬI ĐÁNH
                                    GIÁ</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <section class="container p-0">
        <div class="related-products-grid product-grid">
            <div class="title mt-3 pt-5 border-top"><strong>Có thể bạn quan tâm</strong></div>
            <div class="item-grid row">
                @foreach ($relateds as $related)
                    <div class="col-md-3 col-6">
                        <div class="item-box w-100">
                            <div class="product-item">
                                <div class="picture"><a href="{{ route('detail.show', $related->slug) }}"
                                        title="Hiện chi tiết của {{ $related->name }}"> <img class="m-0 w-100 mh-100"
                                            alt="Hình ảnh của {{ $related->name }}" src="{{ $related->avatar }}"
                                            title="Hiện chi thiết của {{ $related->name }}"> </a></div>
                                <div class="details">
                                    <div class="sku"><a class="text-dark"
                                            href="{{ route('detail.show', $related->slug) }}">{{ $related->sku }}</a></div>
                                    <h2 class="product-title"><a
                                            href="{{ route('detail.show', $related->slug) }}">{{ $related->name }}</a></h2>
                                    <div class="description">{{ $related->short_description }}</div>
                                    <div class="add-info">
                                        <div class="prices"><span
                                                class="price actual-price">{{ number_format($related->price) }} đ</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                @endforeach


            </div>
        </div>
    </section>
    {{-- @dd(json_decode($product->images)) --}}
@endsection
@section('js')
    <script src="{{asset('Plugins/fancybox-master/dist/jquery.fancybox.min.js')}}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script>
        //////STORE TO LOCAL STORAGE

        $(document).ready(function() {
        $('.fancybox').fancybox();
    });

        var id = "{{ $product->id }}";


        var recenly = localStorage.getItem('recenly');
        // localStorage.clear()


        if (recenly == null) {
            var products = new Array();
            products.push(id);
            localStorage.setItem('recenly', JSON.stringify(products));
        } else {
            products = JSON.parse(recenly);

            if (products.indexOf(id) == -1) {
                if (products.length >= 3) {
                    products.shift();
                    products.push(id);
                    localStorage.setItem('recenly', JSON.stringify(products));
                } else {
                    console.log('t');
                    products.push(id);
                    localStorage.setItem('recenly', JSON.stringify(products));
                }
            }
        }







        /////////////
        var slider = new Swiper('.gallery-slider', {
            slidesPerView: 1,
            centeredSlides: true,
            loop: true,
            loopedSlides: 6,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });


        var thumbs = new Swiper('.gallery-thumbs', {
            slidesPerView: 'auto',
            spaceBetween: 10,
            centeredSlides: true,
            loop: true,
            slideToClickedSlide: true,
        });

        //3系
        //slider.params.control = thumbs;
        //thumbs.params.control = slider;

        //4系～
        slider.controller.control = thumbs;
        thumbs.controller.control = slider;

        $('.rating-star input').change(function() {
            let star = $(this).val();
            $('.rating-star label').each(function() {
                if (star >= $(this).data('star')) {
                    $(this).find('i').removeClass('far').addClass('fas');
                } else {
                    $(this).find('i').removeClass('fas').addClass('far');
                }
            })
        })
        @if (auth()->check())
            $("#myBtn").click(function(){
            $("#myModal").modal();
            });
        @else
            $("#myBtn").click(function(){
            swal("Chưa đăng nhập!", "Cần đăng nhập để đánh giá", "warning").then((result)=>{
            if(result){
            location.href = '/auth';
            }
            });
            });
        @endif
    </script>
@endsection
