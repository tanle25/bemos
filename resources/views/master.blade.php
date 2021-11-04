<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="google-site-verification" content="CQt6BWXxP1tytIHbJ0sOMjKmG0f8S0-NpxYJf-cXo7Y" />
    <!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-KPFXNNJ');</script>
    <!-- End Google Tag Manager -->

@php
header('Access-Control-Allow-Origin: *');    
@endphp
    {!! app('seotools')->generate() !!}

    <link href=https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css rel=stylesheet>
    <link rel="stylesheet" href="{{ asset('css/fontawesome-pro/css/all.min.css') }}">
    <link href="{{ asset('Plugins/Widgets.NivoSlider/Content/nivoslider/nivo-slider.css') }}" rel=stylesheet>
    <link href="{{ asset('Plugins/Widgets.NivoSlider/Content/nivoslider/themes/custom/custom.css') }}" rel=stylesheet>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{asset('css/swiper.min.css')}}" />
    @yield('css')
    <link rel="stylesheet" href="{{asset('Plugins/sweetalert2/sweetalert2.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="{{ asset('css/page_default.css') }}" rel=stylesheet>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.9/css/mdb.min.css" rel="stylesheet">
    <link rel="shortcut icon" href={{$theme->favicon}}>
    <style>
        .autocomplete-suggestions {
            border: 1px solid #999;
            background: #FFF;
            overflow: auto;
        }

        .autocomplete-suggestion {
            padding: 2px 5px;
            white-space: nowrap;
            overflow: hidden;
        }

        .autocomplete-selected {
            background: #F0F0F0;
        }

        .autocomplete-suggestions strong {
            font-weight: normal;
            color: #3399FF;
        }

        .autocomplete-group {
            padding: 2px 5px;
        }

        .autocomplete-group strong {
            display: block;
            border-bottom: 1px solid #000;
        }

    </style>
    <title>@yield('title')</title>
</head>

