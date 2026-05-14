@extends('customer.layouts.master')
@section('title', 'View Product')

@section('content')

<div class="container-fluid py-5">
            <div class="container py-5">
                <h1 class="mb-4">Kelola Product</h1>
                <section id="multiple-column-form">
                    <div class="row match-height">
                    <div class="col-12">
                        <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">View Product</h3>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                            <form class="form" action="#" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                    <label for="name" class="form-label"
                                        ><i>Nama Product :</i></label>
                                    <p><b>{{ $product->name }}</b></p>
                                    </div>
                                    <div class="form-group">
                                    <label for="description" class="form-label"
                                        ><i>Desciption :</i></label>
                                    <p><b>{{ $product->description }}</b></p>
                                    </div>
                                    <div class="form-group">
                                    <label for="category_id" class="form-label"
                                        ><i>Category :</i></label>
                                    <p><b>{{ $product->category->cat_name }}</b></p>
                                    </div>
                                    <div class="form-group">
                                    <label for="category_id" class="form-label"
                                        ><i>Harga Modal :</i></label>
                                    <p><b>{{ 'Rp. '. number_format($product->cost_price), 0, ',','.' }}</b></p>
                                    </div>
                                    <div class="form-group">
                                    <label for="category_id" class="form-label"
                                        ><i>Harga Jual :</i></label>
                                    <p><b>{{ 'Rp. '. number_format($product->selling_price), 0, ',','.' }}</b></p>
                                    </div>
                                    <div class="form-group">
                                    <label for="category_id" class="form-label"
                                        ><i>Stock :</i></label>
                                    <p><b>{{ $product->stock }} Pcs</b></p>
                                    </div>
                                    <div class="form-group">
                                    <label for="category_id" class="form-label"
                                        ><i>Status :</i></label>
                                    <p>
                                        <span class="badge {{ $product->is_active ? 'bg-success' : 'bg-danger' }}">
                                            {{ $product->is_active ? 'Active' : 'Non Active' }}
                                        </span>
                                    </p>
                                    </div>

                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                    <label for="description" class="form-label"
                                        ><i>Gambar Product :</i></label>
                                    <br><img src="{{ asset('img_product_upload/' . $product->img) }}" alt="{{ $product->name }}" class="img-thumbnail mb-2" style="width: 300px; height: 300px;" onerror="this.onerror=null;this.src='{{ $product->img }}';">
                                    </div>
                                </div>
                                </div>
                                <div class="row">
                                <div class="col-12 d-flex justify-content-end">
                                    @if ($product->is_active)
                                        <a href="{{ route('products.nonactive', $product->id) }}" class="btn btn-info ms-2" onclick="return confirm('Are you sure you want to Non Active this Product  {{ $product->name }}?')">Non Active</a>
                                    @else
                                        <a href="{{ route('products.active', $product->id) }}" class="btn btn-success ms-2" onclick="return confirm('Are you sure you want to Active this Product  {{ $product->name }}?')">Active</a>
                                    @endif
                                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning ms-2">Edit</a>
                                    <a href="{{ route('products.index') }}" class="btn btn-secondary ms-2">Kembali</a>
                                </div>
                                </div>
                            </form>
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                </section>
            </div>

        </div>
@endsection

