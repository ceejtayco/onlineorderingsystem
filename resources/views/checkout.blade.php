@extends('layouts.header')
@section('custom-css')
    <link rel="stylesheet" href="{{ asset('css/checkout.css') }}">
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-md-center">
            <div class="col-md-5 order-summary-col">
                <div class="card">
                    <div class="card-body">
                        <h4 class="display-4 order-summary-header">Order Summary</h4>
                        <table class="table table-borderless">
                            <tbody>
                                <th>Item</th>
                                <th>Price</th>
                                <th>Subtotal</th>
                                @foreach($orders as $item)
                                    <tr>
                                        <td>x{{ $item['qty'] }}&nbsp;&nbsp;{{ $item['name'] }}</td>
                                        <td>&#8369;{{ $item['price'] }}</td>
                                        <td>&#8369;{{ $item['subtotal'] }}</td>
                                    </tr>
                                @endforeach
                                <tr style="border-top: 2px solid black;">
                                    <td></td>
                                    <th class="text-right">Subtotal</th>
                                    <td>&#8369;{{ number_format($total_gross, 2, '.', ',') }}</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <th class="text-right">Tax</th>
                                    <td>&#8369;{{ number_format($total_vat_amount, 2, '.', ',') }}</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <th class="text-right">Total</th>
                                    <td>&#8369;{{ number_format($total_amount, 2, '.', ',') }}</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <th class="text-right">Coupon</th>
                                    <td>
                                        @if($coupon > 0)
                                            {{ $discount_array[0]['discount'] }}
                                        @else
                                            0.00
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <th class="text-right">TOTAL PAY</th>
                                    <td>
                                        @if($coupon > 0)
                                            &#8369;{{ $discount_array[0]['totalpay'] }}
                                        @else
                                            &#8369;{{ number_format($total_amount, 2, '.', ',') }}
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="pull-right">
                            <a href="{{ route('homepage') }}" class="btn btn-orange">Return To Home</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection