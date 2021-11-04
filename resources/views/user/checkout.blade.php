@extends('master')
@section('css')
    <link rel="stylesheet" href="{{ asset('Plugins/select2/css/select2.min.css') }}">
@endsection
@section('title')
    Thanh toán
@endsection

@section('content')
    <section class="container p-0 pb-3">
        <h3 class="mt-5 pb-3 border-bottom text-center">
            Tiến hành đặt hàng
        </h3>
        <form action="{{route('customer-order.store')}}" method="post">
            @csrf
            <div class="container p-0">
                <div class="pt-2 pb-2 text-white mb-3 bg-primary-color">

                    <h6 class="text-white pl-3 m-0">Địa chỉ thanh toán</h6>
                </div>
            </div>
            <div class="container p-0 d-flex justify-content-center">
                <div class="row text-mobile" style="width: 700px" >
                    <label for="" class="col-sm-3 text-right">Họ</label>
                    <div class="col-md-9 mb-3">
                        <input class="form-control" type="text" name="last_name" id=""
                            value="{{ Auth::user()->last_name }}">
                        @error('last_name')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <label for="" class="col-sm-3 text-right">Tên</label>
                    <div class="col-md-9 mb-3">
                        <input class="form-control" type="text" name="first_name" id=""
                            value="{{ Auth::user()->first_name }}">
                            @error('first_name')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <label for="" class="col-sm-3 text-right">Email</label>
                    <div class="col-md-9 mb-3">
                        <input class="form-control" type="email" name="email" id="" value="{{ Auth::user()->email }}">
                        @error('email')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <label for="" class="col-sm-3 text-right">Số điện thoại</label>
                    <div class="col-md-9 mb-3">
                        <input class="form-control" type="text" name="phone" id="" value="{{ Auth::user()->phone }}">
                        @error('phone')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <label for="" class="col-sm-3 text-right">Công ty</label>
                    <div class="col-md-9 mb-3">
                        <input class="form-control" type="text" name="company" id="" value="{{ Auth::user()->company }}">
                    </div>
                    <label for="" class="col-sm-3 text-right">Tỉnh</label>
                    <div class="col-md-9 mb-3">
                        <select name="province" id="province" style="width: 100%">
                            <option value=""></option>

                        </select>
                        @error('province')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <label for="" class="col-sm-3 text-right">Huyện</label>
                    <div class="col-md-9 mb-3">
                        <select name="district" id="district" style="width: 100%">
                            <option value=""></option>
                        </select>
                        @error('district')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <label for="" class="col-sm-3 text-right">Xã</label>
                    <div class="col-md-9 mb-3">
                        <select name="ward" id="ward" style="width: 100%">
                            <option value=""></option>
                        </select>
                        @error('ward')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <label for="" class="col-sm-3 text-right">Tên đường</label>
                    <div class="col-md-9 mb-3">
                        <input class="form-control" type="text" name="street" id="street">
                    </div>
                </div>

            </div>
            <div class="container p-0">
                <div class="pt-2 pb-2 text-white mb-3 bg-primary-color">

                    <h6 class="text-white  pl-3 m-0">Phương thức thanh toán</h6>
                </div>
            </div>
            <div class="container p-0">

                <div class="row">
                    <div class="col-md-6">
                        <label class="lb-payment" for="radio1">
                            <div class="row-payment-method payment-row">
                                <div class="select-icon">
                                    <input type="radio" id="radio1" name="payment" value="0">
                                </div>
                                <div class="select-txt">
                                    <p class="pymt-type-name">Thanh toán khi nhận hàng</p>
                                    {{-- <p class="pymt-type-desc">Safe payment online. Credit card needed. PayPal account is not necessary.</p> --}}
                                </div>
                                <div class="select-logo">
                                    <img class="w-100"
                                        src="{{ asset('images/logonew.png') }}"
                                        alt="PayPal" />
                                </div>
                            </div>
                        </label>
                    </div>
                    <div class="col-md-6">
                        <label class="lb-payment" for="radio2">
                            <div class="row-payment-method payment-row">
                                <div class="select-icon">
                                    <input type="radio" id="radio2" name="payment" value="1">
                                </div>
                                <div class="select-txt">
                                    <p class="pymt-type-name">Thanh toán qua VNPAY</p>
                                    {{-- <p class="pymt-type-desc">Safe payment online. Credit card needed. PayPal account is not necessary.</p> --}}
                                </div>
                                <div class="select-logo">
                                    <img class="w-100" src="{{ asset('img/credit/VNPAY-Logo-yGapP.png') }}" alt="Vnpay" />
                                </div>
                            </div>
                        </label>
                    </div>
                    @error('payment')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                </div>

            </div>
            <div class="container p-0">
                <div class="pt-2 pb-2 text-white mb-3 bg-primary-color">

                    <h6 class="text-white  pl-3 m-0">Xác nhận đơn hàng</h6>
                </div>
            </div>

            <div class="container p-0">
                <table width="100%" class="table table-bordered">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tên sản phẩm</th>
                        <th scope="col">Giá gốc</th>
                        <th scope="col">Giá khuyến mãi</th>
                        <th scope="col">Số lượng</th>
                        <th scope="col">Thành tiền</th>
                      </tr>
                    </thead>
                    <tbody>
                        @php
                            $index= 0;
                        @endphp
                        @foreach ( Cart::content() as $key => $item )
                        <tr>
                            <th scope="row">{{ ++$index}}</th>
                            <td>{{$item->name}}</td>
                            <td>{{number_format($item->price)}}&#x20AB;</td>
                            <td>{{number_format($item->options->promotion)}}&#x20AB;</td>
                            <td>{{$item->qty}}</td>
                            <td>{{$item->options->promotion == null ? number_format($item->price * $item->qty) : number_format($item->options->promotion * $item->qty)}}&#x20AB;</td>
                          </tr>
                        @endforeach

                      {{-- <tr>
                        <th scope="row"></th>
                        <td colspan="4"> <strong>Tổng tiền hàng</strong> </td>
                        <td> <strong>{{Cart::priceTotal(0,',',',','.')}}</strong> </td>
                      </tr> --}}
                    </tbody>
                  </table>
                  <div class="row mb-3">
                      <div class="col-md-7 col-6"></div>
                      <div class="col-md-5 col-6 d-flex justify-content-end">
                          <div class="d-flex flex-column">
                            <span class="m-1">Tổng tiền hàng:</span>
                            <span class="m-1">VAT:</span>
                            <span class="m-1">Phí vận chuyển:</span>
                            <span class="m-1">Thành tiền:</span>

                          </div>
                          <div class="d-flex flex-column">
                            <input type="hidden" id="total-price" value="{{Cart::subtotal(0,',','.')}}">
                            <input type="hidden" name="shipping" id="txt-shipping" value="">
                            <strong class="m-1 text-success">{{Cart::subtotal(0,',','.')}}&#x20AB;</strong>
                            <strong class="text-success m-1">0&#x20AB;</strong>
                            <strong id="shipping" class="m-1 text-success">0&#x20AB;</strong>
                            <strong id="price-total" class="m-1 text-success">{{Cart::subtotal(0,',','.')}}&#x20AB;</strong>

                          </div>
                      </div>
                  </div>
            </div>
            <div class="d-flex justify-content-end">
                <button class="btn-login text-uppercase" type="submit">Đặt hàng ngay</button>
            </div>
        </form>

    </section>
