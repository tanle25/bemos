@extends('master')
@section('css')
    <link rel="stylesheet" href="{{asset('Plugins/select2/css/select2.min.css')}}">
    <style>
        .ui-autocomplete{
            max-height: 250px;
            overflow: scroll;
        }
        .ui-autocomplete li{
            font-size: 17.5px;
            cursor: pointer;
        }
    </style>
@endsection
@section('title')
    Giỏ hàng
@endsection
@section('content')
@if (Agent::isDesktop())
<section class="container p-0">
    <h3 class="text-center mt-5 mb-5">Giỏ hàng</h3>
    <form action="{{route('cart.update',1)}}" method="post">
        @csrf
        @method('put')
        <table width="100%" class="table table-bordered">
            <thead>
            <tr>
                <th scope="col">Xoá</th>
                <th scope="col">Sku</th>
                <th scope="col">Hình ảnh</th>
                <th scope="col">Tên sản phẩm</th>
                <th scope="col">Đơn giá</th>
                <th scope="col">Giá khuyến mãi</th>
                <th scope="col">Số lượng</th>
                <th scope="col">Thành tiền</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($items as $item )
                    <tr>
                        <th scope="row"><input type="checkbox" value="{{$item->rowId}}" name="delete[]" id=""></th>
                        <td>{{$item->options->sku}}</td>
                        <td> <img style="max-height: 200px" src="{{asset($item->options->avatar)}}" alt=""> </td>
                        <td> <a href="{{route('detail.show',$item->options->slug)}}"> {{$item->name}}</a></td>
                        <td>{{number_format($item->options->price)}}&#x20AB;</td>
                        <td>{{number_format($item->options->promotion)}}&#x20AB;</td>
                        <td> <input class="form-control" style="width: 50px" type="number" name="quantily[{{$item->rowId}}]" value="{{$item->qty}}" min="1" id=""> </td>
                        <td>{{number_format($item->price * $item->qty)}}&#x20AB;</td>

                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="row">
            <div class="col-md 7"></div>
            <div class="col-md-5">
                <div class="row">
                    <div class="col-6 pl-0">
                        <button class="btn btn-login text-white p-0 pl-2 pr-2">Cập nhật giỏ hàng</button>
                    </div>
                    <div class="col-6 pr-0">
                        <a href="{{route('home')}}" role="button" class="btn btn-login-secondary text-white p-0">Tiếp tục mua hàng</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
        <div class="p-5">
            @error('quantily')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
    <form action="{{route('customer-order.index')}}" method="get">
        @csrf
        <div class="row border-top">
                {{-- <div class="col-md-4 pt-4">
                    <label class="h5 font-weight-normal" for="voucher">Mã giảm giá</label>
                    <div class="position-relative mb-5">
                        <input type="text" class="form-control" placeholder="Nhập ở đây..." name="voucher" id="voucher">
                        <button class="btn-login-secondary position-absolute btn-absolute-top p-0">Đồng ý</button>
                    </div>
                        <label class="h5 font-weight-normal" for="gift_card">Thẻ quà tặng</label>
                    <div class="position-relative">
                        <input type="text" class="form-control" placeholder="Nhập ở đây..." name="gift_card" id="gift_card">
                        <button class="btn-login-secondary position-absolute btn-absolute-top p-0">Đồng ý</button>
                    </div>
                </div> --}}
                <div class="col-md-6 pt-4">
                    <span class="h5 font-weight-normal">Lựa chọn giao hàng</span>
                    <h6 class="mt-3"> <small>Nhập điểm đến của bạn để ước tính phí giao hàng</small> </h6>
                    <div class="row">
                        <label for="province" class="col-md-4">Tỉnh</label>
                        <div class="col-md-8 mb-3">
                            <select  id="province" name="province" style="width: 100%;">
                                <option value=""></option>
                                {{-- @foreach ($provinces as $province )
                                <option value="{{$province->id}}">{{$province->_name}}</option>

                                @endforeach --}}

                            </select>
                        </div>
                        <label for="district" class="col-md-4">Huyện</label>
                        <div class="col-md-8 mb-3">
                            <select class="select2" name="district" id="district" style="width: 100%;">
                                <option></option>
                            </select>
                        </div>
                        <label for="ward" class="col-md-4">Xã</label>
                        <div class="col-md-8 mb-3">
                            <select class="select2" name="ward" id="ward" style="width: 100%;">
                                <option></option>
                            </select>
                        </div>
                        <label for="street" class="col-md-4">Đường, thôn...</label>
                        <div class="col-md-8">
                        <input class="form-control" id="street" name="street" type="text" placeholder="Xã">
                        </div>
                        <div class="col-12 d-flex justify-content-end mt-3">
                            <button id="shippingFee-btn" class="btn-login-secondary">Tính phí</button>
                            <input type="hidden" id="total-price" value="{{Cart::subtotal(0,',','.')}}">
                        </div>
                    </div>
                </div>
                <div class="col-md-6 bg-gray pt-5">
                        <div class="row mb-4">
                            <div class="col text-left">Thành tiền</div>
                            <div class="col text-right">{{Cart::subtotal(0,',','.')}}&#x20AB;</div>
                        </div>
                        <div class="row mb-4">
                            <div class="col text-left">Phí vận chuyển</div>
                            <div id="transaction-fee" class="col text-right">0&#x20AB;</div>
                        </div>
                        <div class="row mb-4">
                            <div class="col text-left">Thuê (VAT)</div>
                            <div class="col text-right">0&#x20AB;</div>
                        </div>
                        <div class="row pb-3 border-bottom">
                            <div class="col text-left">Thành tiền</div>
                            <div id="total-cart-price" class="col text-right">{{Cart::subtotal(0,',','.')}} &#x20AB;</div>
                        </div>
                        <div class="col-12 custom-control custom-checkbox mt-3">
                            <input type="checkbox" class="custom-control-input" name="check" id="customCheck1">
                            <label class="custom-control-label" for="customCheck1">Tôi đã đọc, hiểu và đồng ý với điều khoản dịch vụ. (Xem)</label>
                            @error('check')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-12 d-flex justify-content-end mt-3">
                            <button type="submit" class="btn-login">Tiến hành đặt hàng</button>
                        </div>
                </div>
        </div>
    </form>
