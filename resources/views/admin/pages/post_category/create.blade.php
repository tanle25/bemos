@extends('dashboard')
@section('css')
    <link rel="stylesheet" href="{{asset('plugins/select2/css/select2.min.css')}}">
@endsection
@section('title')
Thêm danh mục
@endsection
@section('content')
<form action="{{route('post-category.store')}}" method="POST" enctype="multipart/form-data">

    @csrf
    <div class="row">
    <!-- left column -->
    <div class="col-md-9">
        <!-- general form elements -->

        <div class="card card-info">

            <div class="card-header">
                <h3 class="card-title">Thêm chuyên mục</h3>
            </div>

            <div class="card-body">
                <div class="form-group row">
                    <label for="category-name" class="col-sm-2 col-form-label">Tên chuyên mục</label>
                    <div class="col-sm-10">
                        <input type="text" id="category-name" name="title" class="form-control" placeholder="Tên danh mục"
                            value="{{old('title')}}">
                            @error('title') <span class="text-danger">{{$message}}</span> @enderror
                    </div>

                </div>
                <div class="form-group row">
                    <label for="slug" class="col-sm-2 col-form-label">Slug</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="slug" name="slug" placeholder="Đường dẫn"
                            value="{{old('slug')}}">
                            @error('slug') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="slug" class="col-sm-2 col-form-label">Danh mục cha</label>
                    <div class="col-sm-10">
                        <select name="parrent" class="select" style="width: 100%">
                            <option value="1"> </option>
                            @foreach ($categories as $parent )

                                <option value="{{$parent->id}}"> {{$parent->name}}</option>

                            @endforeach

                        </select>
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
    var route_prefix = "/admin/laravel-filemanager";
    $('#lfm').filemanager('image',{prefix: route_prefix});

    $(document).ready(function() {
    $('.select').select2();
});


$(document).on('change','#category-name',function(){
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
</script>

@endsection
