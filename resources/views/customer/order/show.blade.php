@extends('customer.layouts.master')
@section('title', 'Detail Penjualan')

@section('content')

<div class="container-fluid py-5">
            <div class="container py-5">
                <h1 class="mb-4">Detail Penjualan</h1>
                <section id="multiple-column-form">
                    <div class="row match-height">
                    <div class="col-12">
                        <div class="card">
                        <div class="card-header">
                            <h4 class="text-warning">Order Code : {{ $order->order_code }}</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="row">
                                <div class="col-md-2">
                                        <p>Tanggal Transaksi</p>
                                        <p>Total Penjualan</p>
                                    </div>
                                    <div class="col-md-4">
                                        <p>: <b>{{ \Carbon\Carbon::parse($order->created_at)->format('d M Y // H:s') }}</b></p>
                                        <p>: <b>{{ 'Rp. '. number_format($order->total), 0, ',','.' }}</b></p>
                                    </div>
                                    <div class="col-md-2">
                                        @if(Auth::user()->role->role_name == 'owner')
                                        <p>Total Profit</p>
                                        @endif
                                        <p>Metode Pembayaran</p>
                                    </div>
                                    <div class="col-md-4">
                                        @if(Auth::user()->role->role_name == 'owner')
                                        <p class="">: <b>{{ 'Rp. '. number_format($order->profit), 0, ',','.' }}</b></p>
                                        @endif
                                        <p>: <b>{{ Str::ucfirst($order->payment_method) }}</b></p>
                                    </div>
                                <div class="row">
                                <div class="col-12 d-flex justify-content-end">
                                    <a href="{{ route('orders.index') }}" class="btn btn-info ms-2">Kembali</a>
                                </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                </section>
                <br>
                <section class="section">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title text-warning">Pruduct yang Terjual</h3>
                            </div>
                            <div class="card-body">


                                <table class="table table-striped" id="table1">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center">Category</th>
                                            <th class="text-center">Gambar <br>Product</th>
                                            <th class="text-center">Nama Product</th>
                                            <th class="text-center">Jumlah</th>
                                            @if(Auth::user()->role->role_name == 'owner')
                                            <th class="text-center">Harga Modal</th>
                                            @endif
                                            <th class="text-center">Harga Jual</th>
                                            <th class="text-center">Total Harga</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orderItems as $item)
                                        <tr>
                                            <td class="text-center align-middle">{{ $loop->iteration }}</td>
                                            <td class="text-center align-middle">{{ $item->product->category->cat_name }}</td>
                                            <td class="text-center align-middle">
                                                <img src="{{ asset('img_product_upload/' . $item->product->img) }}" alt="{{ $item->product->name }}" class="img-thumbnail mb-2" style="width: 60px; height: 60px;" onerror="this.onerror=null;this.src='{{ $item->product->img }}';">
                                            </td>
                                            <td class="text-center align-middle">{{ $item->product->name }}</td>
                                            <td class="text-center align-middle">{{ $item->quantity }}</td>
                                            @if(Auth::user()->role->role_name == 'owner')
                                            <td class="text-center align-middle">{{ 'Rp. '. number_format($item->product->cost_price), 0, ',','.' }}</td>
                                            @endif
                                            <td class="text-center align-middle">{{ 'Rp. '. number_format($item->product->selling_price), 0, ',','.' }}</td>
                                            <td class="text-center align-middle">{{ 'Rp. '. number_format($item->total_price), 0, ',','.' }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </section>
            </div>

</div>
@endsection

