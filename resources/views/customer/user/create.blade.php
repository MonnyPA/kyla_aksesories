@extends('customer.layouts.master')
@section('title', 'Tambah User')

@section('content')

<div class="container-fluid py-5">
            <div class="container py-5">
                <h1 class="mb-4">Kelola User</h1>
                <section id="multiple-column-form">
                    <div class="row match-height">
                    <div class="col-12">
                        <div class="card">
                        <div class="card-header">
                            <h3 class="card-title text-warning">Tambah User</h3>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                            <form class="form" action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                    <label for="fullname" class="form-label"
                                        >Fullname</label
                                    >
                                    <input
                                        type="text"
                                        id="fullname"
                                        class="form-control mb-2"
                                        placeholder="Nama User"
                                        name="fullname"
                                        required
                                    />
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                    <label for="username" class="form-label"
                                        >Username</label
                                    >
                                    <input
                                        type="text"
                                        id="username"
                                        class="form-control mb-2"
                                        placeholder="Input username"
                                        name="username"
                                        required
                                    />
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                    <label for="phone" class="form-label"
                                        >Phone</label
                                    >
                                    <input
                                        type="text"
                                        id="phone"
                                        class="form-control mb-2"
                                        placeholder="Input phone"
                                        name="phone"
                                        required
                                    />
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                    <label for="email" class="form-label"
                                        >Email</label
                                    >
                                    <input
                                        type="text"
                                        id="email"
                                        class="form-control mb-2"
                                        placeholder="Input email"
                                        name="email"
                                        required
                                    />
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                    <label for="role_id" class="form-label"
                                        >Role</label
                                    >
                                    <div class="col-md-12 p-0">
                                        <select name="role_id" id="role_id" class="form-control mb-2 @error('role_id') is-invalid @enderror" required>
                                        <option value="" disabled selected>Select Role</option>
                                            @foreach($roles as $role)
                                                <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>
                                                        {{ $role->role_name }}
                                                </option>
                                            @endforeach
                                            @error('role_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </select>
                                    </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                    {{-- <label for="role_id" class="form-label"
                                        >Role</label
                                    >
                                    <div class="col-md-12 p-0">
                                        <select name="role_id" id="role_id" class="form-control mb-2 @error('role_id') is-invalid @enderror" required>
                                        <option value="" disabled selected>Select Category</option>
                                            @foreach($roles as $role)
                                                <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>
                                                        {{ $role->role_name }}
                                                </option>
                                            @endforeach
                                            @error('role_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </select>
                                    </div> --}}
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                    <label for="password" class="form-label"
                                        >Password</label
                                    >
                                    <input
                                        type="password"
                                        id="password"
                                        class="form-control mb-2"
                                        placeholder="Masukan Password"
                                        name="password"
                                        required
                                    />
                                    <small><a href="#" class="toggle-password" data-target="password">Lihat Password</a></small>
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="password_confirmation" class="form-label"
                                        >Konfirmasi Password</label
                                    >
                                    <input
                                        type="password"
                                        id="password_confirmation"
                                        class="form-control"
                                        placeholder="konfirmasi password"
                                        name="password_confirmation"
                                        required
                                    />
                                    <small><a href="#" class="toggle-password" data-target="password_confirmation">Lihat Password</a></small>
                                </div>
                                </div>



                                </div>
                                <div class="row">
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                    <a href="{{ route('users.index') }}" class="btn btn-danger ms-2">Cancel</a>
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

    <script>
        document.querySelectorAll('.toggle-password').forEach(function(element) {
            element.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('data-target');
                const targetInput = document.getElementById(targetId);
                if (targetInput.type === 'password') {
                    targetInput.type = 'text';
                    this.textContent = 'Sembunyikan Password';
                } else {
                    targetInput.type = 'password';
                    this.textContent = 'Lihat Password';
                }
            });
        });
    </script>
@endsection

