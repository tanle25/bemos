@extends('dashboard')
@section('title')
Thiết lập Header/ Footer
@endsection
@section('content')
<form action="{{route('headerfooter.update',1)}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('put')
    <div class="row">
        <div class="col-md-9">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Thông tin chi tiết</h3>
                </div>
                <div class="card-body">
                    {{-- body --}}
                    <div class="form-group row">
                        <label for="header-info" class="col-sm-2 col-form-label d-flex align-items-center">Hình ảnh trang web</label>
                        <div class="col-sm-10">
                            <div class="row">
                                <div class="col-4 text-center">
                                    <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn image-header-wrapper">
                                        <img id="holder" class="header-image" id="favicon" src="{{$page->favicon ?? asset('images/placeholder-image.png')}}" alt="" sizes="" srcset="">
                                    </a>
                                    <label for="favicon">Favicon</label>
                                    <input id="thumbnail" name="favicon" class="form-control"  value="{{$page->favicon ?? ''}}">
                                </div>
                                <div class="col-4 text-center">
                                    <a id="lfm1" data-input="thumbnail1" data-preview="holder1" class="btn image-header-wrapper">
                                        <img id="holder1" class="header-image" id="favicon" src="{{$page->logo ??  asset('images/placeholder-image.png')}}" alt="" sizes="" srcset="">
                                    </a>
                                    <label for="logo-header">Logo Header</label>
                                    <input id="thumbnail1" name="logo" class="form-control"  value="{{$page->logo ?? ''}}">
                                </div>
                                <div class="col-4 text-center">
                                    <a id="lfm2" data-input="thumbnail2" data-preview="holder2" class="btn image-header-wrapper">
                                        <img id="holder2" class="header-image" id="favicon" src="{{$page->logo_footer ??  asset('images/placeholder-image.png')}}" alt="" sizes="" srcset="">
                                    </a>
                                    <label for="logo-footer">Logo Footer</label>
                                    <input id="thumbnail2" name="logo_footer" class="form-control"  value="{{$page->logo_footer ?? '' }}">
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="form-group row">
                        <label for="header-info" class="col-sm-2 col-form-label">Link Logo</label>
                        <div class="col-sm-10">
                          <input type="text" id="header-info" name="link_logo" class="form-control" placeholder="Tiêu đề header website" value="{{$page->link_logo ?? route('home')}}">
                        </div>
                        <label for="header-info" class="col-sm-2 col-form-label">Link Logo Footer</label>
                        <div class="col-sm-10">
                          <input type="text" id="header-info" name="link_logo_footer" class="form-control" placeholder="Tiêu đề header website" value="{{$page->link_logo_footer ?? route('home')}}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Thông tin chi tiết</h3>
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
<script>
var route_prefix = "/admin/laravel-filemanager";
    $('#lfm').filemanager('image',{prefix: route_prefix});
    $('#lfm1').filemanager('image',{prefix: route_prefix});
    $('#lfm2').filemanager('image',{prefix: route_prefix});
</script>
@endsection
