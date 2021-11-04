@extends('dashboard')
@section('button')
    <a class="btn btn-info float-sm-right" role="button" href="{{route('product.create')}}">Thêm mới</a>
@endsection
@section('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css"/>



@endsection
@section('title')
Danh sách sản phẩm
@endsection
@section('content')
<table id="datatables" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Tên Sản phẩm</th>
            <th>Mã sản phẩm</th>
            <th>Hình ảnh</th>
            <th>Giá</th>
            <th>Giá khuyến mãi</th>
            <th>Danh mục</th>
            <th>Trạng thái</th>
            <th style="min-width: 100px">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $product )
            <tr>
                <td> {{$product->name}}</td>
                <td>{{$product->sku}}</td>
                <td><img class="lazy" data-original ="{{asset($product->avatar)}}" alt="" width="250px"></td>
                <td>{{number_format($product->price)}}</td>
                <td>{{number_format($product->promotion_price)}}</td>
                <td>{{$product->cat_name}}</td>
                @if ($product->status==1)
                    <td class="text-center"><span class="badge badge-info">Đang kinh doanh</span></td>
                @else
                <td class="text-center"><span class="badge badge-warning">Ngừng kinh doanh</span></td>
                @endif


                <td class="text-center">
                    <a href="{{route('product.edit',$product->id)}}" class="btn btn-warning btn-circle"><i class="fa fa-edit"></i></a>
                    <a class="btn btn-danger btn-circle btn-sm delete-button" data-toggle="modal" data-action="{{$product->id}}" href="#myModal">
                        <i class="fa fa-trash"></i>
                    </a>
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
@endsection
@section('js')

<script src="{{asset('Plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.lazyload/1.9.1/jquery.lazyload.min.js"></script>
<script src="{{asset('Plugins/sweetalert2/sweetalert2.all.min.js')}}"></script>

<script>
    var id= null;
    $(document).ready(function() {
            $('#datatables').DataTable({
                drawCallback: function(){
                    $("img.lazy").lazyload();
                }
            });
        } );

    $('.delete-button').on('click',function(){
        id = $(this).data('action');

    });
    $('#destroy').on('click',function(){
        $.ajax({
            type: "delete",
            url: "product/"+id,
            data: {"id":id},
            dataType: "json"
        }).done(function(data){
            // console.log(data);
            Swal.fire({
                icon: 'success',
                title: 'Đã xoá',
                timer: 1500
                }).then(()=>{
                    location.reload(true);
                })
        });
    });
</script>
@endsection
