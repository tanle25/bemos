@extends('master')

@section('title')
    {{$page->title}}
@endsection

@section('content')
    <section class="container pt-5 pb-3 image-inner">
        {!!$page->content!!}
    </section>
@endsection
