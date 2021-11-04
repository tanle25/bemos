@extends('master')
@section('title')
    Tin tức
@endsection

@section('content')
    <section class="container p-0">
        <h3 class="mt-5 pb-3 border-bottom">Tin tức</h3>
        <div class="content">
            @foreach ($posts as $post )
                <div class="post-item mb-4 p-3 border">
                    <span class="post-title"> <a href="{{asset('post/'.$post->slug)}}">{{$post->title}}</a> </span>
                    <div class="breadcrumb"> {{ \Carbon\Carbon::parse($post->created_at)->locale('vi')->diffForHumans() }}</div>
                    <div class="post-content">{{Str::limit($post->description, 300, '...') }}
                    </div>
                    <div class="d-flex justify-content-center mt-3">
                        <a role="button" class="btn-login" href="{{asset('post/'.$post->slug)}}">Chi tiet</a>
                    </div>
                </div>

            @endforeach

        </div>
    </section>
@endsection
