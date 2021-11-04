@extends('dashboard')

@section('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css"/>
<link rel="stylesheet" href="{{ asset('Plugins/select2/css/select2.min.css') }}">
@endsection
@section('title')
    Danh sách đơn hàng
@endsection
@section('content')
<table id="datatables" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Mã đơn hàng</th>
            <th>Tên liên hệ</th>
            <th>Số điện thoại</th>
            <th>Email</th>
            <th>Địa chỉ</th>
            <th>Số tiền</th>
            <th>Phương thức thanh toán</th>
            <th>Trạng thái đơn hàng</th>
            <th style="min-width: 100px">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($orders->sortByDesc('created_at') as $order )
        @php
            $address = $order->street. ', '. $order->ward. ', '. $order->district. ', '. $order->province
        @endphp
            <tr>
                <td> {{$order->order_code}}</td>
                <td>{{$order->last_name. ' ' .$order->first_name}}</td>
                <td>{{$order->phone}}</td>
                <td>{{$order->email}}</td>
                <td>{{$address}}</td>
                <td>{{number_format($order->total_price)}}đ</td>
                @if ($order->status == 1)
                <td> <span class="badge badge-primary">COD</span></td>
                @elseif  ($order->status == 2)
                <td> <span class="badge badge-success">Internet banking</span></td>
                @endif

                @if ($order->transactionStatus == 0)
                <td> <span class="badge badge-primary">Chưa duyệt</span></td>
                @else
                <td> <span class="badge badge-success">{{config('viettelpost.'.$order->vt_status)}}</span></td>
                @endif
                <td class="text-center">
                    <a class="btn btn-warning btn-circle btn-sm" href="{{route('order.edit',$order->id)}}">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a class="btn btn-danger btn-circle btn-sm delete-button" data-toggle="modal" data-action="{{$order->id}}" href="#myModal">
                        <i class="fa fa-trash"></i>
                    </a>
                    @if ($order->transactionStatus == 0)
                    {{-- Create --}}
                    <a  class="create-vt-order btn btn-success btn-circle btn-sm" data-toggle="modal" data-action="{{$order->id}}" href="#createOrder">
                        <i class="fas fa-upload"></i>
                    </a>
                    @else
                    {{-- Update --}}
                        @if ($order->vt_status==107||$order->vt_status==201||$order->vt_status==504||$order->vt_status==503||$order->vt_status==501)
                        <a class="update-vt-order btn btn-success btn-circle btn-sm" data-toggle="modal" data-status="{{$order->vt_status}}" data-ordernumber="{{$order->order_number}}" href="#modalUpdateErr">
                            <i class="fas fa-pen"></i>
                        </a>
                        @else
                        <a class="update-vt-order btn btn-success btn-circle btn-sm" data-toggle="modal" data-status="{{$order->vt_status}}" data-ordernumber="{{$order->order_number}}" href="#modalUpdate">
                            <i class="fas fa-pen"></i>
                        </a>
                        @endif

                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        </div>
        <div class="modal-body text-center">
            Bạn chắc chắn muốn xoá?
        </div>
        <div class="modal-footer">
          <a class="btn btn-default" href="#" role="button" data-dismiss="modal">Huỷ</a>
          <a class="btn btn-danger" id="destroy" role="button">Xoá</a>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
<div class="modal fade" id="modalUpdateErr" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        </div>
        <div class="modal-body text-center">
            Đơn hàng không thể thay đổi trạng thái.
        </div>
        <div class="modal-footer">
          <a class="btn btn-default" href="#" role="button" data-dismiss="modal">Ok</a>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->

<div class="modal fade" id="modalUpdate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="{{route('vt.change.status')}}" method="post">
            @csrf
            <div class="modal-header">
                <h5>Gửi yêu cầu thay đổi trạng thái đơn hàng</h5>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
            </div>
            <div class="modal-body text-center">
                <select class="vt-status" name="status" style="width: 100%">
                    <option value="1">Duyệt đơn hàng</option>
                    <option value="2">Duyệt chuyển hoàn</option>
                    <option value="3">Phát tiếp</option>
                    <option value="4">Hủy đơn hàng</option>
                    <option value="5">Lấy lại đơn hàng (Gửi lại)</option>
                    <option value="11">Xóa đơn hàng đã hủy(delete canceled order)</option>
                </select>
                <h6 class="text-left mt-3"> <b>Ghi chú</b> </h6>
                <textarea name="note" class="form-control" ></textarea>
                <input type="hidden" name="order_number" id="order-number">
            </div>
            <div class="modal-footer">
            <a class="btn btn-default" href="#" role="button" data-dismiss="modal">Huỷ</a>
            <button class="btn btn-success" type="submit" id="destroy">Ok</button>
            </div>
        </form>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->

  <div class="modal fade bd-example-modal-lg" id="createOrder" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
          <form action="{{route('create.order')}}" method="post">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        </div>
        <div class="modal-body text-center">

            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="row mb-2">
                        <div class="col-sm-4">Tên khách hàng:</div>
                        <div class="col-md-8">
                            <input class="form-control" id="customer-name" type="text" name="name" value="aaa">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4">Số điện thoại:</div>
                        <div class="col-md-8">
                            <input class="form-control" id="customer-phone"  type="text" name="phone" value="aaa">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4">Email:</div>
                        <div class="col-md-8">
                            <input class="form-control" id="customer-email"  type="text" name="email" value="aaa">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4">Địa chỉ:</div>
                        <div class="col-md-8">
                            <input class="form-control" id="customer-address"  type="text" name="address" value="aaa" readonly>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4">Phương thức thanh toán</div>
                        <div class="col-md-8">
                            <input class="form-control" id="payment"  type="text" name="" value="a" readonly>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row mb-2">
                        <div class="col-sm-4">Mã đơn hàng:</div>
                        <div class="col-md-8">
                            <input class="form-control" id="order-code"  type="text" name="order_code" value="aaa" readonly>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4">Tiền hàng:</div>
                        <div class="col-md-8">
                            <input class="form-control" id="price"  type="text" name="price" value="aaa" readonly>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4">Tiền Thuế:</div>
                        <div class="col-md-8">
                            <input class="form-control" id="vat" type="text" name="vat" value="0" readonly>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4">Phí vận chuyển:</div>
                        <div class="col-md-8">
                            <input class="form-control" id="shipping" type="text" name="shipping" value="aaa" readonly>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4">Tổng tiền:</div>
                        <div class="col-md-8">
                            <input class="form-control" id="total-price" type="text" name="total-price" value="aaa" readonly>
                        </div>
                    </div>
                </div>
                <table id="datatables" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Tên sản phẩm</th>
                            <th>Sku</th>
                            <th>Giá</th>
                            <th>Giá khuyến mãi</th>
                            <th>Số lượng</th>
                            <th>Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody id="list-product">

                    </tbody>
                </table>
            </div>

        </div>
        <div class="modal-footer">
          <a class="btn btn-default" href="#" role="button" data-dismiss="modal">Huỷ</a>
          <button class="btn btn-success" type="submit">Tạo đơn</button>
        </div>
    </form>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
@endsection
@section('js')

<script src="{{asset('Plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.lazyload/1.9.1/jquery.lazyload.min.js"></script>
<script src="{{asset('Plugins/sweetalert2/sweetalert2.all.min.js')}}"></script>
<script src="{{ asset('Plugins/select2/js/select2.min.js') }}"></script>

<script>
    var id= null;

$(document).ready(function() {
        $('.vt-status').select2();
        $('.update-vt-order').click(function (e) {
            e.preventDefault();
            var orderNumber = $(this).data('ordernumber');
            // console.log(orderNumber);
            $('#order-number').val(orderNumber);
        });
    });

    $(document).ready(function() {
            $('#datatables').DataTable({
                "aaSorting": []
            });
        } );
    $('.delete-button').on('click',function(){
        id = $(this).data('action');

    });
    $('#destroy').on('click',function(){
        $.ajax({
            type: "delete",
            url: "order/"+id,
            data: {"id":id},
            dataType: "json"
        }).done(function(data){
            // console.log(data);
            Swal.fire({
                icon: 'success',
                title: 'Đã xoá!',
                timer: 1500
                }).then(()=>{
                    location.reload(true);
                })
        });
    });
    
        $('.create-vt-order').click(function (e) {
        e.preventDefault();
        var product_id = $(this).data('action');
        $.ajax({
            type: "get",
            url: "{{asset('admin/order')}}/"+product_id,
            data: {
                "product_id":product_id
            },
            dataType: "json",
            success: function (response) {
                $('#customer-name').val(response.last_name +response.first_name);
                $('#customer-phone').val(response.phone);
                $('#customer-email').val(response.email);
                $('#customer-address').val(response.street+' ' +response.ward +', '+response.district+', '+response.province);
                $('#payment').val(response.status == 1? 'COD':'Internet Banking');
                $('#order-code').val(response.order_code);
                $('#price').val(new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'VND' }).format(response.total_price ));
                // $('#vat')
                $('#shipping').val('0')
                $('#total-price').val(new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'VND' }).format(response.total_price ));
                var content =  JSON.parse(response.content);
 $('#list-product').html('');
                $.each(content, function (indexInArray, valueOfElement) {
                     $('#list-product').append(
                        `<tr >
                            <td>${valueOfElement.name}</td>
                            <td>${valueOfElement.options.sku}</td>
                            <td>${new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'VND' }).format(valueOfElement.price)}</td>
                            <td>${new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'VND' }).format(valueOfElement.options.promotion)}</td>
                            <td>${valueOfElement.qty}</td>
                            <td>${new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'VND' }).format(valueOfElement.subtotal)}</td>
                        </tr>`

                     );

                });
                // console.log(content);
                $.ajax({
                    type: "get",
                    url: "/shipping-fee",
                    data:{
                    "RECEIVER_PROVINCE":response.PROVINCE_ID,
                    "RECEIVER_DISTRICT":response.DISTRICT_ID,
                    "PRODUCT_PRICE":response.WARDS_ID,
                    "MONEY_COLLECTION":response.total_price,
                },
                dataType: "json",
                    success: function (data) {
                        // console.log(data);
                        $('#shipping').val(new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'VND' }).format(data[0].GIA_CUOC));
                        $('#total-price').val(new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'VND' }).format(response.total_price+data[0].GIA_CUOC));
                    }
                });
            }
        });
    });

</script>
@endsection
