@extends('customer.layouts.master')
@section('title', 'Kelola User')

@section('content')

<div class="container-fluid py-5">
            <div class="container py-5">
                <h1 class="mb-4">Kelola User</h1>
                <section class="section">
                        <div class="card">
                            <div class="card-body">
                                <div class="">
                                    <a href="{{ route('users.create') }}" class="btn btn-primary mb-3 ms-auto">New User</a>
                                </div>
                                <table class="table table-striped" id="table1">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center">Username</th>
                                            <th class="text-center">Fullname</th>
                                            <th class="text-center">Email</th>
                                            <th class="text-center">Phone</th>
                                            <th class="text-center">Role</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                        <tr>
                                            <td class="text-center align-middle">{{ $loop->iteration }}</td>
                                            <td class="text-center align-middle">{{ $user->username }}</td>
                                            <td class="text-center align-middle">{{ $user->fullname }}</td>
                                            <td class="text-center align-middle">{{ $user->email }}</td>
                                            <td class="text-center align-middle">{{ $user->phone }}</td>
                                            <td class="text-center align-middle">{{ Str::ucfirst($user->role->role_name) }}</td>
                                            <td class="text-center align-middle">
                                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i> Edit</a>
                                                <form id="delete-form-{{ $user->id }}"
                                                    action="{{ route('users.destroy', $user->id) }}"
                                                    method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button"
                                                            class="btn btn-danger btn-sm"
                                                            onclick="confirmDelete({{ $user->id }},  '{{ $user->fullname }}', 'User')">
                                                        <i class="bi bi-trash"></i> Delete
                                                    </button>
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
