@extends('base')

@section('css')
    <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
@endsection

@section('content')
    <!-- The sidebar -->
    <div class="sidebar">
        <a class="active" href="#home">خانه</a>
        <a href="#news">ساعات کاری</a>
        <a href="#contact">شرکت ها</a>
        <a href="#about">تسک ها</a>
    </div>

    <!-- Page content -->
@endsection
