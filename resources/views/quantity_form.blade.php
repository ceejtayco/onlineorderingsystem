@extends('layouts.header')
@section('custom-css')
    <link rel="stylesheet" href="{{ asset('css/quantity.css') }}">
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-md-center">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-body">
                        <p class="quantity-header text-center">Item details</p>
                        <div class="row justify-content-md-center">
                            <div class="col-md-7">
                                    @if(!empty($item->filename))
                                        <img src="{{ asset('uploads/'.$item->filename) }}" alt="{{ $item->filename }}" class="category-img">
                                    @else
                                        <img src="{{ asset('img/noimage.png') }}" alt="No Image" class="category-img">
                                    @endif
                            </div>
                            <div class="col-md-5 item-details">
                                    <p><strong>Item:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $item->name }}</strong><br>
                                    Category:&nbsp;&nbsp;&nbsp; {{ $item->category->name }} <br>
                                    Price:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $item->price }}</p>
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