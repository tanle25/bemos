@extends('dashboard')
@section('css')
    <link rel="stylesheet" href="{{asset('plugins/select2/css/select2.min.css')}}">
    <link
      rel="stylesheet"
      href="https://unpkg.com/swiper/swiper-bundle.min.css"
    />
@endsection
@section('title')
Thêm cơ sở kinh doanh
@endsection
@section('content')
<form action="{{route('shop.store')}}" method="POST" enctype="multipart/form-data">

    @csrf
    <div class="row">
    <!-- left column -->
    <div class="col-md-9">
        <!-- general form elements -->

        <div class="card card-info">

            <div class="card-header">
                <h3 class="card-title">Thêm cơ sở kinh doanh</h3>
            </div>

            <div class="card-body">
                <div class="accordion" id="accordionExample">
                    <div class="item">
                        <div class="item-header" id="headingOne">
                            <h2 class="mb-0">
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne"
                                    aria-expanded="true" aria-controls="collapseOne">
                                    Thông tin đăng nhập
                                    <i class="fa fa-angle-down"></i>
                                </button>
                            </h2>
                        </div>
                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                            <div class="t-p">
                                <div class="form-group row">
                                    <label for="email" class="col-sm-2">Email</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="email" name="email" id="email" placeholder="email" value="{{old('email')}}">
                                        @error('email') <span class="text-danger">{{$message}}</span> @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="username" class="col-sm-2">Tên đăng nhập</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" name="username" id="username" placeholder="Tên đăng nhập" value="{{old('username')}}">
                                        @error('username') <span class="text-danger">{{$message}}</span> @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="password" class="col-sm-2">Mật khẩu</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="password" name="password" id="password" placeholder="password">

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="password" class="col-sm-2">Xác nhận mật khẩu</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="password" name="password_confirmation" id="password_confirmation" placeholder="password">
                                        @error('password') <span class="text-danger">{{$message}}</span> @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="slug" class="col-sm-2 col-form-label">Trạng thái</label>
                                    <div class="col-sm-10">
                                        <select name="status" class="select" style="width: 100%">
                                            <option value="1">Đang kinh doanh</option>
                                            <option value="2">Ngừng kinh doanh</option>
                                        </select>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="item-header" id="headingTwo">
                            <h2 class="mb-0">
                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                    data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Thông tin bắt buộc
                                    <i class="fa fa-angle-down"></i>
                                </button>
                            </h2>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                            <div class="t-p">
                                <div class="form-group row">
                                    <label for="shop-name" class="col-sm-2">Tên cơ sở kinh doanh</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" name="shop_name" id="shop-name" placeholder="Tên cơ sở sản xuất kinh doanh" value="{{old('shop_name')}}">
                                        @error('shop_name') <span class="text-danger">{{$message}}</span> @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="slug" class="col-sm-2 col-form-label">Loại doanh nghiệp</label>
                                    <div class="col-sm-10">
                                        <select name="shop_type" class="select" style="width: 100%">
                                            <option value="1">Công ty</option>
                                            <option value="2">Cá nhân</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="slug" class="col-sm-2 col-form-label">Huyện</label>
                                    <div class="col-sm-10">
                                        <select name="district" id="district" class="select" style="width: 100%">
                                            <option></option>
                                            @foreach ($districts as $district )
                                            <option value="{{$district->id}}">{{$district->district_name}}</option>
                                            @endforeach
                                        </select>
                                        @error('district') <span class="text-danger">{{$message}}</span> @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="slug" class="col-sm-2 col-form-label">Xã / Phường</label>
                                    <div class="col-sm-10">
                                        <select name="ward" id="ward" class="select" style="width: 100%">
                                            <option></option>
                                        </select>
                                        @error('ward') <span class="text-danger">{{$message}}</span> @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="address" class="col-sm-2">Thôn, xóm...</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" name="address" id="address" placeholder="Thôn, xóm, tên đường, số nhà" value="{{old('address')}}">
                                        @error('address') <span class="text-danger">{{$message}}</span> @enderror
                                    </div>

                                </div>

                                <div class="form-group row">
                                    <label for="phone" class="col-sm-2">Điện thoại</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" name="phone" id="phone" placeholder="Điện thoại" value="{{old('phone')}}">
                                        @error('phone') <span class="text-danger">{{$message}}</span> @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="slug" class="col-sm-2 col-form-label">Ngành quản lý</label>
                                    <div class="col-sm-10">
                                        <select name="career" class="select" style="width: 100%">
                                            <option></option>
                                            <option value="1">Y tế</option>
                                            <option value="2">Nông nghiệp và phát triển nông thôn</option>
                                            <option value="3">Công thương</option>
                                        </select>
                                        @error('career') <span class="text-danger">{{$message}}</span> @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="slug" class="col-sm-2 col-form-label">Loại giấy tờ</label>
                                    <div class="col-sm-10">
                                        <select name="document_type" class="select" style="width: 100%">
                                            <option></option>
                                            <option value="1"> Giấy cam kết sản xuất TPAT </option>
                                            <option value="2"> Giấy chứng nhận cơ sở đủ ĐK ATTP </option>
                                            <option value="3"> Giấy xác nhận nguồn gốc xuất xứ </option>
                                            <option value="4"> Giấy phép đăng ký kinh doanh </option>
                                            <option value="5"> CMND / Thẻ căn cước </option>

                                        </select>
                                        @error('document_type') <span class="text-danger">{{$message}}</span> @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="document_number" class="col-sm-2">Số giấy tờ</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" name="document_number" id="document_number" placeholder="Số giấy tờ" value="{{old('document_number')}}">
                                        @error('document_number') <span class="text-danger">{{$message}}</span> @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="organ" class="col-sm-2">Cơ quan cấp phép</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" name="organ" id="organ" placeholder="Cơ quan cấp phép" value="{{old('document_place')}}">
                                        @error('organ') <span class="text-danger">{{$message}}</span> @enderror
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="document-date" class="col-sm-2">ngày cấp</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" name="document_date" id="document-date" placeholder="Ngày cấp" value="{{old('document_date')}}" >
                                        @error('document_date') <span class="text-danger">{{$message}}</span> @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2">Ảnh giấy tờ</label>
                                    <div class="col-sm-3">
                                        <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn image-header-wrapper">
                                            <img class="header-image" id="holder" src="{{ $shop->shop_document_img1 ?? asset('images/placeholder-image.png')}}" alt="" sizes="" srcset="">
                                        </a>
                                        <input id="thumbnail" type="hidden" name="image1" class="form-control"  value="{{$shop->shop_document_img1 ?? ''}}">
                                        <label for="lfm">Ảnh giấy tờ 1</label>
                                        @error('image1') <span class="text-danger">{{$message}}</span> @enderror
                                    </div>

                                    {{-- <label for="shop-name" class="col-sm-2">Ảnh giấy tờ 2</label> --}}
                                    <div class="col-sm-3">
                                        <a id="lfm1" data-input="thumbnail1" data-preview="holder1" class="btn image-header-wrapper">
                                            <img class="header-image" id="holder1" src="{{ $shop->shop_document_img1 ?? asset('images/placeholder-image.png')}}" alt="" sizes="" srcset="">
                                        </a>
                                        <input id="thumbnail1" type="hidden" name="image2" class="form-control"  value="{{$shop->shop_document_img1 ?? ''}}">
                                        <label for="lfm2" >Ảnh giấy tờ 2</label>
                                        @error('image2') <span class="text-danger">{{$message}}</span> @enderror
                                    </div>
                                </div>



                                <div class="form-group row">
                                    <label for="person" class="col-sm-2">Người đại diện</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" name="person" id="person" placeholder="Người Đại diện" value="{{old('person')}}">
                                        @error('person') <span class="text-danger">{{$message}}</span> @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="slug" class="col-sm-2 col-form-label">Quy mô</label>
                                    <div class="col-sm-10">
                                        <select name="scale" class="select" style="width: 100%">
                                            <option></option>

                                            <option value="1"> Cá nhân, hộ gia đình </option>
                                            <option value="2"> Trang trại, xưởng </option>
                                            <option value="3"> Hợp tác xã </option>
                                            <option value="4"> Doanh nghiệp siêu nhỏ </option>
                                            <option value="5"> Doanh nghiệp nhỏ </option>
                                            <option value="6"> Doanh nghiệp vừa </option>
                                            <option value="7"> Doanh nghiệp lớn </option>
                                        </select>
                                        @error('scale') <span class="text-danger">{{$message}}</span> @enderror
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                    <div class="item">
                        <div class="item-header" id="headingThree">
                            <h2 class="mb-0">
                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                    data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Thông tin thêm
                                    <i class="fa fa-angle-down"></i>
                                </button>
                            </h2>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                            <div class="t-p">
                                <div class="form-group row">
                                    <div class="col-sm-2"><label for="content">Giới thiệu</label></div>
                                    <div class="col-sm-10">
                                        <textarea name="content" id="content" class="form-control" rows="3">
                                            {!!old('content')!!}
                                        </textarea>
                                        @error('content') <span class="text-danger">{{$message}}</span> @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-2"><label for="map">Map</label></div>
                                    <div class="col-sm-10">
                                        <textarea name="map" id="map" class="form-control" rows="3">
                                            {!!old('map')!!}
                                        </textarea>
                                        @error('content') <span class="text-danger">{{$message}}</span> @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="wesite" class="col-sm-2">Website</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" name="wesite" id="wesite" placeholder="website" value="{{old('website')}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="fanpage" class="col-sm-2">Fanpage</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" name="fanpage" id="fanpage" placeholder="fanpage" value="{{old('fanpage')}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="item">
                        <div class="item-header" id="headingFour">
                            <h2 class="mb-0">
                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                    data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    Collapsible Item #4
                                    <i class="fa fa-angle-down"></i>
                                </button>
                            </h2>
                        </div>
                        <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                            <div class="t-p">
                                It is a long established fact that a reader will be distracted by the readable content of a page
                                when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal
                                distribution of letters, as opposed to using 'Content here, content here', making it look like
                                readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their
                                default model text, and a search for 'lorem ipsum' will uncover many web sites still in their
                                infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose
                                (injected humour and the like).
                            </div>
                        </div>
                    </div> --}}
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
                        <div class="mb-10">
                            <a id="lfm2" data-input="thumbnail2" data-preview="holder2" class="btn image-header-wrapper">
                                <img class="header-image" id="holder2"  src="{{$shop->shop_avatar ?? asset('images/placeholder-image.png')}}" alt="" sizes="" srcset="">
                            </a>
                            <input id="thumbnail2" type="hidden" name="avatar" class="form-control"  value="{{$shop->shop_avatar ?? ''}}">
                            <span class="product-avatar">Ảnh đại diện</span>
                            @error('avatar') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div class="row">

                            <div class="col-6">
                                <button type="submit" class="form-control btn btn-success">Save</button>
                            </div>
                            <div class="col-6">
                                <button type="button" class="form-control btn btn-danger">Exit</button>
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
<script src="{{asset('plugins/select2/js/select2.min.js')}}"></script>
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
    $('#lfm1').filemanager1('image',{prefix: route_prefix});
    $('#lfm2').filemanager1('image',{prefix: route_prefix});
    $(document).ready(function() {
    $('.select').select2();
});
$(document).on('change','#district',function(){
    var id =$('#district').select2('data')[0].id;
    $.ajax({
        type: "get",
        url: "/list-ward/"+id,

        dataType: "json"
    }).done(function(data){
        var obj = JSON.parse(data);
        $('#ward').html('');
        $.each(obj, function (indexInArray, valueOfElement) {
            $('#ward').append(`<option value="${valueOfElement.id}">${valueOfElement.ward_name}</option>`);
            // console.log(valueOfElement.ward_name);
        });


    });
});



</script>

@endsection
