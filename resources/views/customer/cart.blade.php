@extends('customer.layouts.master')
@section('title', 'Keranjang')

@section('content')

<div class="container-fluid py-5">
            <div class="container py-5">
                <form id="checkout-form" action="{{ route('checkout.store') }}" method="POST">
                    @csrf
                        @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" arial-label="Close"></button>
                        </div>

                        @endif

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
                                                <img src="{{ asset('img_product_upload/' . $product['img']) }}" alt="{{ $product['name'] }}" class="img-thumbnail mb-2" style="width: 100px; height: 100px;" onerror="this.onerror=null;this.src='{{ $product['img'] }}';">
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
                                                    <button type="button" class="btn btn-sm btn-minus rounded-circle bg-light border" onclick="updateQuantity('{{ $product['id'] }}', -1)" >
                                                    <i class="fa fa-minus"></i>
                                                    </button>
                                                </div>
                                                <input id="qty-{{ $product['id'] }}" type="text" class="form-control form-control-sm text-center border-0" value="{{ $product['qty'] }}">
                                                <div class="input-group-btn">
                                                    <button type="button" class="btn btn-sm btn-plus rounded-circle bg-light border" onclick="updateQuantity('{{ $product['id'] }}', 1)">
                                                        <i class="fa fa-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="mb-0 mt-4">{{ 'Rp. '. number_format($product['selling_price'] * $product['qty'], 0, '.','.') }}</p>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-md rounded-circle bg-light border mt-3" onclick="if(confirm('Apakah Anda yakin ingin menghapus Product {{ $product['name'] }} ini?')) { removeItemFromCart('{{ $product['id'] }}') }" >
                                                <i class="fa fa-times text-danger"></i>
                                            </button>
                                        </td>

                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('cart.clear') }}" class="btn btn-danger" onclick="confirm('Apakah anda yakin ingin mengosongkan keranjang?')">Kosongkan Keranjang</a>
                        </div>
                        <div class="row g-4 justify-content-end mt-1">
                            <div class="col-8"></div>
                            <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
                                <div class="bg-light rounded">
                                    <div class="p-4">
                                        <h3 class="display-6 mb-4">Total <span class="fw-normal">Pesanan</span></h3>
                                        <div class="d-flex justify-content-between mb-4">
                                            <h5 class="mb-0 me-4">Total</h5>
                                            <p class="mb-0">Rp. {{ number_format($subTotal, 0, '.','.') }}</p>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <p class="mb-0 me-4">Pajak (10%)</p>
                                            <div class="">
                                                <p class="mb-0">Rp. 0</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="py-4 mb-4 border-top d-flex justify-content-between">
                                        <h4 class="mb-0 ps-4 me-4">Grand Total</h4>
                                        <h4 class="mb-0 pe-4 text-primary">Rp. {{ number_format($subTotal, 0, '.','.') }}</h4>
                                    </div>
                                    <div class="py-4 mb-4 border-top d-flex justify-content-between">
                                        <h5 class="mb-0 ps-4 me-4">Metode Pembayaran</h5>
                                        <div class="mb-0 pe-4 mb-3 pe-5">
                                            <div class="form-check">
                                                <input type="radio" class="form-check-input bg-primary border-0" id="qris" name="payment_method" value="qris">
                                                <label class="form-check-label" for="qris">QRIS</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="radio" class="form-check-input bg-primary border-0" id="cash" name="payment_method" value="tunai">
                                                <label class="form-check-label" for="cash">Tunai</label>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="d-flex justify-content-end">
                                    <button id="pay-button" type="button" class="btn border-secondary py-3 text-uppercase text-primary">Simpan Transaksi</button>
                                </div>
                            </div>
                        </div>
                        @endif
                </form>
            </div>
        </div>
@endsection

@section('script')
    <script>
        function updateQuantity(productId, change)
        {
            const qtyInput = document.getElementById('qty-'+ productId);
            const currentQty =  parseInt(qtyInput.value);
            const newQty = currentQty + change;

            if(newQty <= 0)
                {
                    if(confirm('Apakah Anda yakin ingin menghapus Product ini?'))
                        {
                            removeItemFromCart(productId);
                        }
                    return;
                }

            fetch("{{ route('cart.update') }}",
                {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
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
                    alert('Terjadi kesalahan saat mengupdate keranjang')
                });
        }

        function removeItemFromCart(productId)
        {
            fetch("{{ route('cart.remove') }}",
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

        document.addEventListener('DOMContentLoaded', function() {
                const payButton = document.getElementById('pay-button');
                const form = document.querySelector('form');


                payButton.addEventListener('click', function() {
                    let paymentMethod = document.querySelector('input[name="payment_method"]:checked');

                    if (!paymentMethod) {
                        alert('Silakan pilih metode pembayaran terlebih dahulu.');
                        return;
                    }

                    paymentMethod = paymentMethod.value;

                    let formData = new FormData(form);

                    if(paymentMethod == 'tunai')
                    {
                        form.submit();
                    }
                });
            });
    </script>
@endsection
