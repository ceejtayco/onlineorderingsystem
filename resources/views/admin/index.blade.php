@extends('admin.header')
@section('custom-css')
    <link rel="stylesheet" href=" {{ asset('css/admin/admin.css') }} ">
@endsection
@section('header')
  <span class="fas fa-tachometer-alt" style="font-size:25px;"></span> Dashboard
@endsection

@section('content')
  <div class="container-fluid">
    <div class="row justify-content-md-center">
      <div class="col-md-7 order-summary-col">
        <h4 class="display-4 order-summary-header">Transaction List</h4>
        <div class="card order-summary-card">
          <div class="card-body order-summary-card-body">
            <table class="table table-striped">
              <thead>
                <th>Order ID</th>
                <th>Subtotal</th>
                <th>Tax</th>
                <th>Discount</th>
                <th>Total</th>
                <th>Date</th>
              </thead>
              <tbody>
                @foreach($orders as $order)
                  <tr>
                    <td> {{ $order->id }} </td>
                    <td> &#8369;{{ $order->subtotal }} </td>
                    <td> &#8369;{{ $order->totaltax }} </td>
                    @if(!empty($order->coupon_id))
                      <td> {{ $order->coupon->code }} </td>
                    @else
                      <td>No Discount</td>
                    @endif
                    <td> &#8369;{{ $order->total }} </td>
                    <td> {{ $order->created_at }} </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="col-md-5 item-summary">
          <h4 class="display-4 order-summary-header">Transaction Item Details</h4>
        <div class="card item-summary-card">
          <div class="card-body item-summary-card-body">
            <table class="table table-striped">
              <thead>
                <th>Order ID</th>
                <th>Item Name</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Subtotal</th>
              </thead>
              <tbody>
                @foreach($order_details as $order)
                  <tr>
                    <td> {{ $order->order->id }} </td>
                    <td> {{ $order->item->name}} </td>
                    <td> &#8369;{{ number_format($order->item->price, 2, '.', ',') }} </td>
                    <td> {{ $order->qty }} </td>
                    <td> &#8369;{{ $order->subtotal }} </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection