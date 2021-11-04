@extends('dashboard')
@section('title')
    Thông tin chung
@endsection
@section('content')
<form action="{{ route('setting.store') }}" method="POST" enctype="multipart/form-data">
  @csrf
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
                      <label for="header-info" class="col-sm-2 col-form-label">Tiêu đề header website</label>
                      <div class="col-sm-10">
                        <input type="text" id="header-info" name="title" class="form-control" placeholder="Tiêu đề header website" value="{{$web_info->site_name ?? ''}}">
                      </div>
                    </div>
                    <div class="form-group row">
                        <label for="header-info" class="col-sm-2 col-form-label">Mô tả</label>
                        <div class="col-sm-10">
                            <textarea name="desciption" class="form-control">{{$web_info->desciption ?? ''}}</textarea>
                        </div>
                      </div>
                    <div class="form-group row">
                        <label for="header-info" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-10">
                            <div class="row">
                                <div class="col-md-3">
                                    <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn image-header-wrapper">
                                        <img class="header-image h-auto" id="holder" id="favicon" src="{{asset($web_info->logo)?? asset('images/placeholder-image.png')}}" alt="" sizes="" srcset="">
                                    </a>
                                    <input id="thumbnail" type="hidden" name="logo" class="form-control"  value="{{asset($web_info->logo)?? ''}}">
                                    <span class="product-avatar">Logo</span>
                                </div>
                                <div class="col-md-3">
                                    <a id="lfm1" data-input="thumbnail1" data-preview="holder1" class="btn image-header-wrapper">
                                        <img class="header-image h-auto" id="holder1" id="favicon" src="{{asset($web_info->footer_logo ) ?? asset('images/placeholder-image.png')}}" alt="" sizes="" srcset="">
                                    </a>
                                    <input id="thumbnail1" type="hidden" name="logo_footer" class="form-control"  value="{{asset($web_info->footer_logo) ?? ''}}">
                                    <span class="product-avatar">Logo Footer</span>
                                </div>
                                <div class="col-md-3">
                                    <a id="lfm2" data-input="thumbnail2" data-preview="holder2" class="btn image-header-wrapper">
                                        <img class="header-image h-auto" id="holder2" id="favicon" src="{{asset($web_info->favicon) ?? asset('images/placeholder-image.png')}}" alt="" sizes="" srcset="">
                                    </a>
                                    <input id="thumbnail2" type="hidden" name="favicon" class="form-control"  value="{{asset($web_info->favicon) ?? ''}}">
                                    <span class="product-avatar">Favicon</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="header-info" class="col-sm-2 col-form-label">Địa chỉ showroom</label>
                        <div class="col-sm-10">
                          <input type="text" id="header-info" name="address" class="form-control" placeholder="Địa chỉ" value="{{$web_info->address ?? ''}}">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="header-info" class="col-sm-2 col-form-label">Địa chỉ nhà máy</label>
                        <div class="col-sm-10">
                          <input type="text" id="header-info" name="factory_address" class="form-control" placeholder="Địa chỉ" value="{{$web_info->factory_address ?? ''}}">
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
                        <div class="form-group row">
                            <label for="hotline" class="col-sm-4 col-form-label">Hotline</label>
                            <div class="col-sm-8">
                              <input type="text" id="hotline" name="hotline" class="form-control" value="{{$web_info->hotline ?? ''}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone" class="col-sm-4 col-form-label">Điện thoại</label>
                            <div class="col-sm-8">
                              <input type="text" id="phone" name="phone" class="form-control" value="{{$web_info->phone ?? ''}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="maketting" class="col-sm-4 col-form-label">Phòng kinh doanh</label>
                            <div class="col-sm-8">
                              <input type="text" id="maketting" name="maketting" class="form-control" value="{{$web_info->maketing_phone ?? ''}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-sm-4 col-form-label">Email</label>
                            <div class="col-sm-8">
                              <input type="text" id="email" name="email" class="form-control" value="{{$web_info->email ?? ''}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="facebook" class="col-sm-4 col-form-label">Facebook</label>
                            <div class="col-sm-8">
                              <input type="text" id="facebook" name="facebook" class="form-control" value="{{$web_info->facebook ?? ''}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="google" class="col-sm-4 col-form-label">Google</label>
                            <div class="col-sm-8">
                              <input type="text" id="google" name="google" class="form-control" value="{{$web_info->google ?? ''}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="zalo" class="col-sm-4 col-form-label">Zalo</label>
                            <div class="col-sm-8">
                              <input type="text" id="zalo" name="zalo" class="form-control" value="{{$web_info->zalo ?? ''}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="skype" class="col-sm-4 col-form-label">Skype</label>
                            <div class="col-sm-8">
                              <input type="text" id="skype" name="skype" class="form-control" value="{{$web_info->skype ?? ''}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="youtube" class="col-sm-4 col-form-label">Youtube</label>
                            <div class="col-sm-8">
                              <input type="text" id="youtube" name="youtube" class="form-control" value="{{$web_info->youtube ?? ''}}">
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
@parent
{{-- <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script> --}}

<script src="{{asset('vendor/laravel-filemanager/js/alone-button.js')}}"></script>

<script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>

<script>
    var route_prefix = "/admin/laravel-filemanager";
    $('#lfm').singleImage('image',{prefix: route_prefix});
    $('#lfm1').singleImage('image',{prefix: route_prefix});
    $('#lfm2').singleImage('image',{prefix: route_prefix});

</script>
@endsection
