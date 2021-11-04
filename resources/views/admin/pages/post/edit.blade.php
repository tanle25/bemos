@extends('dashboard')
@section('css')
    <link rel="stylesheet" href="{{asset('Plugins/select2/css/select2.min.css')}}">

@endsection
@section('title')
Sửa Bài viết
@endsection
@section('content')
<form action="{{route('post.update',$post->id)}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('put')
    <div class="row">
    <!-- left column -->
    <div class="col-md-9">
        <!-- general form elements -->

        <div class="card card-info">

            <div class="card-header">
                <h3 class="card-title">Sửa Bài viết</h3>
            </div>

            <div class="card-body">
                <div class="form-group row">
                    <label for="post-title" class="col-sm-2 col-form-label">Tiêu đề bài viết</label>
                    <div class="col-sm-10">
                        <input type="text" id="post-title" name="title" class="form-control" placeholder="Tiêu đề bài viết"
                            value="{{$post->title ?? ''}}">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="slug" class="col-sm-2 col-form-label">Slug</label>
                    <div class="col-sm-10">
                        <input type="text" id="slug" name="slug" class="form-control" placeholder="Tên sản phẩm"
                            value="{{$post->slug ?? ''}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="short-desciption">Mô tả ngắn</label>
                    <div class="col-sm-10">
                        <textarea name="short_description" id="short-desciption" class="form-control">{!!$post->description ?? ''!!}</textarea>
                    </div>

                </div>

                <div class="form-group row">
                    <label for="slug" class="col-sm-2 col-form-label">Nội dung</label>
                    <div class="col-sm-10">
                        <textarea name="content" id="content" class="form-control" rows="3">
                            {!!$post->content ?? ''!!}
                        </textarea>
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
                        <div class="mb-10">
                            <a id="lfm1" data-input="thumbnail1" data-preview="holder1" class="btn image-header-wrapper">
                                <img class="header-image" id="holder1" id="favicon" src="{{$post->avatar ?? asset('images/placeholder-image.png')}}" alt="" sizes="" srcset="">
                            </a>
                            <input id="thumbnail1" type="hidden" name="avatar" class="form-control"  value="{{$post->avatar ?? ''}}">
                            <span class="product-avatar">Ảnh đại diện</span>
                        </div>


                        <div class="row mb-3 mt-3">
                            <div class="col">
                                <label for="">Trạng thái:</label>
                            </div>
                            <div class="col">
                                <label class="switch">
                                    <input type="checkbox" name="status"  @if($post->status == 1) checked @endif>
                                    <span class="slider round"></span>
                                  </label>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-6">
                                <button type="submit" class="form-control btn btn-success">Save</button>
                            </div>
                            <div class="col-6">
                                <a role="button" href="{{route('post.index')}}" class="form-control btn btn-danger">Exit</a>
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
{{-- <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script> --}}
    <script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
<script>
    var options = {
    filebrowserImageBrowseUrl: '/admin/laravel-filemanager?type=Images',
    filebrowserImageUploadUrl: '/admin/laravel-filemanager/upload?type=Images&_token=',
    filebrowserBrowseUrl: '/admin/laravel-filemanager?type=Files',
    filebrowserUploadUrl: '/admin/laravel-filemanager/upload?type=Files&_token=',
    height: '500px',
  };
CKEDITOR.replace( 'content',options );
var route_prefix = "/admin/laravel-filemanager";
    $('#lfm1').filemanager('image',{prefix: route_prefix});
    $(document).ready(function() {
    $('.select').select2();
});


$(document).on('change','#post-title',function(){
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
