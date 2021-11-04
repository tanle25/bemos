@extends('master')

@section('title')
    {{$post->title}}
@endsection

@section('content')
    <section class="container p-0">
        <h4 class="text-center mt-5 pb-3">{{$post->title}}</h4>
        <div class="breadcrumb"> {{ \Carbon\Carbon::parse($post->created_at)->locale('vi')->diffForHumans() }}</div>

        <div class="content">
            {!!$post->content!!}
        </div>
        <div class="comment mt-5">
            <h5 class="text-center">Để lại bình luận của bạn</h5>
            <div class="d-flex justify-content-center border-top pt-3">
                <form action="{{route('comment.store')}}" method="post" style="width: 700px">
                    @csrf
                    <input type="hidden" name="post_id" value="{{$post->id}}">
                    <div class="row">
                        <label for="" class="col-md-4">Tiêu đề:</label>
                        <div class="col-md-8 mb-3">
                            <input type="text" class="form-control" name="title">
                        </div>
                        <label for="" class="col-md-4">Bình luận:</label>
                        <div class="col-md-8">
                            <textarea class="form-control" name="content"></textarea>
                        </div>

                        <div class="col-12 d-flex justify-content-center mt-3">
                            <button class="text-uppercase btn-login" type="submit">Thêm bình luận</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="comment_list mt-5">
                <div class="row">
                    @foreach ($post->comments as $comment )
                        <div class="col-12 d-flex">
                            <div class="avatar mr-3">
                                <img class="rounded-circle w-100" src="{{asset('img/avatar.png')}}" alt="">
                            </div>
                            <div class="content">
                                <h5>{{$comment->title}}</h5>
                                <span>{{$comment->content}}</span>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </section>
@endsection
