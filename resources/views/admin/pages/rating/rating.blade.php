@extends('dashboard')
@section('title')
    Đánh giá
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('Plugins/sweetalert2/sweetalert2.min.css') }}">

@endsection
@section('content')
<table id="datatables" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Người đánh giá</th>
            <th>Sản phẩm</th>
            <th>Sao</th>
            <th>Nội dung</th>
            {{-- <th>Trạng thái</th> --}}
            <th style="min-width: 100px">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($rates as $rate )
            <tr>
                <td> {{$rate->last_name. ' ' .$rate->first_name}}</td>
                <td>{{$rate->product_name}}</td>
                <td>{{$rate->rating}}</td>
                <td>{{$rate->content}}</td>
                {{-- <td>{{$address}}</td> --}}
                {{-- <td>{{number_format($rate->total_price)}}đ</td> --}}

                <td class="text-center">
                    <a class="btn btn-danger btn-circle btn-sm delete-button" data-action="{{$rate->id}}">
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
                <button class="btn btn-danger" id="destroy" role="button">Xoá</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

@endsection
@section('js')
<script src="{{asset('Plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('Plugins/sweetalert2/sweetalert2.js') }}"></script>

    <script>
        var id = null;
        // $(document).ready(function() {
        //     $('#datatables').DataTable();
        // } );
        $(document).on('click', '.delete-button', function() {
            id = $(this).attr('data-action');

        });

    $(document).on('click','.delete-button', function () {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
            // title: 'Are you sure?',
            text: "Bạn chắc chắn muốn xoá",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Vẫn xoá!',
            cancelButtonText: 'Huỷ',
            reverseButtons: true
            }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "delete",
                    url: "rate/" + id,
                    data: {
                        "id": id,
                    },
                    dataType: "json",
                }).done(function(data) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Đã xoá',
                        timer: 1500
                    }).then(()=>{
                        location.reload();
                    })
                });
            }
            })
    });
</script>
@endsection
