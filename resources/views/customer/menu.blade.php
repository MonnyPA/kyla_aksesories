@extends('customer.layouts.master')
@section('title', 'Penjualan Product')

@section('content')
<div class="container-fluid fruite py-5">
            <div class="container py-5">
                <div class="row g-4">
                    <div class="col-lg-12">
                        <div class="row g-3">
                            <div class="col-lg">
                                <div class="row g-4 justify-content-center">
                                {{-- <table class="table table-striped" id="table1">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center">Category</th>
                                            <th class="text-center">Gambar</th>
                                            <th class="text-center">Nama Product</th>
                                            <th class="text-center">Harga</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $product)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td class="text-center">
                                                <span class="badge {{
                                                        optional($product->category)->cat_name == 'Jeday' ? 'bg-warning' :
                                                        (optional($product->category)->cat_name == 'Boneka' ? 'bg-info' :
                                                        (optional($product->category)->cat_name == 'Mainan' ? 'bg-success' :
                                                        'bg-dark'))
                                                    }}">
                                                    {{ $product->category->cat_name }}
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <img src="{{ $product->img }}" alt="{{ $product->name }}" class="img-thumbnail mb-2" style="width: 100px; height: 100px;">
                                            </td>
                                            <td class="text-center">{{ $product->name }}</td>
                                            <td class="text-center">{{ 'Rp. '. number_format($product->selling_price), 0, ',','.' }}</td>
                                            <td class="text-center">
                                                <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary">
                                                    <i class="fa fa-shopping-bag me-2 text-primary"></i> Tambah Keranjang</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table> --}}
                                <div class="row mb-4">
                                    <div class="col-md-6 mx-auto">
                                        <form action="{{ route('listproduct') }}" method="GET">
                                            <div class="input-group">
                                                <input
                                                    type="text"
                                                    name="search"
                                                    class="form-control"
                                                    placeholder="Cari product..."
                                                    value="{{ request('search') }}">
                                                <button
                                                    class="btn btn-primary"
                                                    type="submit">

                                                    <i class="fa fa-search"></i>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                    @foreach($products as $product)
                                    <div class="col-md-6 col-lg-6 col-xl-4">
                                        <div class="rounded position-relative fruite-item">
                                            <div class="fruite-img">
                                                <img src="{{ asset('img_product_upload/' . $product->img) }}" alt="{{ $product->name }}" class="img-fluid w-100 rounded-top" onerror="this.onerror=null;this.src='{{ $product->img }}';">
                                                <img src="{{ asset('img_product_upload/' . $product->img) }}" class="img-fluid w-100 rounded-top" alt="">
                                            </div>
                                            <div class="text-white bg-secondary px-3 py-1 rounded position-absolute
                                            @if($product->category->cat_name == "Jeday")
                                                bg-warning
                                            @elseif($product->category->cat_name == "Boneka")
                                                bg-info
                                            @elseif($product->category->cat_name == "Mainan")
                                                bg-success
                                            {{-- @elseif($product->category->cat_name == "Camilan")
                                                bg-dark --}}
                                            @else
                                                bg-secondary
                                            @endif" style="top: 10px; left: 10px;">{{ $product->category->cat_name }}</div>
                                            <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                <h4>{{ $product->name }}</h4>
                                                <p class="text-limited">{{ $product->description }}</p>
                                                <div class="d-flex justify-content-between flex-lg-wrap">
                                                    <p class="text-dark fs-5 fw-bold mb-0">{{ 'Rp. '. number_format($product->selling_price), 0, ',','.' }}</p>
                                                    <a href="#" onclick="addToCart({{ $product->id }})" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Tambah Keranjang</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach

                                    <!-- Pagination -->
                                    <!-- <div class="col-12">
                                        <div class="pagination d-flex justify-content-center mt-5">
                                            <a href="#" class="rounded">&laquo;</a>
                                            <a href="#" class="active rounded">1</a>
                                            <a href="#" class="rounded">2</a>
                                            <a href="#" class="rounded">3</a>
                                            <a href="#" class="rounded">4</a>
                                            <a href="#" class="rounded">5</a>
                                            <a href="#" class="rounded">6</a>
                                            <a href="#" class="rounded">&raquo;</a>
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection

@section('script')
    <script>
        function addToCart(productId)
        {
            fetch("{{ route('cart.add') }}",
                {
                    method: 'POST',
                    headers: {
                        'content-type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ id: productId })
                })
                .then(response => response.json())
                // console.log('Response:', response);
                // return response.json();
                .then(data => {
                    // console.log('Data:', data);
                    Swal.fire({
                        icon: data.status,
                        title: 'Berhasil',
                        text: data.message,
                        showConfirmButton: false,
                        timer: 2000
                    });
                })

                .catch((error) => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Terjadi kesalahan',
                        showConfirmButton: false,
                        timer: 2000
                    });

                    console.error(error);
                });
        }
    </script>
@endsection
