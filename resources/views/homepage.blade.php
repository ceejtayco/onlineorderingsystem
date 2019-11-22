@extends('layouts.header')
@section('custom-css')
    <link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
@endsection
@section('content')
@if(session()->has('success'))
    <script>
        alert("Item successfully added on your order.");
    </script>
@endif
<div id="carouselExampleControls" class="carousel slide homepage-carousel" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="{{ asset('img/background.jpg') }}" class="d-block w-100" alt="burger" height="600">
            <div class="carousel-caption d-none d-md-block">
                @auth
                <h4 class="display-4">Welcome back, {{ Auth::user()->firstname }}</h4>
                    <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
                @else
                    <h4 class="display-4">Register to begin</h4>
                    <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
                @endauth
               
            </div>
        </div>
        <div class="carousel-item">
            <img src="{{ asset('img/beef.jpeg') }}" class="d-block w-100" alt="beef" height="600">
        </div>
        <div class="carousel-item">
            <img src="{{ asset('img/carbonara.jpg') }}" class="d-block w-100" alt="carbonara" height="600">
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
<div class="container-fluid">
    <h5 class="display-4 text-center menu-of-the-day"><strong>Available Menu Items</strong></h4>
        @foreach($category as $result)
            <div class="row category-row">
                <div class="col-md-12">
                    <h5 class="display-4 category-header">{{ $result->name }}</h5>
                </div>
            </div>
            <div class="row justify-content-md-center item-row">
                @foreach($item as $items)
                    @if($result->id == $items->category_id && $items->qty != 0)
                    <div class="col-md-3 item-columns">
                        <div class="card">
                            <div class="card-body">
                                @if(!empty($items->filename))
                                    <img src="{{ asset('uploads/'.$items->filename) }}" alt="{{ $items->filename }}" class="category-img">
                                @else
                                    <img src="{{ asset('img/noimage.png') }}" alt="No Image" class="category-img">
                                @endif
                                <p>{{ $items->name }}</p>
                                <p style="margin-top: -10px;">{{ $items->price }}</p>
                                <div class="pull-right">
                                    @auth
                                    <a href="{{ route('quantity-form', ['item' => $items->id]) }}" name="item_id" value="{{ $items->id }}" class="btn add-to-cart">
                                                <span class="fa fa-cart-plus"></span>
                                                Add to Order
                                        </a>
                                        </form>
                                    @else
                                        <a href="{{ route('login') }}" class="btn add-to-cart">
                                            <span class="fa fa-cart-plus"></span>
                                            Add to Order
                                        </a>
                                    @endauth
                                </div> 
                            </div>
                        </div>
                    </div>
                    @endif
                @endforeach
            </div>
            <hr class="dashed">
        @endforeach
</div>

@endsection
@section('custom-script')
{{-- <script>
    $(function () {
        $('#storeSession').submit(function (e) {
            e.preventDefault()  // prevent the form from 'submitting'

            var url = '/store-to-sesions-order'  // get the target
            var formData = $(this).serialize() // get form data
            $.post(url, formData, function (response) { // send; response.data will be what is returned
                alert('Item successfully added to your order.')
            })
        })
    })
</script> --}}
@endsection