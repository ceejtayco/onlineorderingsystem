@extends('admin.header')
@section('custom-css')
<link rel="stylesheet" href="{{ asset('css/admin/item/index.css') }}">
@endsection
@section('header')
<span class="fas fa-utensils" style="font-size:25px;"></span> Manage Menu Items
@endsection
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
<li class="breadcrumb-item active"><a href="{{ route('admin.items') }}">Manage Menu Items</a></li>
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <a href="{{ route('admin.items.create') }}" class="btn btn-warning"><span class="fas fa-plus"></span>&nbsp;Add Menu Item</a>
    </div>
</div>
<br>
<div class="row text-center">
    <div class="col-md-12">
        <table class="table table-striped">
            <thead>
                <th>ID</th>
                <th>Category Name</th>
                <th>Item Name</th>
                <th>Price</th>
                <th>Tax</th>
                <th>Stocks</th>
                <th>Created By</th>
                <th>Action</th>
            </thead>
            <tbody>
                @foreach($items as $result)
                    <tr>   
                        <td>{{ $result->id }}</td>
                        <td>{{ $result->category->name }}</td>
                        <td>
                            {{ $result->name }}
                        </td>
                        <td>{{ $result->price }}</td>
                        <td>{{ intval($result->tax) }}%</td>
                        <td>{{ $result->qty }}</td>
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
        {{ $items->links() }}
    </div>
</div>
@endsection