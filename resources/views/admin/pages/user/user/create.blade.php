@extends('dashboard')
@section('css')
    <link rel="stylesheet" href="{{asset('Plugins/select2/css/select2.min.css')}}">
@endsection
@section('title')
Thêm người dùng mới
@endsection
@section('content')
<form action="{{route('user-info.store')}}" method="POST" enctype="multipart/form-data">

    @csrf
    <div class="row">
    <!-- left column -->
    <div class="col-md-9">
        <!-- general form elements -->

        <div class="card card-info">

            <div class="card-header">
                <h3 class="card-title">Thêm người dùng mới</h3>
            </div>

            <div class="card-body">
                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">Họ</label>
                    <div class="col-sm-4">
                        <input type="text" id="" name="last_name" class="form-control" placeholder="Họ"
                            value="{{old('last_name')}}">
                            @error('last_name') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <label for="" class="col-sm-2 col-form-label text-right">Tên</label>
                    <div class="col-sm-4">
                        <input type="text" id="" name="first_name" class="form-control" placeholder="Họ"
                            value="{{old('first_name')}}">
                            @error('first_name') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">Giới tính</label>
                    <div class="col-sm-4">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="inlineRadio1" value="male" @if(old('male')) checked @endif>
                            <label class="form-check-label" for="inlineRadio1">Nam</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="inlineRadio2" value="female"  @if(old('female')) checked @endif>
                            <label class="form-check-label" for="inlineRadio2">Nữ</label>
                          </div>
                          @error('gender')
                              <span class="text-danger">{{$message}}</span>
                          @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="email" name="email" placeholder="Email"
                            value="{{old('first_name')}}">
                            @error('email') <span class="text-danger">{{$message}}</span> @enderror

                    </div>
                </div>

                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">Địa chỉ</label>
                    <div class="col-sm-10">
                        <div class="form-group row">

                            <div class="col-sm-3">
                                <label for="province">Tỉnh</label>
                                <select class="select" name="province" id="province" style="width: 100%">
                                    <option value="">Tỉnh / Thành</option>
                                    @foreach ($provinces as $province )
                                    <option value="{{$province->id}}">{{$province->_name}}</option>
                                    @endforeach
                                </select>
                            @error('province') <span class="text-danger">{{$message}}</span> @enderror

                            </div>
                            <div class="col-sm-3">
                                <label for="district">Quận / Huyện</label>
                                <select class="select" name="district" id="district" style="width: 100%">
                                    <option value="">Quận / Huyện</option>
                                    {{-- @dd($district) --}}

                                </select>
                            @error('district') <span class="text-danger">{{$message}}</span> @enderror

                            </div>
                            <div class="col-sm-3">
                                <label for="ward">Xã/ Phường</label>
                                <select class="select" name="ward" id="ward" style="width: 100%">
                                    <option value="">Xã/ Phường</option>


                                </select>
                            @error('ward') <span class="text-danger">{{$message}}</span> @enderror

                            </div>
                            <div class="col-sm-3">
                                <label for="street">Số nhà, tên đường...</label>
                                <input type="text" name="street" id="street" class="form-control" placeholder="Số nhà, tên đường..." value="{{old('street')}}">
                            @error('street') <span class="text-danger">{{$message}}</span> @enderror

                            </div>

                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="birth-day" class="col-sm-2 col-form-label">Ngày sinh</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="birth-day" name="birth_day" placeholder="Ngày sinh"
                            value="{{old('birth_day')}}">
                            @error('birth_day') <span class="text-danger">{{$message}}</span> @enderror

                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-sm-2 col-form-label">Mật khẩu</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu"
                            >
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
                        <div class="form-group row">
                            <label for="phone" class="col-sm-4 col-form-label">Số điện thoại</label>
                            <div class="col">
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="Số điện thoại"
                                    value="{{old('phone')}}">
                                    @error('phone') <span class="text-danger">{{$message}}</span> @enderror

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="slug" class="col-sm-4 col-form-label">Trạng thái</label>
                            <div class="col">
                                <label class="switch">
                                    <input type="checkbox" name="status" checked >
                                    <span class="slider round"></span>
                                  </label>
                            </div>
                        </div>
                        <label for="lfm" class="col-sm-4 col-form-label">Ảnh đại diện</label>

                        <div class="form-group row">
                            <div class="col">
                                <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn image-header-wrapper">
                                    <img id="holder" class="header-image" id="favicon" src="{{old('avatar')}}" alt="" sizes="" srcset="">
                                </a>
                                @error('avatar') <span class="text-danger">{{$message}}</span> @enderror

                                <input id="thumbnail" type="hidden" name="avatar" class="form-control"  value="{{old('avatar')}}">
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-6">
                                <button type="submit" class="form-control btn btn-success">Save</button>
                            </div>
                            <div class="col-6">
                                <a href="{{route('user-info.index')}}" role="button" class="form-control btn btn-danger">Exit</a>
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
<script src="{{asset('vendor/laravel-filemanager/js/stand-alone-button.js')}}"></script>
<script src="{{asset('Pugins/select2/js/select2.min.js')}}"></script>
<script>
    var route_prefix = "/admin/laravel-filemanager";
    $('#lfm').filemanager('image',{prefix: route_prefix});

    $(document).ready(function() {
    $('.select').select2();
});

$('#province').change(function (e) {
    e.preventDefault();
    var id =$('#province').select2('data')[0].id;
    $.ajax({
        type: "get",
        url: "{{asset('/district')}}/"+id,
        dataType: "json",
        success: function (response) {
            $('#district').html('');
            $.each(response, function (index, value) {
                $('#district').append(`<option value="${value.id}">${value._prefix} ${value._name}</option>`);
            });
            $('#district').children(":first").trigger('click');
            console.log($('#district').first());
        }
    });
});

$('#district').change(function (e) {
    e.preventDefault();
    var id =$('#district').select2('data')[0].id;
    $.ajax({
        type: "get",
        url: "{{asset('/ward')}}/"+id,
        dataType: "json",
        success: function (response) {
            $('#ward').html('');
            $.each(response, function (index, value) {
                $('#ward').append(`<option value="${value.id}">${value._prefix} ${value._name}</option>`);
            });

        }
    });
});
</script>

@endsection
