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
                <ul class="girl-fashion nav">
                    <li>Thời trang cho nữ <span>| <i class="icon-edit fa-solid fa-pen-to-square"></i> </span></li>
                    <li class="sub-menu">
                        <a href="/admin/categories/women">Các sản phẩm <i class="icon-arrow fa-solid fa-caret-right"></i></a>
                        <ul class="list-small">
                            <li><a href="">Quần</a></li>
                            <li><a href="">Áo</a></li>
                            <li><a href="">Giày</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="man-fashion nav">
                    <li>Thời trang cho nam <span>| <i class="icon-edit fa-solid fa-pen-to-square"></i> </span></li>
                    <li class="sub-menu">
                        <a href="/admin/categories/men">Các sản phẩm <i class="icon-arrow fa-solid fa-caret-right"></i></a>
                        <ul class="list-small">
                            <li><a href="">Quần</a></li>
                            <li><a href="">Áo</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="child-fashion nav">
                    <li>Thời trang cho bé <span>| <i class="icon-edit fa-solid fa-pen-to-square"></i> </span></li>
                    <li class="sub-menu">
                        <a href="/admin/categories/children">Các sản phẩm <i class="icon-arrow fa-solid fa-caret-right"></i></a>
                        <ul class="list-small">
                            <li><a href="">Quần</a></li>
                            <li><a href="">Áo</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <div class="footer">
            
        </div>
    </div>
@endsection