@extends('customer.layouts.master')
@section('title', 'Kelola Role')

@section('content')

<div class="container-fluid py-5">
            <div class="container py-5">
                <h1 class="mb-4">Kelola Role</h1>
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
                                    <a href="{{ route('roles.create') }}" class="btn btn-primary mb-3 ms-auto">New Role</a>
                                </div>
                                <table class="table table-striped" id="table1">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center">Nama Role</th>
                                            <th class="text-center">Description</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($roles as $role)
                                        <tr>
                                            <td class="text-center align-middle">{{ $loop->iteration }}</td>
                                            <td class="text-center align-middle">{{ $role->role_name }}</td>
                                            <td class="text-center align-middle">{{ $role->description }}</td>
                                            <td class="text-center align-middle">
                                                <a href="#" class="btn btn-info btn-sm"><i class="bi bi-eye"></i> View</a>
                                                <a href="#" class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i> Edit</a>
                                                <form action="#" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this Category {{ $role->role_name }}?')"><i class="bi bi-trash"></i> Delete</button>
                                                    </form>
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
