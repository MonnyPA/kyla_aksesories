@extends('customer.layouts.master')
@section('title', 'Kelola Product')

@section('content')

<div class="container-fluid py-5">
            <div class="container py-5">
                <h1 class="mb-4">Kelola Product</h1>
                <section class="section">
                        <div class="card">
                            <div class="card-body">
                                @if(session('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert"">
                                        <p><i class="bi bi-check-circle-fill"> {{ session('success') }}</i></p>
                                        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" style="font-size: 0.7rem;"></button>
                                    </div>
                                @endif
                                <div class="">
                                    <a href="{{ route('products.create') }}" class="btn btn-primary mb-3 ms-auto">New Product</a>
                                </div>
                                <table class="table table-striped" id="table1">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center">Gambar</th>
                                            <th class="text-center">Type</th>
                                            <th class="text-center">Nama</th>
                                            <th class="text-center">Harga Modal</th>
                                            <th class="text-center">Harga Jual</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $product)
                                        <tr>
                                            <td class="text-center align-middle">{{ $loop->iteration }}</td>
                                            <td class="text-center align-middle">
                                                <img src="{{ asset('img_product_upload/' . $product->img) }}" alt="{{ $product->name }}" class="img-thumbnail mb-2" style="width: 100px; height: 100px;" onerror="this.onerror=null;this.src='{{ $product->img }}';">
                                            </td>
                                            <td class="text-center align-middle">{{ $product->category->cat_name }}</td>
                                            <td class="text-center align-middle">{{ $product->name }}</td>
                                            <td class="text-center align-middle">{{ 'Rp. '. number_format($product->cost_price), 0, ',','.' }}</td>
                                            <td class="text-center align-middle">{{ 'Rp. '. number_format($product->selling_price), 0, ',','.' }}</td>
                                            <td class="text-center align-middle">
                                                <span class="badge {{ $product->is_active ? 'bg-success' : 'bg-danger' }}">
                                                    {{ $product->is_active ? 'Active' : 'Non Active' }}
                                                </span>
                                            </td>
                                            <td class="text-center align-middle">
                                                <a href="{{ route('products.show', $product->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-eye"></i> View</a>
                                                {{-- @if(Auth::user()->role->role_name == 'admin' || Auth::user()->role->role_name == 'direktur' || Auth::user()->role->role_name == 'owner' || Auth::user()->role->role_name == 'manager') --}}
                                                @if ($product->is_active)
                                                    <a href="{{ route('products.nonactive', $product->id) }}" class="btn btn-info btn-sm" onclick="return confirm('Are you sure you want to Non Active this Product  {{ $product->name }}?')"><i class="bi bi-x-circle"></i> Non Active</a>
                                                @else
                                                    <a href="{{ route('products.active', $product->id) }}" class="btn btn-success btn-sm" onclick="return confirm('Are you sure you want to Active this Product  {{ $product->name }}?')"><i class="bi bi-check-circle"></i> Active</a>
                                                @endif
                                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i> Edit</a>
                                                {{-- @endif --}}
                                            </td>
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
