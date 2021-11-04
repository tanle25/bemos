@extends('dashboard')
@section('css')
    <link rel="stylesheet" href="{{ asset('Plugins/select2/css/select2.min.css') }}">
@endsection
@section('title')
    Sửa đơn hàng
@endsection
@section('content')
    <form action="{{ route('order.update', $order->id) }}" method="POST" enctype="multipart/form-data">
        @php
            $address = $order->street . ', ' . $order->ward . ', ' .  $order->district . ', ' . $order->province;
        @endphp
        @csrf
        @method('put')
        <div class="row">
            <!-- left column -->
            <div class="col-md-9">
                <!-- general form elements -->

                <div class="card card-info">

                    <div class="card-header">
                        <h3 class="card-title">Sửa Đơn hàng</h3>
                    </div>
@php
$street = $order->street ==null ? '':$order->street. ', ';
    $address = $street.  $order->ward. ', '. $order->district. ', '. $order->province
@endphp
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-4"> <h5>Tên khách hàng:</h5> </div>
                                    <div class="col-8"> <h5>{{$order->last_name. ' '. $order->first_name}}</h5> </div>
                                    <div class="col-4"> <h5>Số điện thoại:</h5> </div>
                                    <div class="col-8"> <h5>{{$order->phone ??''}}</h5> </div>
                                    <div class="col-4"> <h5> Email:</h5></div>
                                    <div class="col-8"> <h5>{{$order->email}}</h5> </div>
                                    <div class="col-4"> <h5> Địa chỉ:</h5></div>
                                    <div class="col-8"> <h5>{{$address}}</h5> </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-4"> <h5>Mã đơn hàng:</h5> </div>
                                    <div class="col-8"> <h5>{{$order->order_code}}</h5> </div>
                                    <div class="col-4"> <h5> Tiền hàng:</h5></div>
                                    <div class="col-8"> <h5>{{number_format($order->total_price)}}</h5> </div>
                                    <div class="col-4"> <h5> Tiền Thuế :</h5></div>
                                    <div class="col-8"> <h5>0</h5> </div>
                                    <div class="col-4"> <h5> Tổng tiền :</h5></div>
                                    <div class="col-8"> <h5>{{number_format($order->total_price)}}</h5> </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <div class="col-md-3">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Hành động</h3>
                    </div>
                    <div class="card-body">
                        {{-- <div class="row">
                            <div class="col-5">Gui len viettel post</div>
                            <div class="col-7"><a href="{{route('create.viettel.order',['order'=> $order->order_code])}}">Gui ngay</a></div>
                        </div> --}}
                        <div class="row">

                            <div class="col-6">
                                <button type="submit" class="form-control btn btn-success">Save</button>
                            </div>
                            <div class="col-6">
                                <a role="button" href="{{ route('order.index') }}"
                                    class="form-control btn btn-danger">Exit</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <table id="datatables" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Tên sản phẩm</th>
                            <th>Sku</th>
                            <th>Ảnh đại diện</th>
                            <th>Giá</th>
                            <th>Giá khuyến mãi</th>
                            <th>Số lượng</th>
                            <th>Thành tiền</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $carts = json_decode($order->content);
                        @endphp

                        @foreach ($carts as $cart)
                            {{-- @dd($cart) --}}
                            <tr>
                                <td>{{ $cart->name }}</td>
                                <td>{{ $cart->options->sku }}</td>
                                <td><img style="max-height: 200px" src="{{ asset($cart->options->avatar) }}" alt=""></td>
                                <td>{{ number_format($cart->price) }}</td>
                                <td>{{ $cart->options->promotion }}</td>
                                <td> <input type="number" class="form-control" name="quantily[{{$cart->rowId}}]" min="1" value="{{ $cart->qty }}"> </td>
                                @if ($cart->options->promotion != null)
                                    <td>{{ $cart->qty * $cart->options->promotion }}</td>
                                @else
                                    <td>{{ number_format($cart->qty * $cart->price) }}</td>
                                @endif
                                <td class="text-center">
                                    <a class="btn btn-danger btn-circle btn-sm delete-button" data-toggle="modal"
                                        data-action="{{ $cart->id }}" href="#myModal">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>


    </form>
@endsection
@section('js')
    <script src="{{ asset('vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
    <script src="{{ asset('Plugins/select2/js/select2.min.js') }}"></script>
    <script>
        // var route_prefix = "shop";
        var route_prefix = "/admin/laravel-filemanager";
    $('#lfm').filemanager('image',{prefix: route_prefix});

        $(document).ready(function() {
            $('.select').select2();
        });


        $(document).on('change', '#category-name', function() {
            $.ajax({
                type: "get",
                url: "{{ route('page.slug') }}",
                data: {
                    "title": $(this).val()
                },
                dataType: 'html',
                success: function(response) {
                    $('#slug').val(response);
                }
            })

        });
    </script>

@endsection
