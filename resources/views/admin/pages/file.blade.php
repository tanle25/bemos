@extends('dashboard')
@section('title')
Quản lý file hệ thống
@endsection
@section('content')

    <iframe src="{{asset('shop/laravel-filemanager')}}" style="width: 100%; height: 500px; overflow: hidden; border: none;"></iframe>
@endsection

