@extends('layouts.header')
@section('custom-css')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endsection
@section('content')
<div class="container-fluid text-center menu-container">
    <h4 class="display-4 menu-header">Menu Items</h4>
    @foreach($category as $result)
    <div class="row justify-content-md-center">
        <div class="col-md-12">
            <h4 class="display-4 category-header">{{ $result->name }}</h4>
        </div>
    </div>
    <div class="row justify-content-md-center">
        @foreach($item as $items)
            @if($result->id == $items->category_id)
                <div class="col-md-3 category-column">
                    <div class="card text-left">
                        <div class="card-body">
                            @if(!empty($items->filename))
                                <img src="{{ asset('uploads/'.$items->filename) }}" alt="{{ $items->filename }}" class="category-img">
                            @else
                                <img src="{{ asset('img/noimage.png') }}" alt="No Image" class="category-img">
                            @endif
                            <p>{{ $items->name }}<br>{{ $items->price }}<br>
                                @if($items->qty <= 0)
                                    <span class="not-available">Not Available</span>
                                @else
                                    <span class="available">Available</span>
                                @endif
                            </p>
                            <div class="pull-right">
                                <a href="{{ route('quantity-form', ['item'=>$items->id]) }}" class="btn btn-add-to-cart"><span class="fa fa-cart-plus"></span>&nbsp;&nbsp;Add to Order</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
    <br>
    <hr class="dashed">
    @endforeach
</div>
@endsection
