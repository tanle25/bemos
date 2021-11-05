@extends('dashboard')
@section('button')
    <a class="btn btn-info float-sm-right" role="button" href="{{route('product.create')}}">Thêm mới</a>
@endsection
@section('css')

<link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.3/css/select.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css"/>
<link rel="stylesheet" type="text/css"  href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">


@endsection
@section('title')
Danh sách sản phẩm
@endsection
@section('content')
{{-- <div class="" style="width: 150%"></div> --}}
<table id="example" class="display">
        <thead>
            <tr>
                <th></th>
                <th></th>
                <th>id</th>
                <th>tiêu đề</th>
                <th>mô tả</th>
                <th>liên kết</th>
                <th>tình trạng</th>
                <th>giá</th>
                <th>còn hàng</th>
                <th>liên kết hình ảnh</th>
                <th>gtin</th>
                <th>mpn</th>
                <th>nhãn hiệu</th>
                <th>danh mục sản phẩm của Google</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product )
            <tr>
                <td></td>
                <td><img src="{{$product->avatar}}" alt="" width="200px"></td>
                <td>{{$product->sku}}</td>
                <td>{{$product->name}}</td>
                <td class="d-inline-block text-truncate" style="max-width: 200px">{{$product->short_description}}</td>
                <td>{{url('detail/'.$product->slug)}}</td>
                <td>mới</td>
                <td>{{($product->promotion_price != null) ? $product->promotion_price : $product->price}} vnd</td>

                <td>còn hàng</td>
                <td>{{$product->avatar}}</td>
                <td></td>
                <td></td>
                <td></td>
                <td>Đồ gỗ > Nội thất văn phòng</td>
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
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.lazyload/1.9.1/jquery.lazyload.min.js"></script>
<script src="{{asset('Plugins/sweetalert2/sweetalert2.all.min.js')}}"></script>
<script src="https://cdn.datatables.net/select/1.3.3/js/dataTables.select.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>



<script>
    var id= null;
    $(document).ready(function() {
            // $('#datatables').DataTable({

            //     columnDefs: [ {
            //         orderable: false,
            //         className: 'select-checkbox',
            //         targets:   0
            //     } ],
            //     select: {
            //         style:    'os',
            //         selector: 'td:first-child'
            //     },
            //     order: [[ 1, 'asc' ]]
            // });
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
    $(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        columnDefs: [
            {
                "targets": [ 5, 6, 8 ,9, 10, 11, 12, 13 ],
                "visible": false
            },
            {

           orderable: false,
           className: 'select-checkbox',
                      targets: 0
           }],
            select: {
                style: 'multi',
                  selector: 'td:first-child'
                },
              order: [[1, 'asc']],
              buttons: [ {
                extend: 'excel',
                text: 'Save as Excel',
                // filename: 'custom_name',
                title: null,
                extension: '.tsv',
                exportOptions: {
                    columns: [ 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13 ]
                }

            } ]
    } );
} );
// $(document).ready(function() {
//     $('#example').DataTable( {
//         dom: 'Bfrtip',
//         buttons: [
//             'copy',
//             'csv',
//             'excel',
//             'pdf',
//             {
//                 extend: 'print',
//                 text: 'Print all (not just selected)',
//                 exportOptions: {
//                     modifier: {
//                         selected: null
//                     }
//                 }
//             }
//         ],
//         select: true
//     } );
// } );
</script>
@endsection
