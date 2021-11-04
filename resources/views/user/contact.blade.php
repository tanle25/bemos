@extends('master')
@section('css')
    <link rel="stylesheet" href="{{asset('Plugins/sweetalert2/sweetalert2.min.css')}}">
@endsection
@section('title')
    Liên Hệ
@endsection

@section('content')
    <section class="container p-0">
        <h3 class="text-center mt-5 mb-3">Liên hệ</h3>
        <h6 class="pt-5 pb-3 border-bottom border-top">Put your contact information here. You can edit this in the admin site.</h6>
        <div class="d-flex justify-content-center pt-3">
            <form action="{{route('user.contact')}}" method="post" style="width: 700px">
                @csrf
                <div class="form-group row">
                    <label for="" class="col-sm-3">Tên của bạn:</label>
                    <div class="col-md-9 mb-3">
                        <input class="form-control" type="text" placeholder="Tên của bạn" name="name" value="{{old('name')}}">
                        @error('name')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <label for="" class="col-sm-3">Email của bạn:</label>
                    <div class="col-md-9 mb-3">
                        <input class="form-control" type="text" placeholder="Email của bạn" name="email" value="{{old('email')}}">
                        @error('email')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <label for="" class="col-sm-3">Nội dung:</label>
                    <div class="col-md-9">
                        <textarea class="form-control" name="content" id="" cols="30" rows="10" placeholder="Quý khách vui lòng gửi ý kiến, thắc mắc tại đây để dịch vụ của chúng tôi phục vụ quý khách tốt hơn nữa."></textarea>
                       {{old('content')}}

                        @error('content')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-12 d-flex justify-content-center pt-5">
                        <button class="text-white btn-login" type="submit">Gửi yêu cầu</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
    {{-- @dd(Session::all()) --}}
@endsection
@section('js')
    <script src="{{asset('Plugins/sweetalert2/sweetalert2.all.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });

            @if (Session::has('success'))
            Toast.fire({
                icon: 'success',
                title: 'Cảm ơn bạn đã liên hệ với chúng tôi.'
            })
            @endif
        });
    </script>
@endsection
