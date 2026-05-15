@extends('customer.layouts.master')
@section('title', 'Edit Category')

@section('content')

<div class="container-fluid py-5">
            <div class="container py-5">
                <h1 class="mb-4">Kelola Category</h1>
                <section id="multiple-column-form">
                    <div class="row match-height">
                    <div class="col-12">
                        <div class="card">
                        <div class="card-header">
                            <h3 class="card-title text-warning">Edit Category</h3>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                            <form class="form" action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group mandatory">
                                    <label for="cat_name" class="form-label"
                                        >Nama Category</label
                                    >
                                    <input
                                        type="text"
                                        id="cat_name"
                                        class="form-control mb-2"
                                        placeholder="Nama Category"
                                        name="cat_name"
                                        value="{{ old('cat_name', $category->cat_name) }}"
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
                                        value="{{ old('description', $category->description) }}"
                                        required
                                    />
                                    </div>
                                </div>
                                </div>
                                <div class="row">
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                    <a href="{{ route('categories.index') }}" class="btn btn-danger ms-2">Cancel</a>
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

