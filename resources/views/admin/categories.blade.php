@extends('layouts.admin')

@push('head')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/categorys.css') }}">
@endpush
@section('overview')
    <div class="overview">
        <div id="header">
            <h1>Danh mục thời trang</h1>
        </div>
        <div class="tool-bar">
            <div class="">
                {{-- chưa biết thêm gì --}}
            </div>
            <div class="function">
                <a href="">Thêm danh mục</a>
            </div>
        </div>

        <div class="list-categorys">
            <div class="list-fashion">
                <h3>Danh mục thời trang</h3>
                @foreach ($categories as $category)
                <ul class="nav">
                    <li>{{ $category->name_category }} <span>| <i class="icon-edit fa-solid fa-pen-to-square"></i> </span></li>
                    <li class="sub-menu">
                        <a href="/admin/categories-{{$category->id}}">Các sản phẩm <i class="icon-arrow fa-solid fa-caret-right"></i></a>
                        <ul class="list-small">
                            <li><a href="">Quần</a></li>
                            <li><a href="">Áo</a></li>
                            <li><a href="">Giày</a></li>
                        </ul>
                    </li>
                </ul>
                @endforeach
            </div>
        </div>
        <div class="footer">
            
        </div>
    </div>
@endsection