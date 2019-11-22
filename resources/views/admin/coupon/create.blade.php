@extends('admin.index')
@section('custom-css')
<link rel="stylesheet" href="{{ asset('css/admin/category/create.css') }}">
@endsection
@section('header')
<span class="fas fa-tags" style="font-size:25px;"></span> Create Coupons
@endsection
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
<li class="breadcrumb-item"><a href="{{ route('admin.coupon') }}">Manage Coupon</a></li>
<li class="breadcrumb-item active"><a href="{{ route('admin.coupon.create') }}">Create Coupon</a></li>
@endsection
@section('content')
<div class="row justify-content-md-center create-category-row">
    <div class="col-md-7">
        <div class="card">
            <div class="card-body category-card">
                <h4 class="display-5 text-center add-category-card-body">Add Coupon</h4>

                <form action="{{ route('admin.coupon.store') }}" method="POST" id="create_category" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <div class="col-md-3">
                            <label for="name">Coupon Name</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" id="name" placeholder="Coupon Name" required autofocus>
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
                            <input type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}" id="category-description" placeholder="Coupon Description">
                            @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <div class="col-md-3">
                            <label for="code"id="form-group-description">Coupon Code</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" class="form-control @error('code') is-invalid @enderror" name="code" value="{{ old('code') }}" id="code" placeholder="Coupon Code (ex. GO2018)" required>
                            @error('code')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3">
                            <label for="percentage"id="form-group-description">Discount (%)</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" class="form-control @error('percentage') is-invalid @enderror" name="percentage" value="{{ old('percentage') }}" id="percentage" placeholder="Coupon Discount" required>
                            @error('percentage')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="form-group row create-cateogry-button-row">
                        <button type="submit" class="form-control create-category-button" name="submit" id="create-category-button">Create Coupon</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection