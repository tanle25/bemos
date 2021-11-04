@extends('dashboard')
@section('title')
    Thêm mới trang
@endsection
@section('content')
<form action="{{ route('page.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
      <div class="row">

          <!-- left column -->
          <div class="col-md-9">
          <!-- general form elements -->

          <div class="card card-info">

              <div class="card-header">
                  <h3 class="card-title">Sửa Trang</h3>
              </div>

                  <div class="card-body">
                      <div class="form-group row">
                        <label for="pagename" class="col-sm-2 col-form-label">Tên trang (<span class="text-danger">*</span>)</label>
                        <div class="col-sm-10">
                          <input type="text" id="pagename" name="title" class="form-control" placeholder="Tên Trang" value="{{old('title')}}">
                            @error('title')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                      </div>
                      <div class="form-group row">
                        <label for="slug" class="col-sm-2 col-form-label">Đường dẫn (<span class="text-danger">*</span>)</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="slug" name="slug" placeholder="Đường dẫn" value="{{old('slug')}}" >
                            @error('slug')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="home-title" class="col-sm-2 col-form-label">Nội dung (<span class="text-danger">*</span>)</label>
                        <div class="col-sm-10">
                            <textarea name="content" id="description" class="form-control summernote">{!!old('content')!!}</textarea>
                            @error('content')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                      </div>

                  </div>
                    <!-- /.card-body -->
          </div>
          </div>
          <div class="col-md-3">
              <div class="card card-primary">
                      <div class="card-header">
                          <h3 class="card-title">Different Width</h3>
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
@parent
{{-- <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script> --}}

<script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
<script>
    var options = {
    filebrowserImageBrowseUrl: '/admin/laravel-filemanager?type=Images',
    filebrowserImageUploadUrl: '/admin/laravel-filemanager/upload?type=Images&_token=',
    filebrowserBrowseUrl: '/admin/laravel-filemanager?type=Files',
    filebrowserUploadUrl: '/admin/laravel-filemanager/upload?type=Files&_token='
  };
CKEDITOR.replace( 'description',options );


$(document).on('change','#pagename',function(){
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
