@extends('dashboard')
@section('css')
    <link rel="stylesheet" href="{{asset('Plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('Plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css')}}">

@endsection
@section('title')
Sửa danh mục
@endsection
@section('content')
<form action="{{route('category.update',$category->id)}}" method="POST" enctype="multipart/form-data">

    @csrf
    @method('put')
    <div class="row">
    <!-- left column -->
    <div class="col-md-9">
        <!-- general form elements -->

        <div class="card card-info">

            <div class="card-header">
                <h3 class="card-title">Sửa danh mục</h3>
            </div>

            <div class="card-body">
                <div class="form-group row">
                    <label for="category-name" class="col-sm-2 col-form-label">Tên danh mục</label>
                    <div class="col-sm-10">
                        <input type="text" id="category-name" name="title" class="form-control" placeholder="Tên danh mục"
                            value="{{$category->name ?? ''}}">
                            @error('title') <span class="text-danger">{{$message}}</span> @enderror
                    </div>

                </div>
                <div class="form-group row">
                    <label for="slug" class="col-sm-2 col-form-label">Slug</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="slug" name="slug" placeholder="Đường dẫn"
                            value="{{$category->slug ?? ''}}">
                            @error('slug') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="slug" class="col-sm-2 col-form-label">Danh mục cha</label>
                    <div class="col-sm-10">
                        <select name="parrent" class="select" style="width: 100%">
                            <option value=""> Không có danh mục cha</option>
                            @foreach ($categories as $parent )
                                @if ($parent->id != $category->id)
                                <option value="{{$parent->id}}" @if ($parent->id==$category->parent) selected @endif> {{$parent->name}}</option>
                                @endif
                            @endforeach

                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="slug" class="col-sm-2 col-form-label">Ảnh banner</label>
                    <div class="col-sm-10">
                        <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn image-header-wrapper">
                            <img id="holder" class="header-image" id="favicon" src="{{asset($category->banner) ?? asset('images/placeholder-image.png')}}" alt="" sizes="" srcset="">
                        </a>
                        <input id="thumbnail" type="hidden" name="image" class="form-control"  value="{{$category->banner ?? ''}}">
                        @error('image') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="slug" class="col-sm-2 col-form-label">Ảnh slider</label>
                    <div class="col-sm-10">
                        <a id="lfm1" data-input="thumbnail1" data-preview="holder1" class="btn image-header-wrapper">
                            <img id="holder1" class="header-image" id="favicon" src="{{asset($category->image) ?? asset('images/placeholder-image.png')}}" alt="" sizes="" srcset="">
                        </a>
                        <input id="thumbnail1" type="hidden" name="slider" class="form-control"  value="{{$category->image ?? ''}}">
                        @error('slider') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="slug" class="col-sm-2 col-form-label">Mô tả</label>
                    <div class="col-sm-10">
                        <textarea name="desc" id="" cols="30" rows="10">{{$category->description}}</textarea>
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
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="slug" class="col-4 col-form-label">Trạng thái</label>
                                <div class="col-8">
                                    <label class="switch">
                                        <input type="checkbox" name="status" checked>
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-4 col-form-label">Màu chủ đạo</label>
                                <div class="col-5 position-relative">
                                    <div class="input-group mb-3">
                                        <input id="demo-input" name="color" type="text" value="{{$category->color ?? '#000'}}" class="form-control" >
                                        <div class="input-group-prepend">
                                          <label for="demo-input" id="color" style="background-color: {{$category->color ?? '#000'}}; width: 50px;"  class="input-group-text"></label>
                                        </div>
                                      </div>
                                </div>
                            </div>
                        <div class="row">

                            <div class="col-6">
                                <button type="submit" class="form-control btn btn-success">Save</button>
                            </div>
                            <div class="col-6">
                                <a role="button" href="{{route('category.index')}}" class="form-control btn btn-danger">Exit</a>
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
<script src="{{asset('Plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js')}}"></script>

<script>
    // var route_prefix = "shop";
    var route_prefix = "/admin/laravel-filemanager";
    $('#lfm').filemanager('image',{prefix: route_prefix});
    $('#lfm1').filemanager('image',{prefix: route_prefix});
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

$(function () {
      // Basic instantiation:
      $('#demo-input').colorpicker();

      // Example using an event, to change the color of the #demo div background:
      $('#demo-input').on('colorpickerChange', function(event) {
        $('#color').css('background-color', event.color.toString());
      });
    });
</script>

@endsection
