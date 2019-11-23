@extends('layouts.header')
@section('custom-css')
    <link rel="stylesheet" href="{{ asset('css/quantity.css') }}">
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-md-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <p class="quantity-header text-center">Item details</p>
                        <div class="row justify-content-md-center item-details-row">
                            <div class="col-md-6">
                                    @if(!empty($item->filename))
                                        <img src="{{ asset('uploads/'.$item->filename) }}" alt="{{ $item->filename }}" class="category-img">
                                    @else
                                        <img src="{{ asset('img/noimage.png') }}" alt="No Image" class="category-img">
                                    @endif
                            </div>
                            <div class="col-md-6 item-details">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <th>Item:</th>
                                                <td>{{ $item->name }}</td>
                                            </tr>
                                            <tr>
                                                <th>Category:</th>
                                                <td>{{ $item->category->name }}</td>
                                            </tr>
                                            <tr>
                                                <th>Gross:</th>
                                                <td>&#8369;{{ $gross }}</td>
                                            </tr>
                                            <tr>
                                                <th>Tax:</th>
                                                <td>{{ intval($item->tax) }}%</td>
                                            </tr>
                                            <tr>
                                                <th>Tax Amount:</th>
                                                <td>&#8369;{{ $amount }}</td>
                                            </tr>
                                            <tr>
                                                <th>Net (with Tax):</th>
                                                <td>&#8369;{{ $item->price }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    {{-- <p><strong>Item:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $item->name }}</strong><br>
                                    Category:&nbsp;&nbsp;&nbsp; {{ $item->category->name }} <br>
                                    Gross:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#8369;{{ $gross }}<br>
                                    Tax:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ intval($item->tax ) }}%<br>
                                    Tax Amount:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $amount }}<br>
                                    Price:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#8369;{{ $item->price }}</p> --}}
                                   <form action="{{ route('session.order.store') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                                <input type="text" class="form-control @error('qty') is-invalid @enderror" name="qty" value="{{ old('qty') }}" placeholder="Quantity" required autofocus>
                                                @error('qty')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                <input type="hidden" name="id" value="{{ $item->id }}">
                                        </div>
                                         <button type="submit" class="btn btn-orange" name="submit"><span class="fa fa-cart-plus"></span>&nbsp;Add to Order</button>
                                    </form>
                                    
                            </div>
                        </div>
                        <div class="pull-right">
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection