@extends('master')
@section('title')
    {{ $category->name }}
@endsection

@section('content')
    <section class="container p-0">
        <div class="breadcrumb mt-5">
            <ul itemscope="" itemtype="http://schema.org/BreadcrumbList">
                <li><span> <a href="/"> <span>TRANG CHỦ</span> </a> </span> <span class="delimiter">/</span></li>
                {{-- @dd($parent) --}}
                @if ($parent)
                <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem"><a class="text-uppercase" href="{{route('categorymenu.show',$parent->slug)}}"
                        title="BÀN VĂN PHÒNG" itemprop="item"> <span itemprop="name">{{$parent->name}}</span> </a> <span
                        class="delimiter">/</span>
                    <meta itemprop="position" content="1">
                </li>
                @endif

                <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem"><strong
                        class="current-item text-uppercase" itemprop="name">{{ $category->name }}</strong> <span
                        itemprop="item" itemscope="" itemtype="http://schema.org/Thing" id="/ban-giam-doc-bmg"> </span>
                    <meta itemprop="position" content="2">
                </li>
            </ul>
        </div>
        <div class="p-3 border-bottom">
            <h3 class="text-uppercase text-center">{{ $category->name }}</h3>
        </div>
        <div class="content category-description">

            {{-- @dd($category) --}}
            <p>{!! $category->description !!}</p>

        </div>
        <div class="row">
            @foreach ($products as $product)
                <div class="col-md-3 mb-3 col-6 p-2">
                    <div class=" p-3 border">
                        <div class="category_thumb mb-3">
                            <a href="{{ route('detail.show', $product->slug) }}">
                                <img class="w-100" src="{{ asset($product->avatar) }}" alt="{{ $product->name }}" srcset="">
                            </a>
                        </div>
                        <div class="product-price-wraper">
                            <div class="text-uppercase pb-2"> <a class="text-dark"
                                    href="{{ route('detail.show', $product->slug) }}"><b>{{ $product->sku }}</b> </a> </div>
                            <div class="text-uppercase pb-2 "><a class="product-name"
                                    href="{{ route('detail.show', $product->slug) }}">
                                    {{ Str::limit($product->name, 15, '...') }} </a></div>
                            @if ($product->promotion_price != null)
                                <div class="d-flex justify-content-between">
                                    <div class="text-uppercase pb-2 text-decoration">
                                        <b>{{ number_format($product->price) }} <span>&#8363;</span> </b></div>
                                    <div class="text-uppercase pb-2"><b>{{ number_format($product->promotion_price) }}
                                            <span>&#8363;</span> </b></div>
                                </div>

                            @else
                                <div class="text-uppercase pb-2"><b>{{ number_format($product->price) }}
                                        <span>&#8363;</span> </b></div>
                            @endif

                        </div>
                    </div>

                </div>
            @endforeach

        </div>
        <div class="d-flex justify-content-center">
            {{ $products->links() }}
        </div>
    </section>
@endsection
