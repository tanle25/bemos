
    @if (Agent::isDesktop())
        <header>
            <div class="container-fluid header-upper d-flex justify-content-end p-0">
                <ul class="top-bar header-links">
                    @if (Auth::check())
                    <li class="d-inline m-2"> <a class="text-dark" href="#">Tài khoản của tôi</a></li>
                    <li class="d-inline m-2"><i class="fad fa-sign-out-alt"></i> <a class="text-dark" href="{{route('auth.logout')}}">Đăng xuất</a></li>

                    @else

                    <li class="d-inline m-2"> <a class="text-dark" href="{{route('user.register')}}">Đăng ký</a> </li>
                    <li class="d-inline m-2"> <a class="text-dark" href="{{route('auth')}}"> Đăng nhập</a></li>
                    @endif
                    <li class="d-inline m-0"><a class="text-dark bg-white  pr-4 pl-3" href="{{route('cart.index')}}"><i class="fal fa-shopping-bag text-dark mr-2"></i> Giỏ hàng ({{Cart::count()}})</a> </li>
                </ul>
            </div>
            <div class="container">
                <div class="row  mb-3 mt-3">
                    <div class="col-md-3 logo">
                        <a href="{{route('home')}}">
                        <img src="{{$theme->logo}}" alt="">
                    </a>
                    </div>
                    <div class="col-md-6  search-form-wraper justify-content-center">
                        <form action="{{route('nomal.search')}}" method="get" class="d-flex search-form" id="search-form">
                            @csrf
                            <input class="form-control me-2" name="keyword" id="keyword" type="text" placeholder="Tìm sản phẩm, thương hiệu" aria-label="Tìm sản phẩm, thương hiệu">
                            <button class="search-button" type="submit"><i class="fas fa-search"></i></button>
                        </form>
                    </div>

                </div>
            </div>
        </header>
{{-- @dd(auth()->user()) --}}
    @else
        <header class="header-top">
            <div class="border py-2 topbar-mobile">
                <div class="d-flex align-items-center container py-1">
                    <a href="/" class="mr-auto">
                        <img src="{{$theme->logo}}" width="auto" height="auto"
                            style="max-height: 60px; max-width:150px" class="mr-auto" alt="logo">
                    </a>
                    <div data-trigger="#cart_nav" id="cart-list" class="cart-list-mobile font-13 mr-2">
                        <a class="text-dark" href="{{route('cart.index')}}">
                        <i class="far fa-shopping-cart"></i>
                        <span class="bg-warning rounded-pill ml-2 px-2 font-8 cart-count">{{Cart::count()}}</span>
                        </a>
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
                    <form class="bg-white d-flex my-1 flex-1 mx-4" action="{{route('nomal.search')}}" method="get" id="search-form">
                        @csrf
                        <input type="text" name="keyword" id="keyword" class="font-8 form-control rounded-0 border-0 py-0 search-input"
                            placeholder="Tìm kiếm sản phẩm">
                        <button class="search-btn btn rounded-0 px-2 py-1"><i class="far fa-search"></i></button>
                    </form>
                </div>
            </div>
        </header>

    @endif

    </header>