@endsection
@section('js')
    <script src="{{ asset('Plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('vendor/laravel-filemanager/js/jquery.autocomplete.js') }}"></script>
    <script>
        $(document).ready(function () {
            // $.ajax({
            //     type: "get",
            //     headers: {
            //     'Content-Type': 'application/x-www-form-urlencoded'
            // },
            //     url: "https://partner.viettelpost.vn/v2/categories/listProvinceById?provinceId=-1",
            //     // data: "data",
            //     dataType: "json",
            //     success: function (response) {
            //         $('#province').html('');
            //         $.each(response.data, function (indexInArray, valueOfElement) {
            //             $('#province').append(`<option value="${valueOfElement.PROVINCE_ID}">${valueOfElement.PROVINCE_NAME}</option>`);
            //         });
            //     }
            // });
            $.ajax({
                type: "get",
                url: "{{url('list-province')}}",
                // data: "data",
                dataType: "json",
                success: function (response) {
                    // console.log(response);
                    $('#province').html('');
                    $.each(response, function (indexInArray, valueOfElement) {
                        console.log(valueOfElement);
                        $('#province').append(`<option value="${valueOfElement.PROVINCE_ID}">${valueOfElement.PROVINCE_NAME}</option>`);
                    });
                }
            });
        });
        $(document).ready(function() {
            $('#province').select2({
                placeholder: "Chọn Tỉnh"
            });
            $('#district').select2({
                placeholder: "Chọn huyện"
            });
            $('#ward').select2({
                placeholder: "Chọn xã"
            });
        });

        $('#province').on('change',(e)=>{
            var id = $('#province').select2('data')[0].id
            $('#district').html('')
            $.ajax({
                type: "get",
                url: "{{url('list-distict')}}/"+ id,
                success: function (response) {
                    $.each(response, function (indexInArray, valueOfElement) {
                        $('#district').append(`<option value="${valueOfElement.DISTRICT_ID}">${valueOfElement.DISTRICT_NAME}</option>`);
                    });
                    $('#district').change();
                }

            });
        })
    $('#district').on('change',(e)=>{
        var id = $('#district').select2('data')[0].id
        $('#ward').html('')
        $.ajax({
            type: "get",
            url: "{{url('list-ward')}}/"+ id,
            success: function (response) {
                $.each(response, function (indexInArray, valueOfElement) {
                    $('#ward').append(`<option value="${valueOfElement.WARDS_ID}">${valueOfElement.WARDS_NAME}</option>`);
                });
            }
        });
    })
    $('#ward').on('change', function () {
        $.ajax({
            type: "get",
                url: "{{route('shippngFee')}}",
                data:{
                    "RECEIVER_PROVINCE":$('#province').select2('data')[0].id,
                    "RECEIVER_DISTRICT":$('#district').select2('data')[0].id,
                    "PRODUCT_PRICE":$('#total-price').val(),
                    "MONEY_COLLECTION":$('#total-price').val()
                },
                dataType: "json",
            success: function (response) {
                console.log(response);
                var currentPrice = "{{Cart::priceTotal(0,',',',','.')}}";
                var totalPrice = Number(currentPrice.replace(/,/g , ""))+response[0].GIA_CUOC;
                $('#shipping').html(new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'VND' }).format(response[0].GIA_CUOC));
                $('#txt-shipping').val(response[0].GIA_CUOC);
                $('#price-total').html(new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'VND' }).format(totalPrice));
            }
        });
    });
    </script>
@endsection
