@extends('dashboard')
@section('css')
    <link rel="stylesheet" href="{{asset('Plugins/select2/css/select2.min.css')}}">
@endsection
@section('title')
Thêm quản trị viên
@endsection
@section('content')
<form action="{{route('admin-permission.store')}}" method="POST" enctype="multipart/form-data">

    @csrf
    <div class="row">
    <!-- left column -->
        <div class="col-md-8">
            <!-- general form elements -->

            <div class="card card-info">

                <div class="card-header">
                    <h3 class="card-title">Thêm quản trị viên</h3>
                </div>

                <div class="card-body">

                    <div class="form-group row">
                        <label for="username" class="col-sm-2 col-form-label">Tên Quản trị viên</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="username" name="name" placeholder="Tên quản trị viên"
                                value="{{old('name')}}">
                                @error('name') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="email" name="email" placeholder="Email"
                                value="{{old('email')}}">
                                @error('email') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="phone" class="col-sm-2 col-form-label">Số điện thoại</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="Số điện thoại"
                                value="{{old('phone')}}">
                                @error('phone') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-sm-2 col-form-label">Mật khẩu</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="slug" class="col-sm-2 col-form-label">Trạng thái</label>
                        <div class="col">
                            <label class="switch">
                                <input type="checkbox" name="status" checked>
                                <span class="slider round"></span>
                              </label>
                        </div>
                    </div>
            </div>
            </div>
                <!-- /.card-body -->
        </div>

        <div class="col-md-4">

            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Hành động</h3>
                </div>
                <div class="card-body">
                    @foreach ($permissions as $permission )


                    <div class="form-check">
                        <input class="form-check-input" name="permissions[]" type="checkbox" value="{{$permission->id}}" id="permission-{{$permission->id}}"
                        >
                        <label class="form-check-label" for="permission-{{$permission->id}}">
                          {{$permission->name}}
                        </label>
                      </div>

                    @endforeach
                </div>
            </div>
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Hành động</h3>
                </div>
                <div class="card-body">

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
</form>
@endsection
@section('js')
<script src="{{asset('vendor/laravel-filemanager/js/stand-alone-button.js')}}"></script>
<script src="{{asset('Plugins/select2/js/select2.min.js')}}"></script>
<script>
    // var route_prefix = "shop";
    var route_prefix = "/admin/laravel-filemanager";
    $('#lfm').filemanager('image',{prefix: route_prefix});

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
