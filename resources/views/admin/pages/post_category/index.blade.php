@extends('dashboard')

@section('button')
    <a href="{{route('post-category.create')}}" class="btn btn-info float-sm-right" role="button"> Thêm mới</a>
@endsection
@section('title')
    Chuyên mục bài viết
@endsection
@section('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css"/>



@endsection
@section('content')
<table id="datatables" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Tên danh mục</th>
            <th>Đường dẫn</th>
            <th>Chuyên mục cha</th>
            <th>Trạng thái</th>
            <th>Action</th>

        </tr>
    </thead>
    <tbody>
        @foreach ($categories as $category )
        <tr>
            <td>{{$category->name}}</td>
            <td>{{$category->slug}}</td>
            @if ($category->cat_id)
                @php
                    $cat_name = $categories->where('id',$category->cat_id)->first();
                @endphp
            <td class="text-center"><span class="badge badge-info">{{$cat_name->name}}</span></td>
            @else
            <td class="text-center"><span class="badge badge-warning">Không có chuyên mục cha</span></td>
            @endif

            @if ($category->status==1)
            <td class="text-center"><span class="badge badge-info">Đang hoạt động</span></td>
            @else
            <td class="text-center"><span class="badge badge-warning">Ngừng hoạt động</span></td>
            @endif
            <td class="text-center">
				<a href="{{route('post-category.edit',$category->id)}}" class="btn btn-warning btn-circle"><i class="fa fa-edit"></i></a>
				<a class="btn btn-danger btn-circle btn-sm delete-button" data-toggle="modal" data-action="{{$category->id}}" href="#myModal">
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
    <script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.lazyload/1.9.1/jquery.lazyload.min.js"></script>

    <script>
        var id =null;

        $(document).ready(function() {
            $('#datatables').DataTable({
                drawCallback: function(){
                    $("img.lazy").lazyload();
                }
            });
        } );
        $(document).on('click','.delete-button', function () {
            id = $(this).attr('data-action');
            console.log('click');


        });
        $(document).on('click','#destroy',function(){
            $.ajax({
                type: "delete",
                url: "post-category/"+id,
                data: {
                    "id":id,
                },
                dataType: "json",

            }).done(function(data){
                    console.log(data);
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

            })
    </script>

@endsection