</section>
@else
<div class="container p-0">
	<div class="row">
		<div class="col-12 p-0">
			<div class="panel panel-info">
				<div class="panel-heading">
					<div class="panel-title">
                        <h5 class="p-3 text-center border-bottom">Giỏ hàng của bạn</h5>
					</div>
				</div>
                <form action="{{route('cart.update',1)}}" method="post">
                    @csrf
                    @method('put')
				<div class="panel-body">
                    @foreach ($items as $item )
                        <div class="row">
                            <div class="col-xs-2"><img class="img-responsive" src="{{asset($item->options->avatar)}}">
                            </div>
                            <div class="col-xs-4">
                                <h6 class="product-name"><small>{{Str::limit($item->name,10,'...')}}</small></h6>
                                    @if ($item->options->promotion !=null)
                                        <h6><small>Giá gốc: {{number_format($item->options->price)}}&#x20AB;</small></h6>

                                        <h6><small>Giá khuyến mãi: {{number_format($item->options->promotion)}}&#x20AB;</small></h6>
                                    @else
                                    <h6><small>Giá: {{number_format($item->options->price)}}&#x20AB;</small></h6>
                                    @endif
                            </div>
                            <div class="col-xs-6" style="height: 50px">
                                <div class="col-xs-6 text-right d-flex flex-column h-100 - justify-content-center">
                                    <h6><small>{{number_format($item->options->price)}}&#x20AB;<span class="text-muted">x</span></small></h6>
                                </div>
                                <div class="col-xs-4 d-flex flex-column h-100 - justify-content-center">
                                    <input type="text" class="form-control input-sm" type="number" name="quantily[{{$item->rowId}}]"  value="{{$item->qty}}" min="1">
                                </div>
                                <div class="col-xs-2 d-flex flex-column h-100 - justify-content-center">
                                    <a href="{{asset('/remove/'.$item->rowId)}}" class="btn btn-link btn-xs p-0">
                                        <i class="far fa-trash font-px-18 text-danger"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
					<hr>
				<div class="panel-footer">
                    <div class="col-12 custom-control custom-checkbox mt-3">
                        <input type="checkbox" class="custom-control-input" name="check" id="customCheck1">
                        <label class="custom-control-label" for="customCheck1">Tôi đã đọc, hiểu và đồng ý với điều khoản dịch vụ. (Xem)</label>
                        @error('check')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
					<div class="row text-center">
                        <div class="col-xs-6">

						</div>
                        <div class="col-xs-6">
                            <span id="cart-total-price">Tổng tiền: {{Cart::priceTotal(0,',',',','.')}}&#x20AB;</span>
						</div>
						<div class="col-xs-6">
							<button type="submit" class="btn btn-login-secondary btn-mobile text-white">
								Cập nhật giỏ hàng
							</button>
						</div>
						<div class="col-xs-6">
							<a href="{{route('customer-order.index',['check'=>true])}}" class="btn btn-login btn-mobile text-white">
								Thanh toán
                            </a>
						</div>
					</div>
				</div>
            </form>
			</div>
		</div>
	</div>
</div>
@endif

@endsection
@section('js')
<script src="{{asset('Plugins/select2/js/select2.min.js')}}"></script>
<script src="{{asset('vendor/laravel-filemanager/js/jquery.autocomplete.js')}}"></script>
<script>
$(document).ready(function () {
    // $.ajax({
    //     type: "get",
    //     headers: {
    //     'Content-Type': 'application/x-www-form-urlencoded'
    //         },
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
                // console.log(valueOfElement);
                $('#province').append(`<option value="${valueOfElement.PROVINCE_ID}">${valueOfElement.PROVINCE_NAME}</option>`);
            });
            $('#province').change();
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
    // $('#street').autocomplete({
    //     minLength: 0,
    //     source:(request, response)=>{
    //         $.ajax({
    //             type: "get",
    //             url: "street",
    //             contentType: "application/json; charset=utf-8",
    //             data: {
    //                 'district_id':$('#district').select2('data')[0].id,
    //                 'provice_id':$('#province').select2('data')[0].id,
    //                 'keyword':$('#street').val()
    //             },
    //             dataType: "json",
    //             success: function (data) {
    //                 response($.map(data,
    //                     function(data) {
    //                         $('.ui-autocomplete').addClass('list-group');
    //                         return {
    //                             label: data._name,
    //                             value: data.id
    //                         }
    //                     }));
    //                     $('li.ui-menu-item').addClass('list-group-item');

    //             }
    //         });
    //     }
    // })
        $('#shippingFee-btn').click(function (e) {
            e.preventDefault();
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
                    // console.log(response);
                     var currentPrice = "{{Cart::priceTotal(0,',',',','.')}}";
                     var totalPrice = Number(currentPrice.replace(/,/g , ""))+response[0].GIA_CUOC;
                    $('#transaction-fee').html(new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'VND' }).format(response[0].GIA_CUOC));
                    $('#total-cart-price').html(new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'VND' }).format(totalPrice));
                }
            });
        });
</script>
@endsection
