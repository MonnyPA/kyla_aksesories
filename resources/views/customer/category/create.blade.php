@extends('customer.layouts.master')
@section('title', 'Tambah Product')

@section('content')

<div class="container-fluid py-5">
            <div class="container py-5">
                <h1 class="mb-4">Kelola Product</h1>
                <section id="multiple-column-form">
                    <div class="row match-height">
                    <div class="col-12">
                        <div class="card">
                        <div class="card-header">
                            <h3 class="card-title text-warning">Tambah Product</h3>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                @if($errors->any())
                                    <div class="alert alert-warning alert-dismissible fade show py-2 px-3 small" role="alert">
                                        <div class="d-flex align-items-center mb-2">
                                            <h5 class="mb-0">Oops! Terjadi kesalahan</h5>
                                        </div>
                                        <ul class="mb-0 ps-3">
                                            @foreach ($errors->all() as $error)
                                                <li class="small">{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif
                            <form class="form" action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group mandatory">
                                    <label for="name" class="form-label"
                                        >Nama Product</label
                                    >
                                    <input
                                        type="text"
                                        id="name"
                                        class="form-control mb-2"
                                        placeholder="Nama Product"
                                        name="name"
                                        required
                                    />
                                    </div>
                                    <div class="form-group">
                                    <label for="category_id" class="form-label"
                                        >Category</label
                                    >
                                    <div class="col-md-12 p-0">
                                        <select name="category_id" id="category_id" class="form-control mb-2 @error('category_id') is-invalid @enderror" required>
                                        <option value="" disabled selected>Select Category</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                        {{ $category->cat_name }}
                                                </option>
                                            @endforeach
                                            @error('category_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </select>
                                    </div>
                                    </div>
                                    <div class="form-group mandatory">
                                    <label for="stock" class="form-label"
                                        >Stock Product</label
                                    >
                                    <input
                                        type="text"
                                        id="stock"
                                        class="form-control mb-2"
                                        placeholder="Stoct Product"
                                        name="stock"
                                        required
                                    />
                                    </div>
                                    <div class="form-group">
                                    <label for="img" class="form-label"
                                        >Insert Gambar Product</label
                                    >
                                    <input
                                        type="file"
                                        id="img"
                                        class="form-control mb-2"
                                        placeholder="Inset Gambar Product"
                                        name="img"
                                        required
                                    />
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                    <label for="description" class="form-label"
                                        >Description</label
                                    >
                                    <input
                                        type="text"
                                        id="description"
                                        class="form-control mb-2"
                                        placeholder="Input Description"
                                        name="description"
                                        required
                                    />
                                    </div>
                                    <div class="form-group">
                                    <label for="cost_price" class="form-label"
                                        >Harga Modal</label
                                    >
                                    <input
                                        type="text"
                                        id="cost_price"
                                        class="form-control mb-2"
                                        placeholder="Input Harga Modal"
                                        name="cost_price"
                                        required
                                    />
                                    </div>
                                    <div class="form-group">
                                    <label for="selling_price" class="form-label"
                                        >Harga Jual</label
                                    >
                                    <input
                                        type="text"
                                        id="selling_price"
                                        class="form-control mb-2"
                                        placeholder="Input Harga Jual"
                                        name="selling_price"
                                        required
                                    />
                                    </div>
                                    <div class="form-group">
                                    <label for="is_active" class="form-label"
                                        >Status</label
                                    >
                                    <div class="form-check form-switch">
                                        <input type="hidden" name="is_active" value="0">
                                        <input type="checkbox" class="form-check-input mb-2" id="flexSwicthCheckChecked" name="is_active" value="1" checked>
                                        <label for="flexSwicthCheckChecked">Aktif/Tidak Aktif</label>
                                    </div>
                                    </div>
                                </div>
                                </div>
                                <div class="row">
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                    <a href="{{ route('products.index') }}" class="btn btn-danger ms-2">Cancel</a>
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

