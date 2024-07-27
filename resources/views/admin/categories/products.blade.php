@extends('layouts.categories.products')

@section('overview')
    <div class="overview">
        <section>
            <div class="tool-bar">
                <div class="interact_product">  <!-- interact_product: tương tác sản phẩm -->
                    <div class="search_product">
                        <input type="search" name="find_product" id="" placeholder="ID Sản Phẩm" >
                        <input type="search" name="find_product" id="" placeholder="Mã Sản Phẩm" >
                        <input type="search" name="find_product" id="" placeholder="Tên Sản Phẩm" >
                        <a href="">Tìm kiếm</a>
                    </div>
                    <div class="fill_product">
                        <!-- Hàm hiển thị số sản phẩm  -->
                    </div>
                </div>
                <div class="add_product">
                    <div class="add_product_single">
                        <a href="">Thêm sản phẩm</a>
                    </div>
                    <div class="add_product_file">
                        <a href="">Nhập sản phẩm</a>
                    </div>
                </div>
                
            </div>

            <div class="list-categorys">
                <table>
                    
                </table>
            </div>
        </section>
    </div>
@endsection