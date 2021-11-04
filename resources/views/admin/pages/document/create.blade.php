@extends('dashboard')
@section('css')
    <link rel="stylesheet" href="{{asset('plugins/select2/css/select2.min.css')}}">
@endsection
@section('title')
Thêm giấy tờ
@endsection
@section('content')
<form action="{{route('document.store')}}" method="POST" enctype="multipart/form-data">

    @csrf
    <div class="row">
    <!-- left column -->
    <div class="col-md-9">
        <!-- general form elements -->

        <div class="card card-info">

            <div class="card-header">
                <h3 class="card-title">Thêm giấy tờ</h3>
            </div>

            <div class="card-body">
                <div class="form-group row">
                    <label for="pagename" class="col-sm-2 col-form-label">Tên giấy tờ</label>
                    <div class="col-sm-10">
                        <input type="text" id="pagename" name="name" class="form-control" placeholder="Tên giấy tờ"
                            value="{{old('name')}}">
                            @error('name')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="slug" class="col-sm-2 col-form-label">Cơ sở kinh doanh</label>
                    <div class="col-sm-10">
                        <select name="shop" class="select" style="width: 100%">
                            <option></option>
                            @foreach ($shops as $shop )
                            <option value="{{$shop->id}}">{{$shop->shop_name}}</option>
                            @endforeach
                        </select>
                        @error('shop')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="slug" class="col-sm-2 col-form-label">Ảnh</label>
                    <div class="col-sm-4">
                        <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn image-header-wrapper">
                            <img id="holder" class="header-image" id="favicon" src="{{$document->image ?? asset('images/placeholder-image.png')}}" alt="" sizes="" srcset="">
                        </a>
                        @error('image')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        <input id="thumbnail" type="hidden" name="image" class="form-control"  value="{{$document->image ?? ''}}">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="slug" class="col-sm-2 col-form-label">Miêu tả</label>
                    <div class="col-sm-10">
                        <textarea name="content" class="form-control" rows="3">
                            {!!old('content')!!}
                        </textarea>
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
                                <a role="button" class="form-control btn btn-danger" href="{{route('document.index')}}">Exit</a>
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
<script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
<script>
    // var route_prefix = "shop";
    var options = {
    filebrowserImageBrowseUrl: '/admin/laravel-filemanager?type=Images',
    filebrowserImageUploadUrl: '/admin/laravel-filemanager/upload?type=Images&_token=',
    filebrowserBrowseUrl: '/admin/laravel-filemanager?type=Files',
    filebrowserUploadUrl: '/admin/laravel-filemanager/upload?type=Files&_token='
  };
CKEDITOR.replace( 'content',options );

var route_prefix = "/admin/laravel-filemanager";
    $('#lfm').filemanager('image',{prefix: route_prefix});

    $(document).ready(function() {
    $('.select').select2();
});
</script>

@endsection
