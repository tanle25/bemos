@extends('dashboard')
@section('css')
    <link rel="stylesheet" href="{{asset('Plugins/select2/css/select2.min.css')}}">
@endsection
@section('title')
Thêm banner
@endsection
@section('content')
<form action="{{route('banner.store')}}" method="POST" enctype="multipart/form-data">

    @csrf
    <div class="row">
    <!-- left column -->
    <div class="col-md-9">
        <!-- general form elements -->

        <div class="card card-info">

            <div class="card-header">
                <h3 class="card-title">Thêm banner</h3>
            </div>

            <div class="card-body">

                <div class="form-group row">
                    <label for="slug" class="col-sm-2 col-form-label">Ảnh</label>
                    <div class="col-sm-10">
                        <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn image-header-wrapper">
                            <img id="holder" class="header-image" id="favicon" src="{{$banner->image ?? asset('images/placeholder-image.png')}}" alt="" sizes="" srcset="">

                        </a>
                        @error('image')
                        <label class="text-center text-danger pt-10 pb-10">Vui lòng chọn hình ảnh</label>
                        @enderror

                        <input id="thumbnail" type="hidden" name="image" class="form-control"  value="{{$banner->image ?? ''}}">
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
                            <label for="slug" class="col-sm-4 col-form-label">Thứ tự</label>
                            <div class="col-sm-8">
                                <input class="form-control" min="1" name="position" value="1" type="number" placeholder="Thứ tự">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="slug" class="col-sm-4 col-form-label">Trạng thái</label>
                            <div class="col-sm-8">
                                <label class="switch">
                                    <input type="checkbox" name="status" checked>
                                    <span class="slider round"></span>
                                  </label>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-6">
                                <button type="submit" class="form-control btn btn-success">Save</button>
                            </div>
                            <div class="col-6">
                                <a role="button" href="{{route('banner.index')}}" class="form-control btn btn-danger">Exit</a>
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
<script src="{{asset('Plugins/select2/js/select2.min.js')}}"></script>
<script>
    var route_prefix = "/admin/laravel-filemanager";
    $('#lfm').filemanager('image',{prefix: route_prefix});

    $(document).ready(function() {
    $('.select').select2();
});
</script>

@endsection
