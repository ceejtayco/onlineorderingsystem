@extends('admin.index')
@section('custom-css')
@endsection
@section('header')
<span class="fas fa-tags" style="font-size:25px;"></span> Manage Coupons
@endsection
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
<li class="breadcrumb-item active"><a href="{{ route('admin.coupon') }}">Manage coupons</a></li>
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <a href="{{ route('admin.coupon.create') }}" class="btn btn-warning"><span class="fas fa-plus"></span>&nbsp;Add Coupon</a>
    </div>
</div>
<br>
<div class="row text-center">
    <div class="col-md-12">
        <table class="table table-striped">
            <thead>
                <th>ID</th>
                <th>Coupon Name</th>
                <th>Coupon Code</th>
                <th>Discount (%)</th>
                <th>Created By</th>
                <th>Created At</th>
                <th>Action</th>
            </thead>
            <tbody>
                @foreach($coupon as $result)
                    <tr>
                        <td>{{ $result->id }}</td>
                        <td>{{ $result->name }}</td>
                        <td>{{ $result->code }}</td>
                        <td>{{ $result->percentage }}</td>
                        <td>{{ $result->user->firstname }} {{ $result->user->lastname }}</td>
                        <td>{{ $result->created_at }}</td>
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
        {{ $coupon->links() }}
    </div>
</div>
@endsection