@extends('customer.layouts.master')
@section('title', 'Daftar Penjualan')

@section('content')

<div class="container-fluid py-5">
            <div class="container py-5">
                <h1 class="mb-4">Daftar Penjualan</h1>
                <section class="section">
                        <div class="card">
                            <div class="card-body">
                                <table class="table table-striped" id="table1">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center">Tanggal Transaksi</th>
                                            <th class="text-center">Code Order</th>
                                            <th class="text-center">Lokasi</th>
                                            <th class="text-center">Metode Pembayaran</th>
                                            <th class="text-center">Total Transaksi</th>
                                            @if(Auth::user()->role->role_name == 'owner')
                                            <th class="text-center">Total Profit</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $order)
                                        <tr>
                                            <td class="text-center align-middle">{{ $loop->iteration }}</td>
                                            <td class="text-center align-middle">{{ \Carbon\Carbon::parse($order->created_at)->format('d M Y') }}</td>
                                            <td class="text-center align-middle">
                                                <a href="{{ route('orders.show', $order->id) }}">{{ $order->order_code }}</a>
                                            </td>
                                            <td class="text-center align-middle">{{ $order->user?->fullname ?? '-' }}</td>
                                            <td class="text-center align-middle">{{ Str::ucfirst($order->payment_method) }}</td>
                                            <td class="text-center align-middle">{{ 'Rp. '. number_format($order->total), 0, ',','.' }}</td>
                                            @if(Auth::user()->role->role_name == 'owner')
                                            <td class="text-center align-middle">{{ 'Rp. '. number_format($order->profit), 0, ',','.' }}</td>
                                            @endif
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
