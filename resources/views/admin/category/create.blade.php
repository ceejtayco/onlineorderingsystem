@extends('admin.index')
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
<div class="row justify-content-md-center">
    <div class="col-md-7">
        <div class="card">
            <div class="card-body">
                <h4 class="display-5 text-center">Add a Category</h4>

                <form action="" method="POST" id="create_category">
                    @csrf
                    <div class="form-group row">
                        <label for="name">Category Name</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="name" id="name" placeholder="Category Name">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection