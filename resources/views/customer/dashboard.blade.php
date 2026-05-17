@extends('customer.layouts.master')
@section('title', 'Dashboard')

@section('content')
<div class="container-fluid py-5">
            <div class="container py-5">
                <div class="page-heading">
                    <h3 class="">Selamat Datang, <span class="text-warning">{{ Str::ucfirst(auth()->user()?->role?->role_name) }}</span> || <i class="text-success">{{ auth()->user()?->fullname }}</i></h3></h3>
                </div>
                <br>
                <div class="page-content">
                    <section class="row">
                        @if(Auth::user()->role->role_name == 'owner')
                        <div class="col-12 col-lg-3">
                            <div class="col">
                                <div class="col-6 col-lg-12 col-md-6 mb-3">
                                    <div class="card">
                                        <div class="card-body px-4 py-4-5">
                                            <div class="row">
                                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                                    <div class="stats-icon purple mb-2">
                                                        <i class="iconly-boldChart fs-1"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                                    <h6 class="text-muted font-semibold">Penjualan Today</h6>
                                                    <h6 class="font-extrabold mb-0 text-info">{{ 'Rp. '. number_format($todayRevenue), 0, ',','.' }}</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-lg-12 col-md-6 mb-3">
                                    <div class="card">
                                        <div class="card-body px-4 py-4-5">
                                            <div class="row">
                                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                                    <div class="stats-icon blue mb-2">
                                                        <i class="iconly-boldWallet fs-1"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                                    <h6 class="text-muted font-semibold">Profit Today</h6>
                                                    <h6 class="font-extrabold mb-0 text-success">{{ 'Rp. '. number_format($todayProfit), 0, ',','.' }}</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-lg-12 col-md-6 mb-3">
                                    <div class="card">
                                        <div class="card-body px-4 py-4-5">
                                            <div class="row">
                                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                                    <div class="stats-icon green mb-2">
                                                        <i class="iconly-boldChart fs-1"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                                    <h6 class="text-muted font-semibold">Penjualan Weekly</h6>
                                                    <h6 class="font-extrabold mb-0 text-info">{{ 'Rp. '. number_format($weeklyRevenue), 0, ',','.' }}</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-lg-12 col-md-6 mb-3">
                                    <div class="card">
                                        <div class="card-body px-4 py-4-5">
                                            <div class="row">
                                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                                    <div class="stats-icon red mb-2">
                                                        <i class="iconly-boldWallet fs-1"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                                    <h6 class="text-muted font-semibold">Profit Weekly</h6>
                                                    <h6 class="font-extrabold mb-0 text-success">{{ 'Rp. '. number_format($weeklyProfit), 0, ',','.' }}</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-lg-12 col-md-6 mb-3">
                                    <div class="card">
                                        <div class="card-body px-4 py-4-5">
                                            <div class="row">
                                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                                    <div class="stats-icon red mb-2">
                                                        <i class="iconly-boldChart fs-1"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                                    <h6 class="text-muted font-semibold">Penjualan Monthly</h6>
                                                    <h6 class="font-extrabold mb-0 text-info">{{ 'Rp. '. number_format($monthlyRevenue), 0, ',','.' }}</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-lg-12 col-md-6 mb-3">
                                    <div class="card">
                                        <div class="card-body px-4 py-4-5">
                                            <div class="row">
                                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                                    <div class="stats-icon red mb-2">
                                                        <i class="iconly-boldWallet fs-1"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                                    <h6 class="text-muted font-semibold">Profit Monthly</h6>
                                                    <h6 class="font-extrabold mb-0 text-success">{{ 'Rp. '. number_format($monthlyProfit), 0, ',','.' }}</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if(Auth::user()->role->role_name == 'admin' || Auth::user()->role->role_name == 'cashier_osm' || Auth::user()->role->role_name == 'cashier_kd' )
                        <div class="col-12 col-lg-3">
                            <div class="col">
                                <div class="col-6 col-lg-12 col-md-6 mb-3">
                                    <div class="card">
                                        <div class="card-body px-4 py-4-5">
                                            <div class="row">
                                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                                    <div class="stats-icon purple mb-2">
                                                        <i class="iconly-boldChart fs-1"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                                    <h6 class="text-muted font-semibold">Penjualan Today</h6>
                                                    <h6 class="font-extrabold mb-0 text-info">{{ 'Rp. '. number_format($todayRevenue), 0, ',','.' }}</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-lg-12 col-md-6 mb-3">
                                    <div class="card">
                                        <div class="card-body px-4 py-4-5">
                                            <div class="row">
                                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                                    <div class="stats-icon green mb-2">
                                                        <i class="iconly-boldChart fs-1"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                                    <h6 class="text-muted font-semibold">Penjualan Weekly</h6>
                                                    <h6 class="font-extrabold mb-0 text-info">{{ 'Rp. '. number_format($weeklyRevenue), 0, ',','.' }}</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-lg-12 col-md-6 mb-3">
                                    <div class="card">
                                        <div class="card-body px-4 py-4-5">
                                            <div class="row">
                                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                                    <div class="stats-icon red mb-2">
                                                        <i class="iconly-boldChart fs-1"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                                    <h6 class="text-muted font-semibold">Penjualan Monthly</h6>
                                                    <h6 class="font-extrabold mb-0 text-info">{{ 'Rp. '. number_format($monthlyRevenue), 0, ',','.' }}</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="col-12 col-lg-9">
                            <div class="row mb-3">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="text-warning">Statistik Penjualan</h4>
                                        </div>
                                        <div class="card-body">
                                            <canvas id="dailyOrdersChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-12 col-xl-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="text-warning">Penjualan Terakhir</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-hover table-lg" id="table1">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Tanggal Transaksi</th>
                                                            <th>Kode Transaksi</th>
                                                            <th>Total</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($orders as $order)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d M Y') }}</td>
                                                            <td>
                                                                <a href="{{ route('orders.show', $order->id) }}">{{ $order->order_code }}</a>
                                                            </td>
                                                            <td>{{ 'Rp. '. number_format($order->total), 0, ',','.' }}</td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 col-xl-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="text-warning">Product Terlaris</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-hover table-lg">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Nama Product</th>
                                                            <th>Total Terjual</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($topProducts as $item)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $item->product->name }}</td>
                                                            <td>{{ $item->total_sold }} Pcs</td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-xl-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="text-warning">Product Stock Hampir Habis</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-hover table-lg">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Nama Product</th>
                                                            <th>Sisa Stock</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($lowStocks as $product)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $product->name }}</td>
                                                            <td>{{ $product->stock }} Pcs</td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
