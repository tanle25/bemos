@extends('dashboard')
@section('css')
    <link rel="stylesheet" href="{{asset('Plugins/select2/css/select2.min.css')}}">
    <link
      rel="stylesheet"
      href="https://unpkg.com/swiper/swiper-bundle.min.css"
    />
@endsection
@section('title')
Sửa sản phẩm
@endsection
@section('content')
<form action="{{route('product.update',$product->id)}}" method="POST" enctype="multipart/form-data">

    @csrf
    @method('put')
    <div class="row">
    <!-- left column -->
    <div class="col-md-9">
        <!-- general form elements -->

        <div class="card card-info">

            <div class="card-header">
                <h3 class="card-title">Sửa sản phẩm</h3>
            </div>

            <div class="card-body">
                <div class="form-group row">
                    <label for="product-name" class="col-sm-2 col-form-label">Tên sản phẩm</label>
                    <div class="col-sm-10">
                        <input type="text" id="product-name" name="title" class="form-control" placeholder="Tên sản phẩm"
                            value="{{$product->name ?? ''}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="pagename" class="col-sm-2 col-form-label">Mã sản phẩm</label>
                    <div class="col-sm-10">
                        <input type="text" id="pagename" name="product_code" class="form-control" placeholder="Tên sản phẩm"
                            value="{{$product->sku ?? ''}}" disabled>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="slug" class="col-sm-2 col-form-label">Slug</label>
                    <div class="col-sm-10">
                        <input type="text" id="slug" name="slug" class="form-control" placeholder="Tên sản phẩm"
                            value="{{$product->slug ?? ''}}">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="slug" class="col-sm-2 col-form-label">Danh mục sản phẩm</label>
                    <div class="col-sm-10">
                        <select name="product_category" class="select" style="width: 100%">
                            <option value="0"></option>
                            @foreach ($types as $type )
                                <option value="{{$type->id}}" @if ($product->category_id == $type->id) selected @endif>{{$type->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>



                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Chi tiết sản phẩm</label>
                    <div class="col-sm-10">
                        <div class="form-group row">
                            <label for="price" class="col-sm-2 col-form-label">Giá gốc</label>
                            <div class="col-sm-4"><input type="text" id="price" name="price" class="form-control" placeholder="Giá gốc" value="{{$product->price}}"></div>
                            <label for="promotion" class="col-sm-2 col-form-label">Giá khuyến mãi</label>
                            <div class="col-sm-4"><input type="text" id="promotion" name="promotion" class="form-control" placeholder="Giá khuyến mãi" value="{{$product->promotion_price}}"></div>

                        </div>
                    </div>
                </div>


                <div class="form-group row">
                    <label for="slug" class="col-sm-2 col-form-label">Ảnh</label>
                    <div class="col-sm-2">
                        <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn image-header-wrapper">
                            <img class="header-image" id="favicon" src="{{ asset('images/default-image.png')}}" alt="" sizes="" srcset="">
                        </a>
                        <a role="button" class="btn btn-danger" id="clear-image">Clear</a>
                        <input id="thumbnail" type="hidden" name="images" class="form-control"  value="{{$image_string ?? ''}}">
                    </div>
                    <div class="col-sm-8">
                        <div class="swiper-container mySwiper">
                            <div class="swiper-wrapper" id="holder">
                              {{-- <div class="swiper-slide"><img src="" alt=""></div> --}}
                              @foreach ( json_decode($product->images) ??[]  as $image )
                                  <div class="swiper-slide"><img src="{{asset($image)}}" alt="" width="250px"></div>
                              @endforeach

                            </div>
                            <div class="swiper-pagination"></div>
                          </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="slug" class="col-sm-2 col-form-label">Mô tả</label>
                    <div class="col-sm-10">
                        <textarea name="short_description" class="form-control" rows="3">{!!$product->short_description ?? ''!!}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="slug" class="col-sm-2 col-form-label">Mô tả</label>
                    <div class="col-sm-10">
                        <textarea name="content" id="content" class="form-control" rows="3">{!!$product->description ?? ''!!}</textarea>
                    </div>
                </div>

        </div>
    </div>
            <!-- /.card-body -->
        </div>
            <div class="col-md-3">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Hành động</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <label for="">Sản phẩm nổi bật:</label>
                            </div>
                            <div class="col">
                                <label class="switch">
                                    <input type="checkbox" name="featured" @if($product->featured == 1) checked @endif>
                                    <span class="slider round"></span>
                                  </label>
                            </div>
                        </div>
                        <div class="row mb-3 mt-3">
                            <div class="col">
                                <label for="">Trạng thái:</label>
                            </div>
                            <div class="col">
                                <label class="switch">
                                    <input type="checkbox" name="status" @if($product->status == 1) checked @endif >
                                    <span class="slider round"></span>
                                  </label>
                            </div>
                        </div>
                        {{-- <div class="row mb-3 mt-3">
                            <div class="col">
                                <label for="">Voucher:</label>
                            </div>
                            <div class="col">
                                <button type="button" class="btn btn-success" id="voucher">Thêm voucher</button>
                            </div>
                        </div> --}}
                        <hr>
                        <div class="mb-5">
                            <a id="lfm1" data-input="thumbnail1" data-preview="holder1" class="btn image-header-wrapper">
                                <img class="header-image" id="holder1" id="favicon" src="{{asset($product->avatar) ?? asset('images/placeholder-image.png')}}" alt="" sizes="" srcset="">
                            </a>
                            <input id="thumbnail1" type="hidden" name="avatar" class="form-control"  value="{{$product->avatar ?? ''}}">
                            <span class="product-avatar">Ảnh đại diện</span>

                        </div>
                        <div class="row">

                            <div class="col-6">
                                <button type="submit" class="form-control btn btn-success">Save</button>
                            </div>
                            <div class="col-6">
                                <a role="button" href="{{route('product.index')}}" class="form-control btn btn-danger">Exit</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</form>
@endsection
@section('js')
<script src="{{asset('vendor/laravel-filemanager/js/alone-button.js')}}"></script>
<script src="{{asset('Plugins/select2/js/select2.min.js')}}"></script>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
<script>
    var options = {
    filebrowserImageBrowseUrl: '/admin/laravel-filemanager?type=Images',
    filebrowserImageUploadUrl: '/admin/laravel-filemanager/upload?type=Images&_token=',
    filebrowserBrowseUrl: '/admin/laravel-filemanager?type=Files',
    filebrowserUploadUrl: '/admin/laravel-filemanager/upload?type=Files&_token='
  };
CKEDITOR.replace( 'content',options );
var route_prefix = "/admin/laravel-filemanager";
    $('#lfm').filemanager('image',{prefix: route_prefix});
    $('#lfm1').singleImage('image',{prefix: route_prefix});
    $(document).ready(function() {
    $('.select').select2();
});
var swiper = new Swiper(".mySwiper", {
        slidesPerView: 3,
        spaceBetween: 10,
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
        },
      });
$('#clear-image').on('click',function(){
    $('#holder').html('');
    $('#thumbnail').val('');
});

$(document).on('change','#product-name',function(){
    $.ajax({
        type: "get",
        url: "{{route('page.slug')}}",
        data: {"title":$(this).val()},
        dataType: 'html',
        success:function(response){
            $('#slug').val(response);
        }
    })

});
$(document).ready(function () {
    $('#voucher').on('click',()=>{
        $.ajax({
            type: "get",
            url: "/admin/add-voucher",
            data: {
                'product_id':"{{$product->id}}"
            },
            dataType: "json",
            success: function (response) {
                console.log(response);
            }
        });
    });
});
</script>

@endsection
