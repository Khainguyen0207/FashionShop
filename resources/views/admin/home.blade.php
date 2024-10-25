@extends('layouts.admin')
@push('head')
    <link rel="stylesheet" href="{{asset('assets/admin/css/statistics.css')}}">
@endpush

@section('overview')
    <div class="overview">
        <section>
            <div class="statistics"> <!-- statistics: số liệu thống kê -->
                <div class="quantity-data">
                    <div class="customer box-quantity">
                        <div class="bg-box">
                            <img src="{{asset('assets/admin/img/user.png')}} " alt="user">
                        </div>
                        <div class="content-box">
                            <li>Khách hàng</li>
                            <li>{{ $number_customers }}</li>
                        </div>
                    </div>
                    <div class="product box-quantity">
                        <div class="bg-box">
                            <img src="{{asset('assets/admin/img/product-f')}}ashion.png" alt="">
                        </div>
                        <div class="content-box">
                            <li>Sản phẩm</li>
                            <li>{{ $number_products }}</li>
                        </div>
                    </div>
                    <div class="order-wait box-quantity">
                        <div class="bg-box">
                            <img src="{{asset('assets/admin/img/order.png')}}" alt="">
                        </div>
                        <div class="content-box">
                            <li>Đơn hàng chờ duyệt</li>
                            <li>{{ $number_checking }}</li>
                        </div>
                    </div>
                    <div class="sales box-quantity">
                        <div class="bg-box">
                            <img src="{{asset('assets/admin/img/money.png')}}" alt="">
                        </div>
                        <div class="content-box">
                            <li>Doanh thu tháng <span id="month"></span></li>
                            <li><i class="fa-solid fa-dollar-sign"></i> {{ number_format($total, 0, ",", ".") }}</li>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="chart" style="padding-top: 10px;">
                <canvas id="myChart" width="100%"></canvas>
                <script>
                    const currentYear = new Date();
                    document.querySelector("#month").textContent = currentYear.getMonth() + 1;
                    const ctx = document.getElementById('myChart');
                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: ['T1', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7', 'T8', 'T9', 'T10', 'T11', 'T12'],
                            datasets: [{
                                label: 'Số lượng sản phẩm bán ra',
                                backgroundColor: "#C3FF93",
                                borderColor: "#000000",
                                data: [91, 22, 35, 7, 45, 57, 65, 12, 73, 97, 10],
                                borderWidth: 2,
                            }, {
                                label: 'Doanh thu (VNĐ)',
                                backgroundColor: "#FDFFC2",
                                borderColor: "#000000",
                                data: [160, 102, 86, 39, 49, 147, 157, 116, 189, 155, 95],
                                borderWidth: 2,
                            }],
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    
                                },
                                x: {
                                    beginAtZero: true,
                                    title: {
                                        display: true,
                                        text: 'Bảng thống kê số lượng sản phẩm bán ra và doanh thu theo từng tháng năm ' + currentYear.getFullYear()
                                    }
                                }
                            },
                        }
                    });
                </script>
            </div>
        </section>
    </div>
@endsection