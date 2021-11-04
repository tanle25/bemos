@extends('master')

@section('content')
    <section class="container">
        <h3 class="text-center mt-5 pb-3">Tìm kiếm</h3>
        <div class="d-flex justify-content-center pt-3 pb-3 border-bottom border-top">
            <form action="{{route('nomal.search')}}" method="get" style="width: 500px">
                @csrf
                <div class="form-group row">
                    <label for="" class="col-sm-4 m-0">Từ khoá</label>
                    <div class="col-md-8">
                        <input class="form-control" name="keyword" type="text" placeholder="Từ khoá" value="{{old('keyword')}}">
                        <div class="w-100 d-flex justify-content-center p-0">
                            <div class="panel-group checkbox_collapse w-100" id="accordion">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title"> <a data-toggle="collapse" data-parent="#accordion" href="#collapse1"> <span class="circle"></span> Tìm kiếm nâng cao </a> </h4>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mb-3">
                        <div id="collapse1" class="row panel-collapse collapse in">
                            <label for="" class="col-sm-4 m-0">Nhóm sản phẩm</label>
                            <div class="col-md-8 mb-3">
                                <select name="category" id="" class="w-100">
                                    <option value=""></option>
                                    @foreach ($categories as $category )
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <label for="" class="col-sm-4 m-0">Khoảng giá</label>
                            <div class="col-md-8 d-flex justify-content-between">
                                <input class="form-control" type="number" name="price_from" placeholder="từ" value="{{old('price_from')}}">
                                <input class="form-control" type="number" placeholder="đến" name="price_to" value="{{old('price_to')}}">
                            </div>
                        </div>
                    </div>


                    <div class="col-12 d-flex justify-content-center">
                    <button class="btn btn-login">Tìm kiếm</button>
                    </div>
                </div>
            </form>
        </div>
<div class="container">
    <div class="row pt-3 mt-3 border-top">
        @if ($products->first() ==null)
        <h3 class="text-danger text-center">Không tìm thấy sản phẩm</h3>
        @else
            @foreach ( $products as $product)
            <div class="col-md-3 mb-3 col-6 p-2">
                <div class=" p-3 border">
                    <div class="category_thumb mb-3">
                        <a href="{{route('detail.show',$product->slug)}}">
                        <img class="w-100" src="{{asset($product->avatar)}}" alt="BÀN HỌP BMH-10082" srcset="">
                        </a>
                    </div>
                    <div class="product-price-wraper">
                        <div class="text-uppercase pb-2"> <a class="text-dark" href="{{route('detail.show',$product->slug)}}"><b>{{$product->sku}}</b> </a> </div>
                        <div class="text-uppercase pb-2 "><a class="product-name" href="{{route('detail.show',$product->slug)}}"> {{Str::limit($product->name, 15, '...') }} </a></div>
                        <div class="text-uppercase pb-2"><b>{{number_format($product->price)}} <span>&#8363;</span></b></div>
                    </div>
                </div>
            </div>
            @endforeach
        @endif
        <div class="col-12 d-flex justify-content-center">
            {{ $products->onEachSide(0)->links() }}
        </div>
    </div>
</div>

    </section>
@endsection
