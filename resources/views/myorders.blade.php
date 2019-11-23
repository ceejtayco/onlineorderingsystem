@extends('layouts.header')
@section('custom-css')
    <link rel="stylesheet" href="{{ asset('css/myorder.css') }}">
@endsection
@section('content')
    <div class="container-fluid order-container">
        @if(count($orders) > 0)
        <h4 class="display-4 category-header">Order Details</h4>
            <div class="row justify-content-md-center">
                <div class="col-md-8">
                    <div class="card order-details-card">
                        <div class="card-body">
                            <div class="row justify-content-md-center">
                                @foreach($orders as $order)
                                    <div class="col-md-12 container-orders">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="display-4 order-name">{{ $order['name'] }}</h4>
                                                <div class="pull-right">
                                                    <form action="" id="closebutton">
                                                        <button type="submit" class="form-control"><span class="fa fa-times"></span></button>
                                                    </form>
                                                </div>
                                                <div class="row justify-content-md-center image-details-row">
                                                    <div class="col-md-4">
                                                        @if(!empty($order['filename']))
                                                            <img src="{{ asset('uploads/'.$order['filename']) }}" alt="{{ $order['filename'] }}" class="order-img">
                                                        @else
                                                        <img src="{{ asset('img/noimage.png') }}" alt="No Image" class="order-img">
                                                        @endif
                                                    </div>
                                                    <div class="col-md-8 text-center item-details-column">
                                                        <h4 class="display-4 item-details-header text-left">Item Details</h4>
                                                        
                                                        <table class="table">
                                                            <tbody>
                                                                <tr>
                                                                    <th>Menu Category</th>
                                                                    <td>{{ $order['category'] }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Item Price</th>
                                                                    <td>&#8369;{{ $order['price'] }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Quanitity to Order</th>
                                                                    <td>{{ $order['qty'] }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Subtotal</th>
                                                                    <td>&#8369;{{ $order['subtotal'] }}</td>
                                                                </tr>
                                                               
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card summary-details">
                        <div class="card-body">
                            <h4 class="display-4 text-center summary-heading">Order Summary</h4>
                            <table class="table text-center">
                                <tbody>
                                    <tr>
                                        <th>Subtotal</th>
                                        <td>&#8369;{{ $total_gross }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tax</th>
                                        <td>&#8369;{{ $total_vat_amount }}</td>
                                    </tr>
                                    <tr>
                                        <th>Total Due</th>
                                        <td>&#8369;{{ number_format($total_amount,2,'.',',') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                                <form action="{{ route('checkout') }}" method="GET" id="form-order">
                                @csrf
                                <div class="form-group row">
                                        @csrf
                                        <input type="text" class="form-control @error('coupon') is-invalid @enderror" name="coupon" id="coupon" placeholder="Enter Valid Coupon Code (optional)" value="{{ old('coupon') }}">
                                        @error('coupon')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>
                                <div class="form-group row">
                                        <button type="submit" class="btn btn-orange confirm-order" name="submit">Proceed to Order</button>
                                </div>
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @else
        <h4 class="display-4 text-center empty-cart">Your cart is empty.</h4>
        @endif
    </div>
@endsection