</div>

@endsection

@section('script')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('dailyOrdersChart');

    const dailyOrdersChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [],
            datasets: [{
                label: 'Total Penjualan Harian',
                data: [],
                borderColor: '#435ebe',
                backgroundColor: 'rgba(67, 94, 190, 0.2)',
                borderWidth: 2,
                tension: 0.3,
                fill: true
            }]
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'Report Total Penjualan Harian'
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    function loadDailyOrders() {
        fetch('/dashboard/daily-orders')
            .then(response => response.json())
            .then(result => {

                dailyOrdersChart.data.labels = result.labels;
                dailyOrdersChart.data.datasets[0].data = result.data;

                dailyOrdersChart.update();
            })
            .catch(error => console.log(error));
    }

    loadDailyOrders();
</script>

<script>
    const ctx = document.getElementById('dailyRevenueChart');

    const revenueChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [],
            datasets: [{
                label: 'Total Revenue (Rp)',
                data: [],
                backgroundColor: '#28c76f',
                borderColor: '#28c76f',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,

            plugins: {
                title: {
                    display: true,
                    text: 'Report Total Revenue Harian'
                },

                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return 'Rp ' + context.raw.toLocaleString('id-ID');
                        }
                    }
                }
            },

            scales: {
                y: {
                    beginAtZero: true,

                    ticks: {
                        callback: function(value) {
                            return 'Rp ' + value.toLocaleString('id-ID');
                        }
                    }
                }
            }
        }
    });

    function loadRevenue() {
        fetch('/dashboard/daily-revenue')
            .then(response => response.json())
            .then(result => {

                revenueChart.data.labels = result.labels;
                revenueChart.data.datasets[0].data = result.data;

                revenueChart.update();
            });
    }

    loadRevenue();
</script>

@endsection


