@extends('admin.header')
@section('custom-css')
<link rel="stylesheet" href="{{ asset('css/admin/category/create.css') }}">
@endsection
@section('header')
<span class="fas fa-utensils" style="font-size:25px;"></span> Create Items
@endsection
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
<li class="breadcrumb-item"><a href="{{ route('admin.items') }}">Manage Items</a></li>
<li class="breadcrumb-item active"><a href="{{ route('admin.items.create') }}">Create Category</a></li>
@endsection
@section('content')
<div class="row justify-content-md-center create-category-row">
    <div class="col-md-7">
        <div class="card">
            <div class="card-body category-card">
                <h4 class="display-5 text-center add-category-card-body">Add Menu Item</h4>

                <form action="{{ route('admin.items.store') }}" method="POST" id="create_category" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <div class="col-md-3">
                            <label for="name">Item Name</label>
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
                    <div class="form-group row">
                        <div class="col-md-3">
                            <label for="category_id" id="form-group-description">Category</label>
                        </div>
                        <div class="col-md-9">
                            <select name="category_id" class="form-control"  id="category_id" required>
                                <option value="0" selected disabled>Select</option>
                                @foreach($category as $result)
                                    <option value="{{ $result->id }}">{{ $result->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3">
                            <label for="price"id="form-group-description">Price (With Tax)</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" id="price" placeholder="Item's Price" required>
                            @error('price')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3">
                            <label for="tax"id="form-group-description">Tax Rate (%)</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" class="form-control @error('tax') is-invalid @enderror" name="tax" value="{{ old('tax') }}" id="tax" placeholder="Item Tax" required>
                            @error('tax')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3">
                            <label for="qty"id="form-group-description">Stocks</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" class="form-control @error('qty') is-invalid @enderror" name="qty" value="{{ old('qty') }}" id="qty" placeholder="Current Stocks" required>
                            @error('qty')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3">
                            <label for="qty"id="form-group-description">Image</label>
                        </div>
                        <div class="col-md-9">
                            <input type="file" class="form-control" name="filename" style="padding: 0;">
                        </div>
                    </div>
                    <div class="form-group row create-cateogry-button-row">
                        <button type="submit" class="form-control create-category-button" name="submit" id="create-category-button">Create Menu Item</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection