@extends('admin.header')
@section('custom-css')
<link rel="stylesheet" href="{{ asset('css/admin/category/create.css') }}">
@endsection
@section('header')
<span class="fas fa-plus" style="font-size:25px;"></span> Create Category
@endsection
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
<li class="breadcrumb-item"><a href="{{ route('admin.category') }}">Manage Categories</a></li>
<li class="breadcrumb-item active"><a href="{{ route('admin.category.create') }}">Create Category</a></li>
@endsection
@section('content')
<div class="row justify-content-md-center create-category-row">
    <div class="col-md-7">
        <div class="card">
            <div class="card-body category-card">
                <h4 class="display-5 text-center add-category-card-body">Add a Category</h4>

                <form action="{{ route('admin.category.store') }}" method="POST" id="create_category">
                    @csrf
                    <div class="form-group row">
                        <div class="col-md-3">
                            <label for="name">Category Name</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" id="name" placeholder="Category Name" required autofocus>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span> 
                            @enderror
                        </div>  
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3">
                            <label for="description"id="form-group-description">Description</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}" id="category-description" placeholder="Category Description">
                            @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row create-cateogry-button-row">
                        <button type="submit" class="form-control create-category-button" name="submit" id="create-category-button">Create Category</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection