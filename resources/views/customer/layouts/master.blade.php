    @include('customer.layouts.__header')

    <body>

        <!-- Spinner Start -->
        <div id="spinner" class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50  d-flex align-items-center justify-content-center">
            <div class="spinner-grow text-primary" role="status"></div>
        </div>
        <!-- Spinner End -->


        <!-- Navbar start -->
        @include('customer.layouts.__navbar')
        <!-- Navbar End -->




        <!-- Fruits Shop Start-->
        @yield('content')
        <!-- Fruits Shop End-->


        <!-- Footer Start -->
        @include('customer.layouts.__footer')
        <!-- Footer End -->




        <!-- Back to Top -->
        <a href="#" class="btn btn-primary border-3 border-primary rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/customer/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('assets/customer/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/customer/lib/lightbox/js/lightbox.min.js') }}"></script>
    <script src="{{ asset('assets/customer/lib/owlcarousel/owl.carousel.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('assets/customer/js/main.js') }}"></script>

    <script>
        document.getElementById('currentYear').textContent = new Date().getFullYear();
    </script>

    <!-- Data Table -->
    <script src="{{ asset('assets/customer/assets/extensions/simple-datatables/umd/simple-datatables.js') }}"></script>
    <script src="{{ asset('assets/customer/assets/static/js/pages/simple-datatables.js') }}"></script>

    <!-- SweetAlert CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function confirmDelete(id, catName, itemType = 'Data') {
            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: itemType + ' "' + catName + '" akan dihapus!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }
    </script>

    <script>

    function confirmRemoveCart(productId, productName)
    {
        Swal.fire({
            title: 'Hapus Product?',
            text:
                'Product ' +
                productName +
                ' akan dihapus dari keranjang',

            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal'
        }).then((result) => {

            if(result.isConfirmed)
            {
                removeItemFromCart(productId);
            }

        });
    }


    function clearCart()
    {
        Swal.fire({
            title: 'Kosongkan Keranjang?',
            text: 'Semua product akan dihapus',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonText: 'Batal',
            confirmButtonText: 'Ya, Kosongkan'
        }).then((result) => {

            if(result.isConfirmed)
            {
                window.location.href =
                    "{{ route('cart.clear') }}";
            }

        });
    }

    function confirmNonAktif(url, productName)
    {
        Swal.fire({
            title:
                'Non-Aktifkan Product ' +
                productName,

            text: 'Anda yakin?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Non-Aktifkan',
            cancelButtonText: 'Batal'
        }).then((result) => {

            if(result.isConfirmed)
            {
                window.location.href = url;
            }

        });
    }

    function confirmAktif(url, productName)
    {
        Swal.fire({
            title:
                'Aktifkan Product ' +
                productName,

            text: 'Anda yakin?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#198754',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Aktifkan',
            cancelButtonText: 'Batal'
        }).then((result) => {

            if(result.isConfirmed)
            {
                window.location.href = url;
            }

        });
    }
</script>

// Handling Alert
    @if(session('success'))

        <script>

        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: '{{ session('success') }}',
            timer: 2000,
            showConfirmButton: false
        });

        </script>

    @endif

    @if(session('error'))

        <script>

        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: '{{ session('error') }}'
        });

        </script>

    @endif

    @if(session('warning'))

        <script>

        Swal.fire({
            icon: 'warning',
            title: 'Peringatan',
            text: '{{ session('warning') }}'
        });

        </script>

    @endif

    if(data.cart_empty)
    {
        Swal.fire({
            icon: 'success',
            title: 'Keranjang Kosong',
            text: 'Kembali ke halaman menu',
            timer: 1500,
            showConfirmButton: false
        });

        setTimeout(() => {

            window.location.href =
                "{{ route('listproduct') }}";

        }, 1500);
    }

    @yield('script')
    </body>
</html>
