@extends('master')
@section('title')
    {{ $category->name }}
@endsection

@section('content')
    <section class="container p-0">
        <div class="breadcrumb mt-3">
            <ul itemscope="" itemtype="http://schema.org/BreadcrumbList">
                <li><span> <a href="/"> <span>TRANG CHỦ</span> </a> </span> <span class="delimiter">/</span></li>

                <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem"><strong
                        class="current-item text-uppercase" itemprop="name">{{$category->name}}</strong> <span itemprop="item"
                        itemscope="" itemtype="http://schema.org/Thing" id="/ban-giam-doc-bmg"> </span>
                    <meta itemprop="position" content="1">
                </li>
            </ul>
        </div>
        <div class="p-3 border-bottom">
            <h3 class="text-uppercase text-center">{{ $category->name }}</h3>
        </div>
        <div class="description">
            {{-- {{}} --}}
        </div>
        <div class="row">
            @foreach ($categories as $category)
                <div class="col-md-4 mb-3 col-6 p-2">
                    <div class="p-0">
                        <div class="parent-category">
                            <div class="text-uppercase text-center pb-2"> <a class="text-dark"
                                    href="{{ route('categorymenu.show', $category->slug) }}"><b>{{ $category->name }}</b>
                                </a> </div>

                        </div>
                        <div class="category_thumb border">
                            <a href="{{ route('categorymenu.show', $category->slug) }}">
                                <img class="mw-100 h-100" src="{{ asset($category->image) }}" alt="{{ $category->name }}"
                                    srcset="">
                            </a>
                        </div>

                    </div>

                </div>
            @endforeach

        </div>
        <div class="p-3 border-bottom">
            <h3 class="text-uppercase text-center">sản phẩm nổi bật</h3>
        </div>
        <div class="row">
            @foreach ($featureds as $product)
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
                            <div class="text-uppercase pb-2"><b>{{ number_format($product->price) }} <span>&#8363;</span>
                                </b></div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row">{{$featureds->links()}}</div>
        <div class="content category-description">

            {{-- @dd($category) --}}
            <p>{!! $category_description !!}</p>

        </div>
    </section>
@endsection
