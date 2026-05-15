@extends('customer.layouts.master')
@section('title', 'Edit Role')

@section('content')

<div class="container-fluid py-5">
            <div class="container py-5">
                <h1 class="mb-4">Kelola Role</h1>
                <section id="multiple-column-form">
                    <div class="row match-height">
                    <div class="col-12">
                        <div class="card">
                        <div class="card-header">
                            <h3 class="card-title text-warning">Edit Role</h3>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                            <form class="form" action="{{ route('roles.update', $role->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group mandatory">
                                    <label for="role_name" class="form-label"
                                        >Nama Role</label
                                    >
                                    <input
                                        type="text"
                                        id="role_name"
                                        class="form-control mb-2"
                                        placeholder="Nama Role"
                                        name="role_name"
                                        value="{{ old('role_name', $role->role_name) }}"
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
                                        value="{{ old('description', $role->description) }}"
                                        required
                                    />
                                    </div>
                                </div>
                                </div>
                                <div class="row">
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                    <a href="{{ route('roles.index') }}" class="btn btn-danger ms-2">Cancel</a>
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

