@extends('dashboard')

@section('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css"/>



@endsection
@section('title')
    Danh sách tin đăng cung / cầu
@endsection
@section('content')
<table id="datatables" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Loại tin</th>
            <th>Người đăng</th>
            <th>tiêu đề</th>
            <th>Nội dung</th>
            <th>Hình ảnh</th>
            <th>Thời hạn</th>
            <th>Trạng thái</th>
            <th style="min-width: 100px">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($supplys as $supply )
            <tr>
                @if ($supply->type == 1)
                <td> <span class="badge badge-info">Cần bán</span></td>
                @else
                <td> <span class="badge badge-danger">Cần mua</span></td>
                @endif
                <td>{{$supply->person}}</td>
                <td>{{$supply->name}}</td>
                <td>{{$supply->content}}</td>
                <td><img class="lazy" data-original ="{{asset($supply->images)}}" alt="" width="250px"></td>
                <td>{{$supply->end_date}}</td>
                @if ($supply->status==1)
                <td><span class="badge badge-primary">Đang hoạt động</span></td>
                @else
                <td><span class="badge badge-warning">Ngừng hoạt động</span></td>
                @endif
                <td class="text-center">
                    @if ($supply->status==1)
                    <a href="{{route('supply.update',$supply->id)}}" class="btn btn-danger btn-circle"><i class="fa fa-times" aria-hidden="true"></i></a>
                    @else
                    <a href="{{route('supply.update',$supply->id)}}" class="btn btn-success btn-circle"><i class="fa fa-check" aria-hidden="true"></i></a>
                    @endif

                    <a class="btn btn-danger btn-circle btn-sm delete-button" data-toggle="modal" data-action="{{$supply->id}}" href="#myModal">
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
            url: "order/"+id,
            data: {"id":id},
            dataType: "json"
        }).done(function(data){
            // console.log(data);
            $('.modal-body').html(
                                        `<div class="svg-box">
                                <svg class="circular green-stroke">
                                    <circle class="path" cx="75" cy="75" r="50" fill="none" stroke-width="5" stroke-miterlimit="10"/>
                                </svg>
                                <svg class="checkmark green-stroke">
                                    <g transform="matrix(0.79961,8.65821e-32,8.39584e-32,0.79961,-489.57,-205.679)">
                                        <path class="checkmark__check" fill="none" d="M616.306,283.025L634.087,300.805L673.361,261.53"/>
                                    </g>
                                </svg>
                                <h5>Đã xoá</h5>
                            </div>`
                    );
                    setTimeout(function(){
                        $('#myModal').modal('toggle');
                        location.reload();
                    },1500);
                    //

        });
    });
</script>
@endsection
