<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-152750925-1"></script>
    <script>function gtag() { dataLayer.push(arguments) } window.dataLayer = window.dataLayer || []; gtag("js", new Date); gtag("config", "UA-152750925-1")</script>
    <link href="{{asset('https://bemos.vn/Themes/Simplz/Content/css/all.min.css?v=1.0.0.6')}}" rel=stylesheet>
    <link href=https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css rel=stylesheet>
    <link href=https://use.fontawesome.com/releases/v5.8.2/css/all.css rel=stylesheet>
    <link href=https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.9/css/mdb.min.css rel=stylesheet>
    <link href="{{asset('Plugins/Widgets.NivoSlider/Content/nivoslider/nivo-slider.css')}}" rel=stylesheet>
    <link href="{{asset('Plugins/Widgets.NivoSlider/Content/nivoslider/themes/custom/custom.css')}}" rel=stylesheet>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <link rel="stylesheet" href="{{asset('css/style.css')}}">

    <link rel="shortcut icon" href=icons/favicon.jpg>
    <title>Document</title>
</head>

<body>


    @if (Agent::isDesktop())
    <header>
        <div class="container-fluid  bg-white  d-flex justify-content-end">
            <ul class="top-bar">
                <li class="d-inline m-2">Đăng ký</li>
                <li class="d-inline m-2">Đăng nhập</li>
                <li class="d-inline m-2">Giỏ hàng</li>
            </ul>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-7 search-form-wraper">
                    <form class="d-flex search-form">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="search-button" type="submit"><i class="fas fa-search"></i></button>
                    </form>
                </div>
                <div class="col-md-9 order-first order-md-2 col-5 logo">
                    <img src="https://bemos.vn/images/thumbs/0001910_Bemos-logo-225.png" alt="">
                </div>
            </div>
        </div>


    </header>
    @else
    <div class="border border-danger py-2 sticky-top topbar-mobile">
        <div class="d-flex align-items-center container py-1">
            <a href="/" class="mr-auto">
                <img src="https://bemos.vn/images/thumbs/0001910_Bemos-logo-225.png" width="auto" height="auto"
                    style="max-height: 60px; max-width:150px" class="mr-auto" alt="logo">
            </a>
            <div data-trigger="#cart_nav" id="cart-list" class="cart-list-mobile font-13 mr-2">
                <i class="far fa-shopping-cart"></i>
                <span class="bg-warning rounded-pill ml-2 px-2 font-8 cart-count">{{Cart::count()}}</span>
            </div>
            <a aria-controls="search-box" aria-expanded="false" data-toggle="collapse" data-target="#search-box"
                class="font-13 ml-3"><i class="far fa-search"></i></a>
            <div id="nav-icon4" data-trigger="#navbarTogglerDemo03" class="font-17 ml-4">
                <div class="bar1"></div>
                <div class="bar2"></div>
                <div class="bar3"></div>
            </div>
        </div>
        <div class="search-input collapse border" id="search-box">
            <div class="bg-white d-flex my-1 flex-1 mx-4" action="/tim-kiem" method="post">
                <input type="text" class="font-8 form-control rounded-0 border-0 py-0 search-input"
                    placeholder="Tìm kiếm sản phẩm"
                    value="@isset($filter_list['keyword']) {{$filter_list['keyword']}} @endisset">
                <button class="search-btn btn rounded-0 px-2 py-1"><i class="far fa-search"></i></button>
            </div>
        </div>
    </div>


    @endif

    </header>


    <main class="main-home">


        @if (Agent::isDesktop())
    <div class="container bg-white header position-sticky sticky-top mt-3 pl-0 pr-0">
        <nav class="navbar navbar-expand-lg navbar-light p-0">
            <ul class="navbar-nav mr-auto header-expandable-menu">
                <li class="nav-item dropdown mega-dropdown mega-menu-button"><a
                        class="nav-link dropdown-toggle text-uppercase mega-menu-button text-white bg-danger"
                        id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        <i class="fa fa-align-justify"></i> </a></li>
                <li class="nav-item shopcard-button"><a class="nav-linktext-uppercase text-white" href="/cart"><i
                            class="fa fa-cart-arrow-down"></i></a></li>
            </ul>
            <div class="container-fluid pl-0">


                <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">BÀN VĂN PHÒNG</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="#">TỦ VĂN PHÒNG</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="#">KỆ VĂN PHÒNG</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="#">GHẾ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="#">DỰ ÁN</a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" aria-current="page" href="#">GIỚI THIỆU</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    @endif

        <div class="collapse navbar-collapse nav-bar-mobile h-100 pl-5" id="navbarTogglerDemo03">
            {{-- <div data-trigger="#navbarTogglerDemo03" class="font-17 ml-4 float-right"><i class="fas fa-times"></i>
            </div> --}}
            <ul class="navbar-nav me-auto mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link nav-link-mobile active" aria-current="page" href="#">BÀN VĂN PHÒNG</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-mobile" aria-current="page" href="#">TỦ VĂN PHÒNG</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-mobile" aria-current="page" href="#">KỆ VĂN PHÒNG</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-mobile" aria-current="page" href="#">GHẾ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-mobile" aria-current="page" href="#">DỰ ÁN</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link nav-link-mobile" aria-current="page" href="#">GIỚI THIỆU</a>
                </li>
            </ul>
        </div>
        <section class="container-fluid">
            <div class="slider-wrapper theme-custom m-0">
                <div id=nivo-slider class=nivoSlider><img src="images/thumbs/0001660_noi-that-van-phong%20(12).jpeg"
                        data-thumb="images/thumbs/0001660_noi-that-van-phong (12).jpeg" data-transition="" alt=""> <img
                        src="images/thumbs/0001661_noi-that-van-phong%20(3).jpeg"
                        data-thumb="images/thumbs/0001661_noi-that-van-phong (3).jpeg" data-transition="" alt=""> <img
                        src="images/thumbs/0001662_noi-that-van-phong%20(4).jpeg"
                        data-thumb="images/thumbs/0001662_noi-that-van-phong (4).jpeg" data-transition=slideInLeft
                        alt=""> <img src="images/thumbs/0008571_banner%20noi%20that%20VP%20wweb%201350x465.png"
                        data-thumb="images/thumbs/0008571_banner noi that VP wweb 1350x465.png" data-transition=""
                        alt=""> <img src="images/thumbs/0001664_noi-that-van-phong%20(7).jpeg"
                        data-thumb="images/thumbs/0001664_noi-that-van-phong (7).jpeg" data-transition="" alt="">
                </div>
            </div>
        </section>
        <section class="container">
            <div class="title mt-5 mb-5">
                <h3 class="text-center">SẢN PHẨM BÁN CHẠY</h3>
            </div>
            <div class="swiper-container mySwiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide border">
                        <div class="image"> <img class="w-100" src="images/thumbs/0003760_ntvp-ban-giam-doc_800.jpeg"
                                alt="" width="200px" height="200px"></div>
                        <div class="content">
                            <div class="product-name">
                                BÀN GIÁM ĐỐC BMG-10025
                            </div>
                            <div class="price">
                                <span>19.000.000</span>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide border">
                        <div class="image"> <img class="w-100" src="images/thumbs/0003760_ntvp-ban-giam-doc_800.jpeg"
                                alt="" width="200px" height="200px"></div>
                        <div class="content">
                            <div class="product-name">
                                BÀN GIÁM ĐỐC BMG-10025
                            </div>
                            <div class="price">
                                <span>19.000.000</span>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide border">
                        <div class="image"> <img class="w-100" src="images/thumbs/0003760_ntvp-ban-giam-doc_800.jpeg"
                                alt="" width="200px" height="200px"></div>
                        <div class="content">
                            <div class="product-name">
                                BÀN GIÁM ĐỐC BMG-10025
                            </div>
                            <div class="price">
                                <span>19.000.000</span>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide border">
                        <div class="image"> <img class="w-100" src="images/thumbs/0003760_ntvp-ban-giam-doc_800.jpeg"
                                alt="" width="200px" height="200px"></div>
                        <div class="content">
                            <div class="product-name">
                                BÀN GIÁM ĐỐC BMG-10025
                            </div>
                            <div class="price">
                                <span>19.000.000</span>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide border">
                        <div class="image"> <img class="w-100" src="images/thumbs/0003760_ntvp-ban-giam-doc_800.jpeg"
                                alt="" width="200px" height="200px"></div>
                        <div class="content">
                            <div class="product-name">
                                BÀN GIÁM ĐỐC BMG-10025
                            </div>
                            <div class="price">
                                <span>19.000.000</span>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide border">
                        <div class="image"> <img class="w-100" src="images/thumbs/0003760_ntvp-ban-giam-doc_800.jpeg"
                                alt="" width="200px" height="200px"></div>
                        <div class="content">
                            <div class="product-name">
                                BÀN GIÁM ĐỐC BMG-10025
                            </div>
                            <div class="price">
                                <span>19.000.000</span>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide border">
                        <div class="image"> <img class="w-100" src="images/thumbs/0003760_ntvp-ban-giam-doc_800.jpeg"
                                alt="" width="200px" height="200px"></div>
                        <div class="content">
                            <div class="product-name">
                                BÀN GIÁM ĐỐC BMG-10025
                            </div>
                            <div class="price">
                                <span>19.000.000</span>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide border">
                        <div class="image"> <img class="w-100" src="images/thumbs/0003760_ntvp-ban-giam-doc_800.jpeg"
                                alt="" width="200px" height="200px"></div>
                        <div class="content">
                            <div class="product-name">
                                BÀN GIÁM ĐỐC BMG-10025
                            </div>
                            <div class="price">
                                <span>19.000.000</span>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide border">
                        <div class="image"> <img class="w-100" src="images/thumbs/0003760_ntvp-ban-giam-doc_800.jpeg"
                                alt="" width="200px" height="200px"></div>
                        <div class="content">
                            <div class="product-name">
                                BÀN GIÁM ĐỐC BMG-10025
                            </div>
                            <div class="price">
                                <span>19.000.000</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>

        </section>
        <section class="container-fluid bg-dark mt-3 mb-3 p-0">
            <div class="p-5">

            <h3 class="text-white text-center text-uppercase font-weight-bold"> NỘI THẤT VĂN PHÒNG</h3>
            <h6 class="text-center text-white">Những thương hiệu được người tiêu dùng lựa chọn, phổ biến trên thị trường</h6>
            </div>
            <div class="container swiper-container popular">
                <div class="swiper-wrapper">
                  <div class="swiper-slide">
                    <div class="row">
                        <div class="col-md-8 pr-0 popular-img">
                            <img class="w-100" src="https://bemos.vn/images/thumbs/0003764_ntvp-ke-van-phong_800.jpeg" alt="">
                        </div>
                        <div class="col-md-4 popular-right-colunm  bg-white">
                            <div class="row border">
                                <div class="col-4 p-0">
                                    <img class="w-100" src="https://bemos.vn/images/thumbs/0006916_ke-giam-doc-bmkg-10012_88.png" alt="">
                                </div>
                                <div class="col-8 p-0 popular-item pl-3">
                                    <div><span class="popular-title">Ke giam doc</span></div>
                                    <div><strong>5.000.000d</strong> </div>
                                </div>
                            </div>
                            <div class="row border">
                                <div class="col-4 p-0">
                                    <img class="w-100" src="https://bemos.vn/images/thumbs/0006916_ke-giam-doc-bmkg-10012_88.png" alt="">
                                </div>
                                <div class="col-8 p-0 popular-item pl-3">
                                    <div><span class="popular-title">Ke giam doc</span></div>
                                    <div><strong>5.000.000d</strong> </div>
                                </div>
                            </div>
                            <div class="row border">
                                <div class="col-4 p-0">
                                    <img class="w-100" src="https://bemos.vn/images/thumbs/0006916_ke-giam-doc-bmkg-10012_88.png" alt="">
                                </div>
                                <div class="col-8 p-0 popular-item pl-3">
                                    <div><span class="popular-title">Ke giam doc</span></div>
                                    <div><strong>5.000.000d</strong> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                  </div>
                  <div class="swiper-slide">
                    <div class="row">
                        <div class="col-md-8 pr-0 popular-img">
                            <img class="w-100" src="https://bemos.vn/images/thumbs/0003764_ntvp-ke-van-phong_800.jpeg" alt="">
                        </div>
                        <div class="col-md-4  popular-right-colunm  bg-white">
                            <div class="row">
                                <div class="col-4 p-0">
                                    <img class="w-100" src="https://bemos.vn/images/thumbs/0006916_ke-giam-doc-bmkg-10012_88.png" alt="">
                                </div>
                                <div class="col-8 p-0">
                                    <div>Ke giam doc</div>
                                    <div>5000000d</div>
                                </div>
                            </div>
                        </div>
                    </div>
                  </div>
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-pagination"></div>
              </div>
        </section>
        <section class="category-section">
            <div class="border-top-width"></div>
            <div class="container">
                <div class="p-5 d-none category-title-mobie">
                    <h3 class="text-center text-uppercase font-weight-bold">Ban van phong</h3>
                    </div>
                <div class="row category-product">
                    <div class="col-md-2">
                        <div class="">
                            BÀN VĂN PHÒNG
                        </div>
                    </div>
                    <div class="col-md-3">
                        <img class=" w-100" src="https://bemos.vn/images/thumbs/0001932_ban-van-phong_592.jpeg" alt="">

                    </div>
                    <div class="col-md-7">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <img class="w-100" src="https://bemos.vn/images/thumbs/0004555_ban-giam-doc-bmg-10039_163.jpeg" alt="">
                                <div class="category-item">
                                    <span>BÀN GIÁM ĐỐC BMG-10039</span>
                                    <strong>18.000.000 d</strong>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <img class="w-100" src="https://bemos.vn/images/thumbs/0004555_ban-giam-doc-bmg-10039_163.jpeg" alt="">
                                <div class="category-item">
                                    <span>BÀN GIÁM ĐỐC BMG-10039</span>
                                    <strong>18.000.000 d</strong>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <img class="w-100" src="https://bemos.vn/images/thumbs/0004555_ban-giam-doc-bmg-10039_163.jpeg" alt="">
                                <div class="category-item">
                                    <span>BÀN GIÁM ĐỐC BMG-10039</span>
                                    <strong>18.000.000 d</strong>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <img class="w-100" src="https://bemos.vn/images/thumbs/0004555_ban-giam-doc-bmg-10039_163.jpeg" alt="">
                                <div class="category-item">
                                    <span>BÀN GIÁM ĐỐC BMG-10039</span>
                                    <strong>18.000.000 d</strong>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <img class="w-100" src="https://bemos.vn/images/thumbs/0004555_ban-giam-doc-bmg-10039_163.jpeg" alt="">
                                <div class="category-item">
                                    <span>BÀN GIÁM ĐỐC BMG-10039</span>
                                    <strong>18.000.000 d</strong>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <img class="w-100" src="https://bemos.vn/images/thumbs/0004555_ban-giam-doc-bmg-10039_163.jpeg" alt="">
                                <div class="category-item">
                                    <span>BÀN GIÁM ĐỐC BMG-10039</span>
                                    <div class="d-flex justify-content-md-around">
                                        <strong>18.000.000 d</strong>
                                        <p class="text-danger text-decoration-line-through">18.000.000 d</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="border-bottom-width"></div>
        </section>
    </main>
    <script src=https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    {{--
    <script src="{{asset('https://bemos.vn/lib/jquery-ui/jquery-ui-1.12.1.custom/jquery-ui.min.js')}}"></script> --}}
    <script src="{{asset('Plugins/Widgets.NivoSlider/Scripts/jquery.nivo.slider.js')}}"></script>
    @yield('js')
    @include('user.script.scrip')
    <script>
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
                    slidesPerView: 4,
                    spaceBetween: 30
                },
                1028: {
                    slidesPerView: 2,
                    spaceBetween: 30
                },
                480: {
                    slidesPerView: 2,
                    spaceBetween: 10
                }
            }
        });
        new Swiper('.popular',{
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            pagination: {
                el: ".swiper-pagination",
            },
        });
    </script>
</body>

</html>
