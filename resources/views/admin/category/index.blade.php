@extends('admin.header')
@section('custom-css')
@endsection
@section('header')
<span class="fas fa-th" style="font-size:25px;"></span> Manage Categories
@endsection
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
<li class="breadcrumb-item active"><a href="{{ route('admin.category') }}">Manage Categories</a></li>
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <a href="{{ route('admin.category.create') }}" class="btn btn-warning"><span class="fas fa-plus"></span>&nbsp;Add Category</a>
    </div>
</div>
<br>
<div class="row text-center">
    <div class="col-md-12">
        <table class="table table-striped">
            <thead>
                <th>ID</th>
                <th>Category Name</th>
                <th>Description</th>
                <th>Date Added</th>
                <th>Created By</th>
                <th>Action</th>
            </thead>
            <tbody>
                @foreach($category as $result)
                    <tr>
                        <td>{{ $result->id }}</td>
                        <td>{{ $result->name }}</td>
                        <td>
                            @if(!empty($result->description))
                                {{ $result->description }}
                            @else
                                N/A
                            @endif
                        </td>
                        <td>{{ $result->created_at }}</td>
                        <td>{{ $result->user->firstname }} {{ $result->user->lastname }}</td>
                        <td>
                            <a href="" class="btn btn-warning">
                                <span class="fas fa-pencil-alt"></span>
                            </a>
                            <a href="" class="btn btn-danger">
                                <span class="fas fa-times"></span>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $category->links() }}
    </div>
</div>
@endsection