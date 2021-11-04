@extends('dashboard')

@section('button')
@if (Auth::guard('admin')->user()->can('Thêm người dùng'))
    <a class="btn btn-info float-sm-right" role="button" href="{{route('admin-permission.create')}}">Thêm mới</a>
    @endif
@endsection
@section('title')
    Danh sách quản trị viên
@endsection
@section('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css"/>



@endsection
@section('content')
<table id="datatables" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Tên đăng nhập</th>
            <th>Email</th>
            <th>Phân quyền</th>
            <th>Trạng thái</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($admins as $admin )
        <tr>
            <td>{{$admin->username}}</td>
            <td>{{$admin->email}}</td>
            <td>
                @foreach ($admin->getAllPermissions() as $permission )
                <span class="badge badge-info">{{$permission->name}}</span>
                @endforeach
            </td>
            @if ($admin->status == 1)
            <td class="text-center"><span class="badge badge-info">Đang hoạt động</span></td>
            @else
            <td class="text-center"><span class="badge badge-warning">Ngừng hoạt động</span></td>
            @endif

            <td class="text-center">
                <a href="{{route('admin-permission.edit',$admin->id)}}" class="btn btn-sm btn-warning btn-circle"><i class="fa fa-edit"></i></a>

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

    <script>

        $(document).ready(function() {
            $('#datatables').DataTable({
                drawCallback: function(){
                    $("img.lazy").lazyload();
                }
            });
        } );

    </script>

@endsection
