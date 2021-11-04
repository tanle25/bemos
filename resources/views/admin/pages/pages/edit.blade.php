@extends('dashboard')
@section('title')
    Sửa trang
@endsection

@section('content')
<form action="{{route('page.update',$page->id)}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('put')
    <div class="row">
        <div class="col-md-9">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Sửa Trang</h3>
                </div>

                <div class="card-body">
                    <div class="form-group row">
                        <label for="title" class="col-sm-2">Tiêu đề</label>
                        <div class="col-md-10 mb-3">
                            <input class="form-control" name="title" type="text" placeholder="Tieu de trang" value="{{$page->title}}">
                        </div>
                        <label for="slug" class="col-sm-2">Slug</label>
                        <div class="col-md-10 mb-3">
                            <input class="form-control" name="slug" type="text" placeholder="Tieu de trang" value="{{$page->slug}}">
                        </div>
                        <label for="content" class="col-sm-2">Nội dung</label>
                        <div class="col-md-10 introduce">
                            <textarea name="content" id="content" cols="30" rows="20" style="height: 500px">{!!$page->content!!}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Hành động</h3>
                </div>
                <div class="card-body">
                    <div class="row mb-3 mt-3">
                        <div class="col">
                            <label for="">Trạng thái:</label>
                        </div>
                        <div class="col">
                            <label class="switch">
                                <input type="checkbox" name="status" checked>
                                <span class="slider round"></span>
                              </label>
                        </div>
                    </div>
                    <div class="row mb-3 mt-3">
                        <div class="col">
                            <label for="">Vị trí:</label>
                        </div>
                        <div class="col">
                           <select name="position" id="">
                               <option value="1">Menu chính</option>
                               <option value="2">Khác</option>
                           </select>
                        </div>
                    </div>
                    <div class="row mb-3 mt-3">
                        <div class="col">
                            <label for="">Trang Cha:</label>
                        </div>
                        <div class="col">
                           <select name="parent" id="">
                               <option value="">Không có trang cha</option>
                               @foreach ($pages as $page )
                                <option value="{{$page->id}}">{{$page->title}}</option>
                               @endforeach

                           </select>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-6">
                            <button type="submit" class="form-control btn btn-success">Save</button>
                        </div>
                        <div class="col-6">
                            <a role="button" href="{{route('setting.index')}}" class="form-control btn btn-danger">Exit</a>
                        </div>
                    </div>
                </div>
        </div>
        </div>
    </div>
</form>
@endsection
@section('js')
<script src="//cdn.ckeditor.com/4.16.1/full/ckeditor.js"></script>
<script>
    var options = {
    filebrowserImageBrowseUrl: '/admin/laravel-filemanager?type=Images',
    filebrowserImageUploadUrl: '/admin/laravel-filemanager/upload?type=Images&_token=',
    filebrowserBrowseUrl: '/admin/laravel-filemanager?type=Files',
    filebrowserUploadUrl: '/admin/laravel-filemanager/upload?type=Files&_token='
  };
CKEDITOR.replace( 'content',options );

</script>
@endsection
