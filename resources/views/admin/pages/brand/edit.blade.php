@extends('dashboard')
@section('css')
    <link rel="stylesheet" href="{{asset('plugins/select2/css/select2.min.css')}}">
@endsection
@section('title')
Thay đổi thương hiệu đồng hành
@endsection
@section('content')
<form action="{{route('brand.update',$brand->id)}}" method="POST" enctype="multipart/form-data">

    @csrf
    @method('put')
    <div class="row">
    <!-- left column -->
    <div class="col-md-9">
        <!-- general form elements -->

        <div class="card card-info">

            <div class="card-header">
                <h3 class="card-title">Thông tin chi tiết</h3>
            </div>

            <div class="card-body">
                <div class="form-group row">
                    <label for="pagename" class="col-sm-2 col-form-label">Tiêu đề</label>
                    <div class="col-sm-10">
                        <input type="text" id="pagename" name="title" class="form-control" placeholder="Tiêu đề"
                            value="{{$brand->name ?? ''}}">
                    </div>

                </div>
                <div class="form-group row">
                    <label for="slug" class="col-sm-2 col-form-label">Ảnh</label>
                    <div class="col-sm-10">
                        <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn image-header-wrapper">
                            <img id="holder" class="header-image" id="favicon" src="{{$brand->url ?? asset('images/placeholder-image.png')}}" alt="" sizes="" srcset="">
                        </a>
                        <input id="thumbnail" type="hidden" name="image" class="form-control"  value="{{$brand->url ?? ''}}">
                    </div>
                </div>


                <div class="form-group row">
                    <label for="slug" class="col-sm-2 col-form-label">Trạng thái</label>
                    <div class="col-sm-10">
                        <select name="status" class="select" class="select" style="width: 100%">
                            <option value="1"> Sử dụng</option>
                            <option value="0"> Ngừng sử dụng</option>
                        </select>
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
<script src="{{asset('vendor/laravel-filemanager/js/stand-alone-button.js')}}"></script>
<script src="{{asset('plugins/select2/js/select2.min.js')}}"></script>
<script>
    // var route_prefix = "shop";
    // $('#lfm').filemanager('image');
    var route_prefix = "/admin/laravel-filemanager";
    $('#lfm').filemanager('image',{prefix: route_prefix});
    $(document).ready(function() {
    $('.select').select2();
});
</script>

@endsection
