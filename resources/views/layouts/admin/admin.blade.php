@extends('layouts.app', ['title' => $title])

@section('layout')
<div class="wrapper">
    @include('layouts/admin/header')
    @include('layouts/admin/sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @yield('content')
    </div>

    @include('layouts/admin/footer')
</div>  
@endsection