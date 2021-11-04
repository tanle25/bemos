<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>

    <link rel="shortcut icon" type="image/png" href="{{Str::replaceLast(',', '', $favicon[0]->value ?? '')}}" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,400;1,600&display=swap"
        rel="stylesheet">
    {{-- @include('seo_manager.seo_frontend_component') --}}
    <link rel="stylesheet" href="{{asset('plugins/fontawesome-pro/css/all.min.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('css/swiper.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/main.css')}}">
    @yield('css')
    <style>
        .btn-disable {
            background: #ccc;
        }

        .news-title {
            background: #0A923C;
            text-transform: uppercase;
            text-align: center;
            padding: 15px;
            color: #fff;
            font-size: 14px;
            font-weight: 600;
        }

        a.text-dark {
            padding: 0 3px;
            background: #0a923c;
            color: #fff !important;
            /* border: solid 2px #5fd02c; */
            border-radius: 3px;
            font-weight: 300 !important;
            margin-top: 2px;
        }
    </style>
</head>

<body class="bg-muted">
    {{-- <header id="header" class="header position-sticky sticky-top" style="z-index: 999">
        <div class="app-bar py-1 w-100 bg-primary" style="">
            <div class="container">
                <div class="d-flex justify-content-end text-white align-items-center">
                    <div class="font-8 mr-1">HOTLINE</div>
                    <strong class="font-11">
                        <span class="border-right pr-3">
                            0975428869
                        </span>
                    </strong>
                    <a href="#" class="font-9 font-weight-300 pl-3 text-white chat-btn"><i
                            class="fal font-14 fa-comment-dots mr-1"></i> Chat với chúng tôi </a>
                </div>
            </div>
        </div>
        <div class="w-100 bg-success">
            <div class="head-search container">
                <div class="d-flex align-items-center py-2">
                    <a href="/"> <img src="{{asset('images/logo-1.jpg')}}" class="mr-5" height="35px" width="auto"
                            alt=""> </a>

                    <div class="bg-white d-flex my-1 flex-1 mx-4" action="/tim-kiem" method="post">
                        <input type="text" class="font-8 form-control rounded-0 border-0 py-0 search-input"
                            placeholder="Tìm kiếm sản phẩm" value="">
                        <button class="search-btn btn rounded-0 px-2 py-1"><i class="far fa-search"></i></button>
                    </div>
                    <div class="d-flex align-items-center ml-5">
                        <a href="/v2/login" class="hover-warning d-block text-white">
                            <i class="pr-1 font-12 fal fa-user-unlock text-white"></i>
                            <span class="font-9 text-white pr-3 hover-warning">Đăng nhập</span>
                        </a>
                        <a href="/v2/login" class="d-block text-white hover-warning"> <span
                                class="border-left pl-3 font-9 text-white">Đăng ký</span></a>

                        <div class="dropdown cart-list-dropdown d-inline-block ml-3">
                            <a href="/gio-hang" data-toggle="dropdown" id="cart-list"
                                class="hover-border-warning d-flex align-items-center font-8 border px-3 py-2 border-white text-white">
                                <span class="hover-warning ">
                                    <i class="fal fa-shopping-cart font-12"></i>
                                    <span class="ml-1">GIỎ HÀNG</span>
                                </span>
                                <span class="bg-warning rounded-pill ml-2 px-2 cart-count">0</span>
                            </a>
                            <div class="dropdown-menu animate__animated animate__faster cart-body dropdown-menu-right mt-2 p-4"
                                aria-labelledby="cart-list" style="width: 370px; max-width: 100vw">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="head-menu container d-flex ">
                <div class="px-3 py-3 bg-primary text-white c-pointer desktop-category-menu">
                    <div class="list-category-head px-3">
                        <i class="far fa-list mr-2"></i>
                        <span class="font-weight-600 font-8">DANH MỤC SẢN PHẨM</span>
                    </div>
                    <div class="list-category bg-white p-3 border">
                        @foreach ($menu->where('parent_id',null) as $menu_item )
                        <div class=" font-9 px-3 py-2 list-category-item" data-id="{{$menu_item->id}}">
                            <a class="main-text hover-success" href="/di-cho-online">{{$menu_item->name}}</a>
                        </div>
                        @endforeach
                        <div style="display: none" class="list-category-right bg-white p-3 border border-top-0">
                            @foreach ($menu ?? [] as $item)
                                @php
                                    $childs = $menu->where('parent_id',$item->id)
                                @endphp
                                <ul class="text-dark category-list-item" id="category-{{$item->id}}">
                                    @foreach ($childs ?? [] as $child)
                                    <li class="font-10 font-weight-600 mb-3">
                                        <a class="main-text font-9 hover-success" href="/{{$child->slug}}">{{$child->name}}</a>
                                    </li>
                                    @endforeach
                                    </ul>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="nav-inner flex-1 h-100">
                    <ul
                        class="h-100 main-menu desktop-menu border-top border-primary d-flex my-0 px-0 justify-content-between">
                        <li class="flex-1 ml-2 menu-item  has-child ">
                            <a style="line-height: 38px"
                                class="h-100 px-1 py-2 menu-link hover-bg-primary main-text font-weight-600 text-white d-flex align-items-center"
                                href="/di-cho-online">
                                <span class="mr-2 bg-white text-primary rounded-circle text-center"
                                    style="width:30px; height:30px; line-height: 30px">
                                    <i class="fas fa-people-carry"></i>
                                </span>
                                <span class="text-uppercase font-7">Làng nghề</span>
                                <i class="far fa-chevron-down font-7 ml-2"></i>
                            </a>

                        </li>
                        <li class="flex-1 ml-2 menu-item ">
                            <a style="line-height: 38px"
                                class="h-100 px-1 py-2 menu-link hover-bg-primary main-text font-weight-600 text-white d-flex align-items-center"
                                href="/trai-cay-tuoi-ngon">
                                <span class="mr-2 bg-white text-primary rounded-circle text-center"
                                    style="width:30px; height:30px; line-height: 30px">
                                    <i class="fab fa-envira"></i>
                                </span>
                                <span class="text-uppercase font-7">Kết nối cung cầu</span>
                            </a>
                        </li>
                        <li class="flex-1 ml-2 menu-item ">
                            <a style="line-height: 38px"
                                class="h-100 px-1 py-2 menu-link hover-bg-primary main-text font-weight-600 text-white d-flex align-items-center"
                                href="/dac-san-da-lat-lam-dong">
                                <span class="mr-2 bg-white text-primary rounded-circle text-center"
                                    style="width:30px; height:30px; line-height: 30px">
                                    <i class="fas fa-mortar-pestle"></i>
                                </span>
                                <span class="text-uppercase font-7">Cơ sở sản xuất</span>
                            </a>
                        </li>
                        <li class="flex-1 ml-2 menu-item ">
                            <a style="line-height: 38px"
                                class="h-100 px-1 py-2 menu-link hover-bg-primary main-text font-weight-600 text-white d-flex align-items-center"
                                href="/tra-ca-phe-socola">
                                <span class="mr-2 bg-white text-primary rounded-circle text-center"
                                    style="width:30px; height:30px; line-height: 30px">
                                    <i class="fas fa-coffee"></i>
                                </span>
                                <span class="text-uppercase font-7">Tin tức</span>
                            </a>
                        </li>
                        <li class="flex-1 ml-2 menu-item ">
                            <a style="line-height: 38px"
                                class="h-100 px-1 py-2 menu-link hover-bg-primary main-text font-weight-600 text-white d-flex align-items-center"
                                href="/dac-san-vung-mien">
                                <span class="mr-2 bg-white text-primary rounded-circle text-center"
                                    style="width:30px; height:30px; line-height: 30px">
                                    <i class="fas fa-box-open"></i>
                                </span>
                                <span class="text-uppercase font-7">Liên hệ</span>
                            </a>
                        </li>
                        <li class="flex-1 ml-2 menu-item ">
                            <a style="line-height: 38px"
                                class="h-100 px-1 py-2 menu-link hover-bg-primary main-text font-weight-600 text-white d-flex align-items-center"
                                href="/tin-tuc">
                                <span class="mr-2 bg-white text-primary rounded-circle text-center"
                                    style="width:30px; height:30px; line-height: 30px">
                                    <i class="fas fa-book-open"></i>
                                </span>
                                <span class="text-uppercase font-7">QUY HOẠCH - NÔNG HÓA -THỔ NHƯỠNG</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </header> --}}
    @yield('custom_nav')
    <header id="header" class="header position-sticky sticky-top" style="z-index: 999">
        @if (Agent::isTablet() || Agent::isMobile())
        <div class="mobile-header bg-primary py-2">
            <div class="d-flex align-items-center container py-1">
                <a href="/" class="mr-auto">
                    <img src="{{$web_info->logo ?? ''}}" width="auto" height="auto" style="max-height: 60px; max-width:150px" class="mr-auto" alt="logo">
                </a>
                <div class="bg-white d-flex my-1 flex-1 mx-4" action="/tim-kiem" method="post">
                    <input id="search" type="text" class="font-8 form-control rounded-0 border-0 py-0 search-input" placeholder="Tìm kiếm sản phẩm"
                    value="@isset($filter_list['keyword']) {{$filter_list['keyword']}} @endisset"
                    >
                    <button class="search-btn btn rounded-0 px-2 py-1"><i class="far fa-search"></i></button>
                </div>
                <div data-trigger="#cart_nav" id="cart-list" class="cart-list-mobile font-13 mr-2 text-white">
                    <i class="far fa-shopping-cart"></i>
                    <span class="bg-warning rounded-pill ml-2 px-2 font-8 cart-count">{{Cart::count()}}</span>
                </div>
                {{-- <a aria-controls="search-box" aria-expanded="false" data-toggle="collapse" data-target="#search-box" class="font-13 ml-3 text-white"><i class="far fa-search"></i></a> --}}
                <div data-trigger="#main_nav" class="font-17 ml-4 text-white"><i class="far fa-bars"></i></div>
            </div>
            {{-- <div class="search-input collapse" id="search-box">
                <div class="bg-white d-flex my-1 flex-1 mx-4" action="/tim-kiem" method="post">
                    <input type="text" class="font-8 form-control rounded-0 border-0 py-0 search-input" placeholder="Tìm kiếm sản phẩm"
                    value="@isset($filter_list['keyword']) {{$filter_list['keyword']}} @endisset"
                    >
                    <button class="search-btn btn rounded-0 px-2 py-1"><i class="far fa-search"></i></button>
                </div>
            </div> --}}
        </div>
        @endif
        @if (Agent::isDesktop())
            <div class="app-bar py-1 w-100 bg-primary">
                <div class="container">
                    <div class="d-flex justify-content-end text-white align-items-center">
                        @if (auth()->check())
                                <a href="/tai-khoan/don-hang" class="d-flex align-items-center text-white mr-3">
                                    <i class="fal fa-box-check font-12"></i>
                                    <span class="font-9 ml-1 ">Theo dõi đơn hàng</span>
                                </a>
                                <a href="/tai-khoan" class="d-flex align-items-center text-white">
                                    <img width="30px" height="30px" src="{{auth()->user()->profile_image_path ?? asset('images/logoAPhuc2-02.png')}}" alt="">
                                    <span class="font-9 ml-1 text-white">{{auth()->user()->name ?? ''}}</span>
                                </a>
                            @else

                            <a href="/v2/login" class="hover-warning d-block text-white">
                                <i class="pr-1 font-12 fal fa-user-unlock text-white"></i>
                                <span class="font-9 text-white pr-3 hover-warning">Đăng nhập gian hàng</span>
                            </a>
                            <a href="/v2/login" class="hover-warning border-left d-block text-white pl-3">
                                <i class="pr-1 font-12 fal fa-user-unlock text-white"></i>
                                <span class="font-9 text-white pr-3 hover-warning">Đăng ký gian hàng</span>
                            </a>

                                <a href="/v2/login" class="hover-warning d-block border-left text-white pl-3 pr-3">
                                    <i class="pr-1 font-12 fal fa-user-unlock text-white"></i>
                                    <span class="font-9 text-white pr-3 hover-warning">Đăng nhập</span>
                                </a>
                                <a href="/v2/login" class="d-block text-white hover-warning"> <span class="border-left pl-3 font-9 text-white pr-3">Đăng ký</span></a>
                            @endif
                            <a href="{{$wep_info->phone ?? ''}}" class="d-block text-white hover-warning"> <span class="border-left pl-3 font-9 text-white">Hotline: <strong>{{$wep_info->phone ??''}}</strong> </span></a>
                        </strong>
                        {{-- <a href="#" class="font-9 font-weight-300 pl-3 text-white chat-btn"><i class="fal font-14 fa-comment-dots mr-1"></i> Chat với chúng tôi </a> --}}
                    </div>
                </div>
            </div>
            <div class="w-100 bg-success">
                <div class="head-search container">
                    <div class="d-flex align-items-center py-2">
                        <a href="/"> <img src="{{Str::replaceLast(',', '', $web_info->logo ?? '')}}" class="mr-5" height="35px" width="auto" alt=""> </a>

                        <div class="bg-white d-flex my-1 flex-1 mx-4" action="/tim-kiem" method="post">
                            <input id="search" type="text" class="font-8 form-control rounded-0 border-0 py-0 search-input" placeholder="Tìm kiếm sản phẩm"
                            value="@isset($filter_list['keyword']) {{$filter_list['keyword']}} @endisset"
                            >
                            <button class="search-btn btn rounded-0 px-2 py-1"><i class="far fa-search"></i></button>
                        </div>
                        <div class="d-flex align-items-center ml-5">



                            <div class="dropdown cart-list-dropdown d-inline-block ml-3">
                                <a href="/gio-hang" data-toggle="dropdown" id="cart-list" class="hover-border-warning d-flex align-items-center font-8 border px-3 py-2 border-white text-white">
                                    <span class="hover-warning ">
                                        <i class="fal fa-shopping-cart font-12"></i>
                                        <span class="ml-1">GIỎ HÀNG</span>
                                    </span>
                                    <span class="bg-warning rounded-pill ml-2 px-2 cart-count">{{Cart::count()}}</span>
                                </a>
                                <div class="dropdown-menu animate__animated animate__faster cart-body dropdown-menu-right mt-2 p-4" aria-labelledby="cart-list" style="width: 370px; max-width: 100vw">
                                    {{-- render item in cart --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="head-menu container d-flex ">
                    <div class="px-3 py-3 bg-primary text-white c-pointer desktop-category-menu">
                        <div class="list-category-head px-3">
                            <i class="far fa-list mr-2"></i>
                            <span class="font-weight-600 font-8">DANH MỤC SẢN PHẨM</span>
                        </div>
                        <div class="list-category bg-white p-3 border">
                            @foreach ($menu->where('parent_id',null) as $menu_item )
                                <div class=" font-9 px-3 py-2 list-category-item" data-id="{{$menu_item->id}}">
                                    <a class="main-text hover-success" href="/di-cho-online">{{$menu_item->name}}</a>
                                </div>
                        @endforeach
                            <div style="display: none" class="list-category-right bg-white p-3 border border-top-0">
                                @foreach ($menu ?? [] as $item)
                                @php
                                    $childs = $menu->where('parent_id',$item->id)
                                @endphp
                                <ul class="text-dark category-list-item" id="category-{{$item->id}}">
                                    @foreach ($childs ?? [] as $child)
                                    <li class="font-10 font-weight-600 mb-3">
                                        <a class="main-text font-9 hover-success" href="/{{$child->slug}}">{{$child->name}}</a>
                                    </li>
                                    @endforeach
                                    </ul>
                            @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="nav-inner flex-1 h-100">
                        <ul class="h-100 main-menu desktop-menu border-top border-primary d-flex my-0 px-0 justify-content-between">
                            <li class="flex-1 ml-2 menu-item  has-child ">
                                <a style="line-height: 38px"
                                    class="h-100 px-1 py-2 menu-link hover-bg-primary main-text font-weight-600 text-white d-flex align-items-center"
                                    href="/di-cho-online">
                                    <span class="mr-2 bg-white text-primary rounded-circle text-center"
                                        style="width:30px; height:30px; line-height: 30px">
                                        <i class="fas fa-people-carry"></i>
                                    </span>
                                    <span class="text-uppercase font-7">Làng nghề</span>
                                    <i class="far fa-chevron-down font-7 ml-2"></i>
                                </a>

                            </li>
                            <li class="flex-1 ml-2 menu-item ">
                                <a style="line-height: 38px"
                                    class="h-100 px-1 py-2 menu-link hover-bg-primary main-text font-weight-600 text-white d-flex align-items-center"
                                    href="{{route('connect.index')}}">
                                    <span class="mr-2 bg-white text-primary rounded-circle text-center"
                                        style="width:30px; height:30px; line-height: 30px">
                                        <i class="fab fa-envira"></i>
                                    </span>
                                    <span class="text-uppercase font-7">Kết nối cung cầu</span>
                                </a>
                            </li>
                            <li class="flex-1 ml-2 menu-item ">
                                <a style="line-height: 38px"
                                    class="h-100 px-1 py-2 menu-link hover-bg-primary main-text font-weight-600 text-white d-flex align-items-center"
                                    href="{{route('shop.listshop')}}">
                                    <span class="mr-2 bg-white text-primary rounded-circle text-center"
                                        style="width:30px; height:30px; line-height: 30px">
                                        <i class="fas fa-mortar-pestle"></i>
                                    </span>
                                    <span class="text-uppercase font-7">Cơ sở sản xuất</span>
                                </a>
                            </li>
                            <li class="flex-1 ml-2 menu-item  has-child ">
                                <a style="line-height: 38px"
                                    class="h-100 px-1 py-2 menu-link hover-bg-primary main-text font-weight-600 text-white d-flex align-items-center"
                                    href="/di-cho-online">
                                    <span class="mr-2 bg-white text-primary rounded-circle text-center"
                                        style="width:30px; height:30px; line-height: 30px">
                                        <i class="fas fa-people-carry"></i>
                                    </span>
                                    <span class="text-uppercase font-7">Tin tức</span>
                                    <i class="far fa-chevron-down font-7 ml-2"></i>
                                </a>
                                <ul class="child-item border">
                                    @foreach ($news_menu as $menu )
                                    <li><a href="{{$menu->slug}}">{{$menu->name}}</a> </li>

                                    @endforeach
                                    {{-- <li><a href="#">Tin làng nghề</a> </li>
                                    <li> <a href="#"> Tin du lịch</a></li>
                                    <li> <a href="#"> Tin huyện hoằng hoá</a></li> --}}
                                </ul>
                            </li>
                            <li class="flex-1 ml-2 menu-item  has-child ">
                                <a style="line-height: 38px"
                                    class="h-100 px-1 py-2 menu-link hover-bg-primary main-text font-weight-600 text-white d-flex align-items-center"
                                    href="/di-cho-online">
                                    <span class="mr-2 bg-white text-primary rounded-circle text-center"
                                        style="width:30px; height:30px; line-height: 30px">
                                        <i class="fas fa-people-carry"></i>
                                    </span>
                                    <span class="text-uppercase font-7">Thư viện</span>
                                    <i class="far fa-chevron-down font-7 ml-2"></i>
                                </a>
                                <ul class="child-item border">

                                    <li><a href="#">Thư viện hình ảnh</a> </li>
                                    <li> <a href="/thu-vien">Thư viện video</a></li>
                                </ul>
                            </li>
                            <li class="flex-1 ml-2 menu-item ">
                                <a style="line-height: 38px"
                                    class="h-100 px-1 py-2 menu-link hover-bg-primary main-text font-weight-600 text-white d-flex align-items-center"
                                    href="{{route('home.contact')}}">
                                    <span class="mr-2 bg-white text-primary rounded-circle text-center"
                                        style="width:30px; height:30px; line-height: 30px">
                                        <i class="fas fa-box-open"></i>
                                    </span>
                                    <span class="text-uppercase font-7">Liên hệ</span>
                                </a>
                            </li>
                            <li class="flex-1 ml-2 menu-item ">
                                <a style="line-height: 38px"
                                    class="h-100 px-1 py-2 menu-link hover-bg-primary main-text font-weight-600 text-white d-flex align-items-center"
                                    href="/tin-tuc">
                                    <span class="mr-2 bg-white text-primary rounded-circle text-center"
                                        style="width:30px; height:30px; line-height: 30px">
                                        <i class="fas fa-book-open"></i>
                                    </span>
                                    <span class="text-uppercase font-7">QUY HOẠCH - NÔNG HÓA..</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        @endif
    </header>
    <div id="content" class="mt-3">
        <div id="primary" class="">
            <main id="main" class="site-main">
                {{-- {{var_dump($menu)}} --}}
                @yield('content')
            </main>
        </div>
    </div>

    <footer id="footer">
        <div class="footer-mid py-5 ">
            <div class="container">


                <div class="row pt-3">
                    <div class="col-md-3 text-center border-right">
                        <h5 class=" mb-3"><strong class="text-white font-9 font-weight-600 text-uppercase">CHĂM SÓC
                                KHÁCH HÀNG</strong></h5>
                        <div>
                            <a class="d-block mb-2" href="tel:+231231231">Hotline: <span
                                    class="text-warning">0975428869</span></a>
                            <a class="d-block mb-2" href="tel:+231231231">CSKH: <span
                                    class="text-warning">0975428869</span></a>
                            <a class="d-block mb-2" href="mailto:manifoodn@gmail.com">Email: <span
                                    class="text-info">manifoodn@gmail.com</span></a>
                            <a class="d-block mb-2" href="http://127.0.0.1:8001/huong-dan-mua-hang">Hướng dẫn mua
                                hàng</a>
                            <a class="d-block mb-2" href="http://127.0.0.1:8001/quy-che-hoat-dong">Quy chế hoạt động của
                                website Manifoods.com.vn</a>
                        </div>
                    </div>
                    <div class="col-md-3 text-center border-right">
                        <h5 class=" mb-3"><strong class="text-white font-9 font-weight-600 text-uppercase">Về CÔNG TY
                                TNHH MANI FOOD</strong></h5>
                        <div>
                            <a class="d-block mb-2" href="#">Giới thiệu về CÔNG TY TNHH MANI FOOD </a>
                            <a class="d-block mb-2" href="http://127.0.0.1:8001/chinh-sach-bao-mat">Chính Sách Bảo
                                mật</a>
                            <a class="d-block mb-2" href="http://127.0.0.1:8001/chinh-sach-doi-tra-va-hoan-tien">Chính
                                Sách Đổi Trả Và Hoàn Tiền</a>
                            <a class="d-block mb-2" href="http://127.0.0.1:8001/chinh-sach-va-quy-dinh-chung"> Chính
                                Sách Và Quy Định Chung</a>
                            <a class="d-block mb-2" href="http://127.0.0.1:8001/chinh-sach-van-chuyen">Chính Sách Vận
                                Chuyển</a>
                            <a class="d-block mb-2" href="http://127.0.0.1:8001/quy-dinh-va-hinh-thuc-thanh-toan">Quy
                                Định Và Hình Thức Thanh Toán</a>
                        </div>
                    </div>
                    {{-- <div class="col-md-3 text-center border-right">
                        <h5 class=" mb-3"><strong class="text-white font-9 font-weight-600 text-uppercase">HỢP
                                TÁC</strong></h5>
                        <div>
                            <a href="" class="mb-3 d-inline-block"> <img height="30px"
                                    src="/images/icons/socials/topcv.jpg" alt=""> </a>
                            <a href="" class="mb-3 d-inline-block"> <img height="30px"
                                    src="/images/icons/socials/design-bold.png" alt=""> </a>
                            <a href="" class="mb-3 d-inline-block"> <img src="/images/icons/socials/colorme.jpg" alt="">
                            </a>
                        </div>
                    </div> --}}
                    {{-- <div class="col-md-3 text-center">
                        <h5 class=" mb-3"><strong class="text-white font-9 font-weight-600 text-uppercase">THEO DÕI CÔNG
                                TY TNHH MANI FOOD</strong></h5>
                        <div>
                            <a class="mx-1" href="#"> <img src="/images/icons/socials/logo-facebook.png" height="30px"
                                    alt=""> </a>
                            <a class="mx-1" href="#"> <img src="/images/icons/socials/logo-youtube.png" height="30px"
                                    alt=""> </a>
                            <a class="mx-1" href="#"> <img src="/images/icons/socials/logo-instagram.png" height="30px"
                                    alt=""> </a>
                            <a class="mx-1" href="#"> <img src="/images/icons/socials/linkin.png" height="30px" alt="">
                            </a>
                            <a href="" class="d-block mt-3"> <img width="60px"
                                    src="/images/icons/socials/_dmca_premi_badge_2.png" alt=""> </a>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
        <div class="footer-bottom border-top font-weight-light py-3">
            <div class="container">
                <div class="text-light">
                    <span class="text-warning">Văn phòng: </span> Văn phòng 2, tầng 8 tòa nhà Pearl Plaza, 561A Điện
                    Biên Phủ, phường 25 quận Bình Thạnh, thành phố Hồ Chí Minh
                </div>
                <div class="text-light">
                    Tổng đài: <span class="text-warning">0975428869</span> - Email: <span
                        class="text-info">manifoodn@gmail.com</span>
                </div>
                <div class="text-light">
                    Copyright © Công ty TNHH ManiFoods Việt Nam. All Rights Reserved.
                </div>
                <div class="text-light">
                    Số giấy chứng nhận đăng ký kinh doanh: 0316613274. Ngày cấp: 30/11/2020 Do Phòng Đăng ký kinh doanh
                    quận Bình Thạnh cấp
                </div>
            </div>
        </div>
    </footer>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary p-0 d-block d-lg-none" style="z-index: 1000">
        <div class="navbar-collapse" id="main_nav">
            <div class="offcanvas-header d-flex justify-content-between align-items-center bg-primary px-3 py-2 border-bottom">
                <div class="d-flex">
                    @if (auth()->check())
                        {{-- <a href="/tai-khoan/don-hang" class="d-flex align-items-center text-white mr-3">
                            <i class="fal fa-box-check font-12"></i>
                            <span class="font-9 ml-1 ">Theo dõi đơn hàng</span>
                        </a> --}}
                        <a href="/tai-khoan" class="d-flex align-items-center text-white">
                            <img width="30px" height="30px" src="{{auth()->user()->profile_image_path ?? asset('images/logo-1.jpg')}}" alt="">
                            <span class="font-85 ml-1 text-white">{{auth()->user()->name ?? ''}}</span>
                        </a>


                    @endif
                </div>
                <button class="text-white btn-close btn pr-0"> <i class="far fa-bars"></i></button>
            </div>
{{--
            <ul class="navbar-nav p-3">
                <li class="flex-1 ml-2 menu-item  has-child ">
                    <div class="d-flex align-items-center text-success">
                        <a style="line-height: 38px"
                        class="font-weight-600 text-uppercase font-85"
                        href="/di-cho-online">
                        <span class="mr-2 bg-white rounded-circle text-center"
                            style="width:30px; height:30px; line-height: 30px">
                            <i class="fas fa-people-carry"></i>
                        </span>
                        <span class="text-uppercase font-7">Làng nghề</span>
                        <i class="far fa-chevron-down font-7 ml-2"></i>
                    </a>
                    </div>
                </li>
                <li class="flex-1 ml-2 menu-item ">
                    <div class="d-flex align-items-center text-success">
                        <a style="line-height: 38px"
                        class="font-weight-600 text-uppercase font-85"
                        href="{{route('connect.index')}}">
                        <span class="mr-2 bg-white rounded-circle text-center"
                            style="width:30px; height:30px; line-height: 30px">
                            <i class="fab fa-envira"></i>
                        </span>
                        <span class="text-uppercase font-7">Kết nối cung cầu</span>
                    </a>
                    </div>
                </li>
                <li class="flex-1 ml-2 menu-item ">

                    <div class="d-flex align-items-center text-success">
                        <a style="line-height: 38px"
                        class="font-weight-600 text-uppercase font-85"
                            href="{{route('shop.listshop')}}">
                            <span class="mr-2 bg-white rounded-circle text-center"
                                style="width:30px; height:30px; line-height: 30px">
                                <i class="fas fa-mortar-pestle"></i>
                            </span>
                            <span class="text-uppercase font-7">Cơ sở sản xuất</span>
                        </a>
                    </div>
                </li>
                <li class="flex-1 ml-2 menu-item nav-item  has-child ">
                    <div class="d-flex align-items-center text-success">
                        <a style="line-height: 38px"
                            class="font-weight-600 text-uppercase font-85"
                            href="#">
                            <span class="mr-2 bg-white rounded-circle text-center"
                                style="width:30px; height:30px; line-height: 30px">
                                <i class="fas fa-people-carry"></i>
                            </span>
                            <span class="text-uppercase font-7">Tin tức</span>
                            <i class="far fa-chevron-down font-7 ml-2"></i>
                        </a>
                    </div>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                          <a href="#" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Level 2</p>
                          </a>
                        </li>
                    </ul>
                </li>
                <li class="flex-1 ml-2 menu-item ">
                    <div class="d-flex align-items-center text-success">
                    <a
                        class="font-weight-600 text-uppercase font-85"
                        href="{{route('home.contact')}}">
                        <span class="mr-2 bg-white rounded-circle text-center"
                            style="width:30px; height:30px; line-height: 30px">
                            <i class="fas fa-box-open"></i>
                        </span>
                        <span class="text-uppercase font-7">Liên hệ</span>
                    </a>
                    </div>
                </li>
                <li class="flex-1 ml-2 menu-item ">
                    <div class="d-flex align-items-center text-success">
                        <a
                            class="font-weight-600 text-uppercase font-85"
                            href="/tin-tuc">
                            <span class="mr-2 bg-white rounded-circle text-center"
                                style="width:30px; height:30px; line-height: 30px">
                                <i class="fas fa-book-open"></i>
                            </span>
                            <span class="text-uppercase font-7">QUY HOẠCH - NÔNG HÓA -THỔ NHƯỠNG</span>
                        </a>
                    </div>
                </li>

            </ul> --}}
            <nav class="sidebar card py-2 mb-4">
                <ul class="nav flex-column mobile-menu" id="nav_accordion">
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="far fa-home-lg-alt mr-3"></i> Làng nghề </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('connect.index')}}"> <i class="fas fa-handshake mr-3"></i>Kết nối cung - cầu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('shop.listshop')}}"><i class="fas fa-store mr-3"></i> Cơ sở sản xuất</a>
                    </li>

                    <li class="nav-item has-submenu">
                        <a class="nav-link" href="#"><i class="fas fa-newspaper mr-3"></i> Tin tức <i class="fal fa-chevron-right ml-3"></i></a>
                        <ul class="submenu collapse">
                            @foreach ($news_menu as $menu )
                            <li><a class="nav-link" href="{{$menu->slug}}">{{$menu->name}}</a></li>
                            @endforeach
                            {{-- <li><a class="nav-link" href="#">Tin tức làng nghề</a></li>
                            <li><a class="nav-link" href="#">Tin tức du lịch</a></li>
                            <li><a class="nav-link" href="#">Tin tức huyện hoằng hoá</a></li> --}}
                        </ul>
                    </li>
                    <li class="nav-item has-submenu">
                        <a class="nav-link" href="#"><i class="fas fa-photo-video mr-3"></i> Thư viện <i class="fal fa-chevron-right ml-3"></i></a>
                        <ul class="submenu collapse">
                            <li><a class="nav-link" href="#">Thư viện ảnh</a></li>
                            <li><a class="nav-link" href="/thu-vien">Thư viện video</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('home.contact')}}"> <i class="far fa-envelope mr-3"></i>Liên hệ </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="far fa-construction mr-3"></i> Quy hoạch - nông hoá - thổ nhưỡng</a>
                    </li>
                </ul>
                </nav>
            @if (!auth()->check())
            <hr>
            <ul id="menu-account-mobile" class="border-bottom p-3 account-mobile">
                <li><a href="/login" class="d-block"> <i class="pr-1 font-12 fal fa-user-unlock"></i> <span class="font-9 pr-3">Đăng nhập</span></a></li>
                <li><a href="/register" class="d-block"> <i class="pr-1 font-12 far fa-user-plus"></i> <span class="font-9 pr-3">Đăng ký</span></a></li>

                <li><a href="/shop/login" class="d-block"> <i class="pr-1 font-12 fas fa-store"></i> <span class="font-9 pr-3">Đăng nhập gian hàng</span></a></li>
                <li><a href="/shop/register" class="d-block"> <i class="pr-1 font-12 far fa-edit"></i>  <span class="font-9 pr-3">Đăng ký gian hàng</span></a></li>

            </ul>
            @else

            <a id="mobile-logout" href="/logout" class="d-block ml-4"> <i class="pr-1 font-12 far fa-sign-out-alt"></i> <span class="font-9 pr-3">Đăng xuất</span></a>

        @endif

        </div> <!-- navbar-collapse.// -->
    </nav>
    {{-- nav cart --}}

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary p-0 d-block d-lg-none" style="z-index: 1000">
        <div class="navbar-collapse px-3" id="cart_nav">
            <div class="offcanvas-header d-flex justify-content-between align-items-center mt-3 border-bottom pb-3">
                <h5 class="py-2 my-0 text-primary font-weight-600">Giỏ hàng</h5>
                <button class="text-primary btn-close btn pr-0"> <i class="far font-16 fa-long-arrow-right"></i> </button>
            </div>
            <div class=" animate__animated animate__faster cart-body mt-2 " >
                {{-- render item in cart --}}
            </div>
        </div> <!-- navbar-collapse.// -->
    </nav>

    {{-- category --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary p-0 d-block d-lg-none" style="z-index: 1000">
        <div class="navbar-collapse px-3" id="category_nav">
            <div class="offcanvas-header d-flex justify-content-between align-items-center mt-3 border-bottom pb-3">
                <h5 class="py-2 my-0 text-primary font-weight-600">Danh mục sản phẩm</h5>
                <button class="text-primary btn-close btn pr-0"> <i class="far font-16 fa-long-arrow-right"></i> </button>
            </div>
            <ul class="mt-2 px-0" >
                @foreach ($all_categories ?? [] as $category)
                    @php
                        $childs = $category['children'];
                        $item = $category['item'];
                    @endphp
                    <li class="flex-1 pl-3 menu-item py-3 @if(isset($childs) && $childs != []) has-child @endif">
                        <div class="d-flex align-items-center text-success">
                            <a  href="/{{$item->slug}}" class="font-weight-600 text-uppercase font-9">{{$item->name}}</a>
                            @if(!empty($childs))
                            <span class="ml-auto px-2" data-toggle="collapse" data-target="#cate-list-{{$item->id}}" >
                                <i class="fas fa-chevron-down font-8"></i>
                            </span>
                            @endif
                        </div>
                        @isset($childs)
                        @if (!empty($childs))
                            <ul class="pl-3 pt-3 child-navigation collapse" id="cate-list-{{$item->id}}">
                                @foreach ($childs as $child_item)
                                @php
                                    $childs = $child_item['children'];
                                    $item = $child_item['item'];
                                @endphp
                                <li class="py-2 ">
                                    <div class=" menu-link font-9 font-weight-600 d-flex justify-content-between align-items-center">
                                        <a href="/{{$item->slug}}" class="mr-auto">
                                            {{$item->name}}
                                        </a>
                                        @if (!empty($childs))
                                        <span class="ml-auto px-2" data-toggle="collapse" data-target="#sub-cate-list-{{$item->id}}" >
                                            <i class="fas fa-chevron-down font-7"></i>
                                        </span>
                                        @endif
                                    </div>
                                    @if (!empty($childs))
                                        <ul class="pl-3 collapse" id="sub-cate-list-{{$item->id}}">
                                            @foreach ($childs as $item)
                                            <li class="py-2">
                                                <a class=" menu-link font-9 font-weight-600" href="/{{$item['item']->slug ?? ''}}">{{$item['item']->name ?? ''}}</a>
                                            </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                                @endforeach
                            </ul>
                        @endif
                    @endisset
                    </li>
                @endforeach
                </ul>
        </div> <!-- navbar-collapse.// -->
    </nav>
    <style>
        .autocomplete-suggestions { border: 1px solid #999; background: #FFF; overflow: auto; }
        .autocomplete-suggestion { padding: 2px 5px; white-space: nowrap; overflow: hidden; }
        .autocomplete-selected { background: #F0F0F0; }
        /*.autocomplete-suggestions strong { font-weight: normal; color: #3399FF; }*/
        .autocomplete-group { padding: 2px 5px; }
        .autocomplete-group strong { display: block; border-bottom: 1px solid #000; }
    </style>

<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('plugins/jquery-ui/jquery-ui.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"></script>
@yield('js')

<script src="{{asset('js/swiper.js')}}"></script>
<script src="{{asset('js/adminlte.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.devbridge-autocomplete/1.4.10/jquery.autocomplete.min.js"></script>

<script>


document.addEventListener("DOMContentLoaded", function(){
  document.querySelectorAll('.sidebar .nav-link').forEach(function(element){

    element.addEventListener('click', function (e) {

      let nextEl = element.nextElementSibling;
      let parentEl  = element.parentElement;

        if(nextEl) {
            e.preventDefault();
            let mycollapse = new bootstrap.Collapse(nextEl);

            if(nextEl.classList.contains('show')){

              mycollapse.hide();
              console.log(mycollapse);
            } else {
                mycollapse.show();
                // check have class

                var rotate = parentEl.children[0].children[1].classList.contains('rotate')
                if(rotate){
                    parentEl.children[0].children[1].classList.remove('rotate')
                    parentEl.children[0].children[1].classList.add('rotate-remove')
                }else{
                    parentEl.children[0].children[1].classList.remove('rotate-remove')
                    parentEl.children[0].children[1].classList.add('rotate')
                }
                console.log(parentEl.children[0].children[1].classList[1]);
                // find other submenus with class=show
                var opened_submenu = parentEl.parentElement.querySelector('.submenu.show');
                // if it exists, then close all of them
                if(opened_submenu){
                  new bootstrap.Collapse(opened_submenu);
                  if(opened_submenu.parentElement.children[0].children[1].classList.contains('rotate'))
                  {
                    opened_submenu.parentElement.children[0].children[1].classList.remove('rotate')
                    opened_submenu.parentElement.children[0].children[1].classList.add('rotate-remove')
                  }

                }
            }

        }
    }); // addEventListener
  }) // forEach
});



$("#search").autocomplete({
            serviceUrl:"{{route('search')}}",
            paramName: "keyword",

            onSelect: function(suggestion) {
                location.href = '/detail/' + suggestion.id;
            },
            transformResult: function(response) {
                return {
                    suggestions: $.map($.parseJSON(response), function(item) {
                        return {
                            value: item.name,
                            id:item.id,
                        };
                    })
                };
            },

});


$(document).ready(function () {
    $('#search').keyup(function (e) {
        if (e.key === 'Enter' || e.keyCode === 13) {
        // Do something
        location.href = '/tim-kiem/'+ $(this).val();
        }
    });
});


    function updateCartCount(count){
        $('.cart-count').html(count);
    }
    // $('.menu-link').each(function(){
    //     if ($(this).attr("href").replace(location.origin, '') == location.pathname) {
    //         $(this).closest('.menu-item').addClass('active');
    //     }
    // })

    function getCartItem(){
        return $.ajax({
            url: '/cart/get-list',
            type: 'GET',
        });
    }
    function renderCart(cart){
        let listHtml = "";
        if (cart.count == 0) {
            $('.cart-body').html(`
                Không có sản phẩm trong giỏ!
            `);
            return;
        }
        cart.items.forEach(element => {
            listHtml += `
            <div class="cart-item d-flex w-100 border-bottom">
                <img src="${element.options.image}" width="70px" class="mr-2" height="70px" alt="">
                <div class="cart-item-content mb-2">
                    <a class="text-primary font-weight-600 font-9 hrm-truncate" href="/">${element.name}</a>
                    <div class="font-8">${element.qty} x ${element.price.toLocaleString(3)} <sup>đ</sup></div>
                    <div class="font-8">( ${element.options.list_attr} )</div>
                </div>
                <div data-row-id="${element.rowId}" class="ml-auto c-pointer text-danger btn-remove-cart-item pl-2"><i class="fas fa-times"></i></div>
            </div>
            `;
        });
        let cartHtml = `
            <div class="list-items overflow-auto pr-3" style="max-height: 300px">
                ${listHtml}
            </div>
            <div class="py-3 font-9 total-price">
                <div class="d-flex pb-1 price-total">
                    <span>Tổng</span>
                    <span class="ml-auto"> <strong>${cart.total} <sup>đ</sup></strong> </span>
                </div>
                <div class="d-flex pb-1 tax">
                    <span>Thuế</span>
                    <span class="ml-auto"> <strong>${cart.tax} <sup>đ</sup> </strong></span>
                </div>
                <div class="d-flex sub-total">
                    <strong class="font-12">Tổng</strong>
                    <span class="ml-auto font-12 text-success"><strong class="total">${cart.total} <sup>đ</sup></strong> </span>
                </div>
                <div class="d-flex justify-content-end mt-3">
                    <a class="btn btn-success rounded-0 px-3 py-2 font-weight-600" href="/cart/show">Xem Giỏ hàng</a>
                </div>
            </div>
            `;
        $('.cart-body').html(cartHtml);
    }
    $(document).on('click', '#header .dropdown-menu', function (e) {
        e.stopPropagation();
    });
    $('#cart-list').click(function(){
        getCartItem().done(function(data){
            renderCart(data);
        });
    });

    $('.dropdown').on('show.bs.dropdown', function () {
        $(this).find('.dropdown-menu').addClass('animate__fadeIn');
    })

    $('.dropdown').on('hidden.bs.dropdown', function () {
        $(this).find('.dropdown-menu').removeClass('animate__fadeIn');

    })

    function removeCartItem(rowId){
        return $.ajax({
            url: '/cart/remove',
            data: {
                'row_id': rowId,
            },
            type: "POST",
        }).done(function(data){
            getCartItem().done(function(data){
                renderCart(data);
            });
        })
    }
    $(document).on('click', '.btn-remove-cart-item', function(){
        let rowId = $(this).data("row-id");
        removeCartItem(rowId);
    })



    $(document).on('mouseover', '.list-category-item', function(){
        $id = $(this).data('id');
        $('.category-list-item').hide();
        $('#category-' + $id).show();
        $('.list-category-right').show();
    });


    $("[data-trigger]").on("click", function(){
        var trigger_id =  $(this).attr('data-trigger');
        $(trigger_id).toggleClass("show");
        $('body').toggleClass("offcanvas-active");
    });

    // close button
    $(".btn-close").click(function(e){
        $(".navbar-collapse").removeClass("show");
        $("body").removeClass("offcanvas-active");
    });

    $(window).on('scroll', function(){
        var top = $(window).scrollTop();
        if (top > 100) {
            $('.app-bar').hide();
            $('.head-search').attr('style','display:none !important');
        }else if(top == 0){
            $('.app-bar').show();
            $('.head-search').show();
        }
    })

    $('.chat-btn').click(function(){
        FB.CustomerChat.showDialog();
    });

</script>
</body>

</html>