<body>
    <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KPFXNNJ"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    @include('user.partials.header')
    <main class="main-home">
        @if (Agent::isDesktop())
            <div class="container w-100 bg-white header position-sticky sticky-top mt-3 pl-0 pr-0 border border-right-0">
                <nav class="navbar navbar-expand-sm navbar-light p-0  position-relative shadow-none" style="height: 50px">

                    <ul class="navbar-nav d-flex mr-auto header-expandable-menu h-100">
                        <li id="mega-button" class="nav-item dropdown has-megamenu">
                            <a class="nav-link dropdown-toggle text-white  h-100" href="javascript:void(0)" style="line-height: 35px"><i
                                    class="fa text-white fa-align-justify"></i>
                                </a>
                        </li>
                        <li class="nav-item shopcard-button"><a class="nav-linktext-uppercase text-white"
                                href="{{route('cart.index')}}"><i class="fa text-white fa-cart-arrow-down"></i></a>
                        </li>
                    </ul>
                    <div class="container-fluid pl-0 h-100">
                        <div class="collapse navbar-collapse h-100" id="navbarTogglerDemo03">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0 parent-menu-desktop h-100">
                                @if ($menus !=null)
                                @foreach ($menus as $menu)
                                    <li class="nav-item position-relative">
                                        <a class="parent-category nav-link active text-uppercase" aria-current="page"
                                            href="{{ route('categorymenu.show', $menu->slug) }}">{{ $menu->name }}</a>
                                        {{-- @dd($menu->categories) --}}
                                        @if ($menu->categories()->first() != null)
                                            <ul class="child-menu-desktop border">
                                                @foreach ($menu->categories as $sub_menu)
                                                    {{-- @dd($sub_menu) --}}
                                                    <li><a class="text-dark"
                                                            href="{{ route('categorymenu.show', $sub_menu->slug) }}">{{ $sub_menu->name }}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach
                                @endif

                                @if ($pages !=null)
                                    @foreach ($pages as $page )
                                    @if ($page->childs->first() !=null)
                                    <li class="nav-item position-relative">
                                        <a class="parent-category nav-link active text-uppercase" aria-current="page"
                                            href="{{ route('pages.show',$page->slug) }}">{{$page->title}}</a>
                                            <ul class="child-menu-desktop border">
                                                @foreach ($page->childs as $child)
                                                    {{-- @dd($sub_menu) --}}
                                                    <li><a class="text-dark"
                                                            href="{{ route('pages.show', $child->slug) }}">{{ $child->title }}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                    </li>
                                    @else
                                    <li class="nav-item ">
                                        <a class="parent-category nav-link active text-uppercase" aria-current="page"
                                            href="{{ route('pages.show',$page->slug) }}">{{$page->title}}</a>
                                    </li>
                                    @endif
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                </nav>
                <div class="container-fluid">
                    <div class="row w-100 position-absolute mega-menu-wraper bg-white border d-none">
                        {{-- @if ($menus !=null) --}}
                        @foreach ($megaMenu as $menu)
                        <div class="col-md-3 border text-left">
                            <h6 class="mt-2 font-weight-bold">
                                <a class="text-uppercase" href="{{route('categorymenu.show',$menu->slug)}}">{{ $menu->name }}</a>
                            </h6>
                            @if ($menu->categories()->first() != null)
                                <ul class="mt-2 mb-2 mega-menu-item">
                                    @foreach ($menu->categories as $submenu)
                                        <li> <a class="text-uppercase "
                                                href="{{route('categorymenu.show',$submenu->slug)}}">{{ $submenu->name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    @endforeach
                        {{-- @endif --}}

                    </div>
                </div>

            </div>
        @endif
        <div class="collapse navbar-collapse nav-bar-mobile h-100 bg-dark" id="navbarTogglerDemo03">
            <nav class="sidebar card py-2 mb-4 h-100 bg-dark">
                @if (Auth::check())
                <div class="row pt-3 pb-3 border-bottom">
                    <div class="col-3 pr-0"><img class="rounded-circle w-100" src="{{asset('img/avatar.png')}}" alt=""></div>
                    <div class="col-9 mobile-user">
                        <h4 class="text-white">{{Auth::user()->last_name. ' '.Auth::user()->first_name}}</h4>
                        <span class="text-white">{{Auth::user()->email}}</span>
                    </div>
                </div>
                @endif

                <ul class="nav flex-column mt-3" id="nav_accordion">
                    @if ($menus != null)
                        @foreach ($menus as $menu)
                        <li class="nav-item has-submenu">
                            <a class="nav-link text-uppercase" href="{{ route('categorymenu.show', $menu->slug) }}">
                                {{ $menu->name }} <i class="fas fa-chevron-right ml-2 rotate-none text-white"></i></a>
                            @if ($menu->categories->first() != null)
                                <ul class="submenu collapse">
                                    @foreach ($menu->categories as $sub_menu)
                                        <li><a class="nav-link text-uppercase"
                                                href="{{ route('categorymenu.show', $sub_menu->slug) }}">{{ $sub_menu->name }}</a>
                                        </li>

                                    @endforeach
                                </ul>
                            @endif

                        </li>
                    @endforeach
                    @endif

                    {{-- <li class="nav-item">
                        <a class="nav-link text-uppercase" href="{{ route('introduce') }}"> giới thiệu </a>
                    </li> --}}
                    @if ($pages !=null)
                    @foreach ($pages as $page )
                    @if ($page->childs->first() !=null)
                    <li class="nav-item has-submenu">
                        <a class="nav-link text-uppercase" aria-current="page"
                            href="{{ route('pages.show',$page->slug) }}">{{$page->title}}<i class="fas fa-chevron-right ml-2 rotate-none text-white"></i></a>
                            <ul class="submenu collapse">
                                @foreach ($page->childs as $child)
                                    {{-- @dd($sub_menu) --}}
                                    <li><a class="nav-link text-uppercase"
                                            href="{{ route('pages.show', $child->slug) }}">{{ $child->title }}</a>
                                    </li>
                                @endforeach
                            </ul>
                    </li>
                    @else
                    <li class="nav-item ">
                        <a class="nav-link text-uppercase" aria-current="page"
                            href="{{ route('pages.show',$page->slug) }}">{{$page->title}}</a>
                    </li>
                    @endif
                @endforeach
                    @endif

                    <li class="nav-item">
                        <a class="nav-link text-uppercase" href="{{route('user.listPost')}}"> Tin tức </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-uppercase" href="{{route('user.showcontact')}}"> Mua sỉ </a>
                    </li>
                </ul>
                <ul class="mt-2 pl-3 pt-2 mb-3 border-top">
                    @if (Auth::check())
                    <li>
                        <a class="nav-link text-uppercase" href="{{route('auth.logout')}}"><i class="fas fa-sign-out-alt text-white"></i> Đăng xuất </a>
                    </li>
                    @else
                    <li>
                        <a class="nav-link text-uppercase" href="{{route('auth')}}"> <i class="fas fa-sign-in-alt text-white"></i> Đăng nhập </a>
                    </li>
                    <li>
                        <a class="nav-link text-uppercase" href="{{route('user.auth.register')}}"><i class="fas fa-user-plus text-white"></i> Đăng ký</a>
                    </li>
                    @endif
                </ul>
            </nav>
        </div>
        @yield('content')
    </main>
    <footer class="container-fluid bg-dark mt-5 p-0">
        <div class="container pt-4 pb-5">
            <div class="row">
                <div class="col-md-6">
                    <h4 class="text-uppercase text-white">THÔNG TIN LIÊN HỆ</h4>
                    <h6 class="text-white mb-3">{{$theme->site_name}}</h6>
                    <p class="text-white mb-3">{{$theme->desciption ?? ''}}</p>
                    <div class="mb-2">
                        <strong class="text-white"><i class="fas fa-map-marker-check mr-2 text-white"></i> Showroom:</strong> <span class="text-white font-14">{{$theme->address ?? ''}}</span>
                    </div>
                    <div class="mb-3">
                        <strong class="text-white"><i class="fas fa-map-marker-check mr-2 text-white"></i> Nhà máy:</strong> <span class="text-white font-14">{{$theme->factory_address ?? ''}}</span>
                    </div>
                    <div class="mb-3">
                        <strong class="text-white"><i class="fal fa-phone-rotary mr-2 text-white"></i> Hotline:</strong> <span class="text-white font-14"><a class="text-white footer-links" href="tel:+84{{Str::remove(' ',Str::replaceFirst('0', '',$theme->hotline))}}">{{$theme->hotline ?? ''}}</a></span>
                    </div>
                    <div class="mb-3">
                        <strong class="text-white"><i class="fal fa-phone-rotary mr-2 text-white"></i> Điện thoại:</strong> <span class="text-white font-14"><a class="text-white footer-links" href="tel:+84{{Str::remove(' ',Str::replaceFirst('0', '',$theme->phone))}}">{{$theme->phone ?? ''}}</a></span>
                    </div>
                    <div class="mb-3">
                        <strong class="text-white"><i class="fal fa-phone-rotary mr-2 text-white"></i> Phòng kinh doanh:</strong> <span class="text-white font-14"> <a class="text-white footer-links" href="tel:+84{{Str::remove(' ',Str::replaceFirst('0', '',$theme->maketing_phone))}}"> {{$theme->maketing_phone ?? ''}}</a></span>
                    </div>
                    <div>
                        <strong class="text-white"><i class="fal fa-envelope mr-2 text-white"></i> Email:</strong> <span class="text-white font-14"> <a class="text-white footer-links" href="mailto:">{{$theme->email ?? ''}}</a></span>
                    </div>
                </div>
                <div class="col-md-6 text-center footer-right">
                    <h4 class="text-uppercase text-white">KẾT NỐI VỚI CHÚNG TÔI</h4>
                    <a href="{{$theme->skype}}" class="icon-button twitter"><i class="fab fa-skype"></i><span></span></a>
                    <a href="{{$theme->facebook}}" class="icon-button facebook"><i class="fab fa-facebook-f"></i><span></span></a>
                    <a href="{{$theme->google}}" class="icon-button google-plus"><i class="fab fa-google"></i><span></span></a>
                    <a href="{{$theme->youtube}}" class="icon-button youtube"><i class="fab fa-youtube"></i><span></span></a>
                    <a href="#" class="icon-button pinterest"><i class="fab fa-instagram"></i><span></span></a>
                </div>
            </div>
<div class="mt-3 pt-3 text-white text-center border-top">
               <h6 class="text-white">CÔNG TY CỔ PHẦN VINASAGO</h6> <span class="text-white">MST 2802944020. Do sở kế hoạch và đầu tư tỉnh thanh hoá cấp. cấp ngày 21 tháng 6 năm 2021</span>
            </div>
        </div>
    </footer>
    <div class="main-sidebar">
        <ul class="m-0">
            <li><a class="product-link" class="text-dark d-flex flex-column" href="{{route('user.listPost')}}">
                <i class="fa fa-bullhorn"></i>
                <span> Tin tức</span></a>
            </li>
            <li>  <a class="product-link" href="#">
                <i class="fa fa-question-circle"></i>
                <span> Hỏi đáp</span></a>
            </li>
            <li><a class="product-link" class="text-dark d-flex flex-column" href="{{route('user.showcontact')}}">
                <i class="fa fa-bars"></i>
                Mua sỉ</a>
            </li>
            <li> <a class="product-link" href="#">
                <i class="fa fa-shipping-fast"></i>
                <span> Giao hàng</span></a>
            </li>
            <li>
                <a  class="product-link" href="#">
                <i class="fa fa-chalkboard-teacher"></i>
                <span> Đặt hàng</span></a>
            </li>
            <li class="p-0"><span class="ecentviewed-mini-title text-white" style="background-color: #4a4d54; padding: 5px 0px">Sản phẩm vừa xem</span>
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">

                    <div class="carousel-inner" id="recen">

                    </div>

                  </div>
                  <ol class="carousel-indicators recenly-indicator" style="bottom: -10">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active p-0"></li>
                    <li class="p-0" data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li class="p-0" data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                  </ol>
            </li>

        </ul>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="{{asset('js/swiper.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
    <script src="{{asset('Plugins/jquery-ui/jquery-ui.min.js')}}"></script>
    <script src="{{asset('Plugins/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('Plugins/Widgets.NivoSlider/Scripts/jquery.nivo.slider.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

    @yield('js')

    @include('user.script.scrip')
    @include('sweetalert::alert')
    <script src="{{asset('Plugins/sweetalert2/sweetalert2.all.min.js')}}"></script>
    <script src="{{ asset('vendor/laravel-filemanager/js/jquery.autocomplete.js') }}"></script>
    {{-- @dd(Session::all()) --}}
    <script>


var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });


        $('#keyword').keypress(function(e) {
            if (e.which == 13) {
                $('form#search-form').submit();
                return false; //<---- Add this line
            }
        });
        $('#keyword').autocomplete({

            select: (e, ui) => {
                // console.log(window.location);
                location.pathname = 'detail/' + ui.item.slug;
            },
            source: (request, response) => {
                $.ajax({
                    type: "get",
                    url: "{{ route('ajax.search') }}",
                    data: {
                        "keyword": request.term
                    },
                    dataType: "json",
                    success: function(data) {
                        response($.map(data,
                            function(data) {
                                $('.ui-autocomplete').addClass('list-group');
                                return {
                                    label: data.name,
                                    slug: data.slug
                                }
                            }));
                    }
                    // $('li.ui-menu-item').addClass('list-group-item');

                });
            },

        });

