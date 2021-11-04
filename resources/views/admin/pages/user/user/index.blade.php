@extends('dashboard')

@section('button')
    <a class="btn btn-info float-sm-right" role="button" href="{{ route('user-info.create') }}">Thêm mới</a>
@endsection
@section('title')
    Danh sách thành viên
@endsection
@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css" />

    <link rel="stylesheet" href="{{ asset('Plugins/sweetalert2/sweetalert2.min.css') }}">

@endsection
@section('content')
    <table id="datatables" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Tên người dùng</th>
                <th>Email</th>
                <th>Số điện thoại</th>
                <th>Trạng thái</th>
                <th>Action</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->last_name . ' ' . $user->first_name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone }}</td>
                    @if ($user->status == 1)
                        <td>Đang hoạt động</td>
                    @else
                        <td>Ngừng hoạt động</td>
                    @endif
                    <td class="text-center">
                        <a href="{{ route('user-info.edit', $user->id) }}" class="btn btn-sm btn-warning btn-circle"><i
                                class="fa fa-edit"></i></a>
                        <a class="btn btn-danger btn-circle btn-sm delete-button" data-toggle="modal"
                            data-action="{{ $user->id }}" href="#myModal">
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
    <script src="{{ asset('Plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.lazyload/1.9.1/jquery.lazyload.min.js"></script>
    <script src="{{ asset('Plugins/sweetalert2/sweetalert2.js') }}"></script>

    <script>
        var id = null;

        $(document).ready(function() {
            $('#datatables').DataTable({
                drawCallback: function() {
                    $("img.lazy").lazyload();
                }
            });
        });
        $(document).on('click', '.delete-button', function() {
            id = $(this).attr('data-action');
            console.log('click');


        });
        $(document).on('click', '#destroy', function() {
                $.ajax({
                    type: "delete",
                    url: "user-info/" + id,
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
        });
    </script>

@endsection
