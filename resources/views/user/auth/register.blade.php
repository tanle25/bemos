@extends('master')
@section('title')
    Đăng ký
@endsection
@section('content')
    <section class="container border-bottom">
        <h3 class="text-center login-title">Đăng ký!</h3>
        <h5 class="text-center register-form-title">Thông tin cá nhân của bạn</h5>
        <div class="register-form">
            <form action="{{route('user.auth.register')}}" method="POST">
                @csrf
                <div class="row login-margin">
                    <label for="" class="col-md-3 col-4">Giới tính</label>
                    <div class="col-md-9 col-8">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="inlineRadio1" value="male" @if(old('male')) checked @endif>
                            <label class="form-check-label" for="inlineRadio1">Nam</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="inlineRadio2" value="female"  @if(old('female')) checked @endif>
                            <label class="form-check-label" for="inlineRadio2">Nữ</label>
                          </div>
                          @error('gender')
                              <span class="text-danger">{{$message}}</span>
                          @enderror
                    </div>
                    <label for="" class="col-md-3">Họ</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control"  name="first_name" id="" required value="{{old('first_name')}}">
                        @error('first_name')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <label for="" class="col-md-3">Tên</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control"  name="last_name" id="" required value="{{old('last_name')}}">
                        @error('last_name')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <label for="" class="col-md-3">Sinh Ngày</label>
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col pl-0">
                                <select class="w-100" name="day" id="">
                                    <option value="">Ngày</option>
                                    @for ($i = 1; $i<=31; $i++)
                                    <option value="{{$i}}" @if(old('day')==$i) selected @endif>{{$i}}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col">
                                <select class="w-100" name="month" id="">
                                    <option value="">Tháng</option>
                                    <option value="1" @if(old('month')=='1') selected @endif>Tháng một</option>
                                    <option value="2" @if(old('month')=='2') selected @endif>Tháng hai</option>
                                    <option value="3" @if(old('month')=='3') selected @endif>Tháng ba</option>
                                    <option value="4" @if(old('month')=='4') selected @endif>Tháng bốn</option>
                                    <option value="5" @if(old('month')=='5') selected @endif>Tháng năm</option>
                                    <option value="6"@if(old('month')=='6') selected @endif>Tháng sáu</option>
                                    <option value="7"@if(old('month')=='7') selected @endif>Tháng bảy</option>
                                    <option value="8"@if(old('month')=='8') selected @endif>Tháng tám</option>
                                    <option value="9"@if(old('month')=='9') selected @endif>Tháng chín</option>
                                    <option value="10"@if(old('month')=='10') selected @endif>Tháng mười</option>
                                    <option value="11"@if(old('month')=='11') selected @endif>Tháng mười một</option>
                                    <option value="12"@if(old('month')=='11') selected @endif>Tháng mười hai</option>

                                </select>
                            </div>
                            <div class="col pr-0">
                                <select class="w-100" name="year" id="">

                                    <option value="">Năm</option>
                                    @for ($i = 1950; $i<=2020; $i++)
                                    <option value="{{$i}}" @if(old('year')==$i) selected @elseif($i== 1990) selected @endif>{{$i}}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        @if($errors->has('day') || $errors->has('month')|| $errors->has('year'))
                            <span class="text-danger">Ngày sinh không đúng</span>
                        @endif
                    </div>
                    <label for="" class="col-md-3">Email</label>
                    <div class="col-md-9">
                        <input type="email" class="form-control"  name="email" id="" required value="{{old('email')}}">
                        @error('email')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <label for="" class="col-md-3">Tên công ty</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control"  name="company" placeholder="option" id="" value="{{old('company')}}">
                    </div>
                    <label for="" class="col-md-3">Mật khẩu</label>
                    <div class="col-md-9">
                        <input type="password" class="form-control"  name="password" id="" required>
                    </div>
                    <label for="" class="col-md-3">Xác nhận mật khẩu</label>
                    <div class="col-md-9">
                        <input type="password" class="form-control"  name="password_confirmation" id="" required>
                        @error('password')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="text-center mb-4">
                    <button class="btn btn-login text-white" type="submit">
                        Đăng ký
                    </button>
                </div>

            </form>
        </div>
    </section>
@endsection