////// get recenly

$(document).ready(function () {


    var recenly = JSON.parse(localStorage.getItem('recenly'));
    // console.log(recenly);

    $.ajax({
        type: "get",
        url: "{{route('product.recenly')}}",
        data: {
            "data":recenly
        },
        dataType: "json",
        success: function (response) {
            $('#recen').html('');
            $.each(response, function (index, item) {
                 if(index==0){
                    $('#recen').append(
                        `<div class="carousel-item active">
                            <a href="{{asset('detail/${item.id}')}}">
                        <img class="d-block w-100" src="${item.avatar}" alt="First slide">
                        </a>
                      </div>`
                    );
                 }else{
                    $('#recen').append(
                        `<div class="carousel-item">
                        <a href="{{asset('detail/${item.id}')}}">
                        <img class="d-block w-100" src="${item.avatar}" alt="First slide">
                        </a>
                      </div>`
                    );
                 }
            });
        }
    });
});



/////////
        new Swiper('.mySwiper', {
            loop: true,

            // slidesPerView: 3,
            // paginationClickable: true,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            spaceBetween: 2,
            breakpoints: {
                1920: {
                    slidesPerView: 6,
                    spaceBetween: 10
                },
                1028: {
                    slidesPerView: 3,
                    spaceBetween: 30
                },
                480: {
                    slidesPerView: 3,
                    spaceBetween: 10
                }
            }
        });
        new Swiper('.popular', {
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            pagination: {
                el: ".swiper-pagination",
            },
        });
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll('.sidebar .nav-link').forEach(function(element) {

                element.addEventListener('click', function(e) {

                    let nextEl = element.nextElementSibling;
                    let parentEl = element.parentElement;

                    if (nextEl) {
                        e.preventDefault();
                        let mycollapse = new bootstrap.Collapse(nextEl);

                        if (nextEl.classList.contains('show')) {
                            mycollapse.hide();
                        } else {
                            mycollapse.show();
                            // find other submenus with class=show

                            var rotate = parentEl.children[0].children[0].classList.contains(
                                'rotate-none')
                            // console.log(parentEl.children[0].children[0].classList)
                            if (rotate) {
                                parentEl.children[0].children[0].classList.remove('rotate-none')
                                parentEl.children[0].children[0].classList.add('rotate-90')
                            } else {
                                parentEl.children[0].children[0].classList.remove('rotate-90')
                                parentEl.children[0].children[0].classList.add('rotate-none')
                            }
                            var opened_submenu = parentEl.parentElement.querySelector(
                                '.submenu.show');
                            // if it exists, then close all of them
                            if (opened_submenu) {
                                new bootstrap.Collapse(opened_submenu);
                                //   console.log(opened_submenu.parentElement.children[0].children[0]);
                                if (opened_submenu.parentElement.children[0].children[0].classList
                                    .contains('rotate-90')) {
                                    opened_submenu.parentElement.children[0].children[0].classList
                                        .remove('rotate-90')
                                    opened_submenu.parentElement.children[0].children[0].classList
                                        .add('rotate-none')
                                }
                            }
                        }
                    }
                }); // addEventListener
            }) // forEach
        });
        $(document).ready(function() {

 $("#owl-demo").owlCarousel({
   navigation : true,
   items : 1,
   loop:true,
      nav:true,
   animateOut: 'fadeOut',
      animateIn: 'fadeIn',
 });

});
        $(document).ready(function() {
            $(document).on('click', '#mega-button', function() {
                $('.mega-menu-wraper').toggleClass('d-none')
            })

        });
    </script>
</body>

</html>
