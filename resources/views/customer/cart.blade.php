@extends('customer.layouts.master')

@section('content')

<div class="container-fluid py-5">
            <div class="container py-5">
                @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" arial-label="Close"></button>
                        </div>

                    @endif

                    @if(empty($cart))
                        <h4 class="text-center">Keranjang Anda Kosong</h4>
                    @else
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Gambar</th>
                            <th scope="col">Nama Product</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Jumlah</th>
                            <th scope="col">Total</th>
                            <th scope="col">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                            @php
                                $subTotal = 0;
                            @endphp

                            @foreach ($cart as $product)
                                @php
                                    $productTotal = $product['selling_price'] * $product['qty'];
                                    $subTotal += $productTotal;
                                @endphp
                            <tr>
                                <td>
                                    <p class="mb-0 mt-4">{{ $loop->iteration }}</p>
                                </td>
                                <th scope="row">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ $product['img'] }}" alt="{{ $product['name'] }}" class="img-thumbnail mb-2" style="width: 100px; height: 100px;" onerror="this.onerror=null;this.src='{{ $product['img'] }}';">
                                        {{-- <img src="{{ asset('img_item_upload/' . $item->img) }}" alt="{{ $item->name }}" class="img-thumbnail mb-2" style="width: 300px; height: 300px;" onerror="this.onerror=null;this.src='{{ $item->img }}';"> --}}
                                    </div>
                                </th>
                                <td>
                                    <p class="mb-0 mt-4">{{ $product['name'] }}</p>
                                </td>
                                <td>
                                    <p class="mb-0 mt-4">{{ 'Rp. '. number_format($product['selling_price'], 0, '.','.') }}</p>
                                </td>
                                <td>
                                    <div class="input-group quantity mt-4" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-minus rounded-circle bg-light border" >
                                            <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text" class="form-control form-control-sm text-center border-0" value="1">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-plus rounded-circle bg-light border">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="mb-0 mt-4">{{ 'Rp. '. number_format($product['selling_price'] * $product['qty'], 0, '.','.') }}</p>
                                </td>
                                <td>
                                    <button class="btn btn-md rounded-circle bg-light border mt-4" >
                                        <i class="fa fa-times text-danger"></i>
                                    </button>
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-end">
                    <a href="#" class="btn btn-danger" onclick="confirm('Apakah anda yakin ingin mengosongkan keranjang?')">Kosongkan Keranjang</a>
                </div>

                <div class="row g-4 justify-content-end mt-1">
                    <div class="col-8"></div>
                    <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
                        <div class="bg-light rounded">
                            <div class="p-4">
                                <h2 class="display-6 mb-4">Total <span class="fw-normal">Pesanan</span></h2>
                                {{-- <div class="d-flex justify-content-between mb-4">
                                    <h5 class="mb-0 me-4">Total</h5>
                                    <p class="mb-0">Rp. {{ number_format($subTotal, 0, '.','.') }}</p>
                                </div> --}}
                                {{-- <div class="d-flex justify-content-between">
                                    <p class="mb-0 me-4">Pajak (10%)</p>
                                    <div class="">
                                        <p class="mb-0">Rp8.500,00</p>
                                    </div>
                                </div> --}}
                            </div>
                            <div class="py-4 mb-4 border-top d-flex justify-content-between">
                                <h4 class="mb-0 ps-4 me-4"></h4>
                                <h4 class="mb-0 pe-4">Rp. {{ number_format($subTotal, 0, '.','.') }}</h4>
                            </div>

                        </div>
                        <div class="d-flex justify-content-end">
                            <div class="mb-0 mb-3">
                                <a href="{{ route('checkout') }}" class="btn border-secondary py-3 text-primary text-uppercase mb-4" type="button">Lanjut ke Pembayaran</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
@endsection

@section('script')
    <script>
        function updateQuantity(productId, change)
        {
            var qtyInput = document.getElementById('qty-'+ productId);
            var currentQty =  parseInt(qtyInput.value);
            var newQty = currentQty + change;

            if(newQty <= 0)
                {
                    if(confirm('Apakah Anda yakin ingin menghapus item ini?'))
                        {
                            removeItemFromCart(productId);
                        }
                    return;
                }

            fetch("{{ route('cart.update') }}",
                {
                    method: 'POST',
                    headers: {
                        'Content-type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        id: productId,
                        qty: newQty
                    })
                })
                .then(response => response.json())
                // console.log('Response:', response); // debug
                // return response.json(); // debug
                .then(data => {
                    // console.log('Data:', data); // debug
                    if(data.success)
                        {
                            qtyInput.value = newQty;
                            location.reload();
                        } else
                        {
                            alert(data.message);
                        }
                })

                .catch((error) => {
                    console.error('error: ', error);
                    alert('Terjadi keselahan saat mengupdate keranjang')
                });
        }

        function removeItemFromCart(itemId)
        {
            fetch("{{ route('cart.remove') }}",
                {
                    method: 'POST',
                    headers: {
                        'content-type': 'aplication/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({id: productId})
                })
                .then(response => response.json())
                // console.log('Response:', response);
                // return response.json();
                .then(data => {
                    // console.log('Data:', data); // debug
                    if(data.success)
                        {
                            location.reload();
                        } else
                        {
                            alert(data.message);
                        }
                })

                .catch((error) => {
                    console.error('error: ', error);
                    alert('Terjadi keselahan saat menghapus Item')
                });
        }
    </script>
@endsection
