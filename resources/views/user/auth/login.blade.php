@extends('master')
@section('title')
    Đăng nhập
@endsection
@section('content')
    <section class="container border-bottom">
        <h3 class="text-center login-title">Đăng nhập tài khoản !</h3>
        <div class="row pt-3 pb-5">
            <div class="col-md-6 text-center login-form-mobile login-form">

                <h4 class="pb-3  border-bottom">Chưa có tài khoản</h4>
                <div class="pt-4"></div>

                <p class="text-left">Đăng nhập để theo dõi đơn hàng, lưu danh sách sản phẩm yêu thích, nhận nhiều ưu đãi hấp dẫn.</p>

                <div class="d-flex justify-content-center">
                    <a class="btn btn-login text-white" role="button" href="{{route('user.register')}}">
                        Đăng ký
                    </a>
                </div>

            </div>
            <div class="col-md-6 login-form">
                <h4 class="pb-3  border-bottom text-center">Đã có tài khoản</h4>
                <div class="pt-4"></div>

                <form action="{{route('auth.login')}}" method="POST">
                    @csrf
                    <div class="row login-margin">
                        <label for="" class="col-md-3">Email</label>
                        <div class="col-md-9">
                            <input type="email" class="form-control"  name="email" id="" required>
                        </div>
                        <label for="" class="col-md-3">Mật khẩu</label>
                        <div class="col-md-9">
                            <input type="password" class="form-control"  name="password" id="" required>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group form-check float-right">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label mr-5" for="exampleCheck1">Ghi nhớ tôi</label>
                            <a href="{{route('forget.password.get')}}">Quên mật khẩu? </a>
                        </div>
                    </div>
                    <div class="col-md-12 d-flex justify-content-center">
                        <button class="btn btn-login text-white" type="submit" >
                            Đăng nhập
                        </button>
                    </div>
                    @error('loginfail')
                        <h6 class=" text-center text-danger">{{$message}}</h6>
                    @enderror
                </form>
            </div>
        </div>
    </section>
@endsection

