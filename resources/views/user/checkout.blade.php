<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <title>Famms - Fashion HTML Template</title>
      <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.css') }}" />
      <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet" />
      <link href="{{ asset('css/style.css') }}" rel="stylesheet" />
      <link href="{{ asset('css/responsive.css') }}" rel="stylesheet" />
   </head>
   <body>
      <div class="hero_area">
         @include('user.layouts.header')
         <div class="heading_container heading_center">
                  <h2>Order <span>Now</span></h2>
            </div>

         @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
         @endif

         <div class="row m-2">
            <!-- Order Summary -->
            <div class="col-md-6">
                  <h4>Order Summary</h4>
                  <table class="table table-bordered">
                     <thead>
                        <tr>
                              <th>Product</th>
                              <th>Qty</th>
                              <th>Price</th>
                              <th>Total</th>
                        </tr>
                     </thead>
                     <tbody>
                        @php $grandTotal = 0; @endphp
                        @foreach($cartItems as $item)
                              @php
                                 $total = $item->quantity * $item->product_price;
                                 $grandTotal += $total;
                              @endphp
                              <tr>
                                 <td>{{ $item->product_title }}</td>
                                 <td>{{ $item->quantity }}</td>
                                 <td>${{ number_format($item->product_price, 2) }}</td>
                                 <td>${{ number_format($total, 2) }}</td>
                              </tr>
                        @endforeach
                     </tbody>
                     <tfoot>
                        <tr>
                              <th colspan="3" class="text-right">Grand Total:</th>
                              <th>${{ number_format($grandTotal, 2) }}</th>
                        </tr>
                     </tfoot>
                  </table>
            </div>

            <!-- Billing Details -->
            <div class="col-md-6">
                  <h4>Billing Details</h4>
                  <form action="{{ route('checkout.placeOrder') }}" method="POST">
                     @csrf
                     <div class="form-group">
                        <label>Name:</label>
                        <input type="text" name="name" class="form-control" required value="{{ Auth::user()->name }}">
                     </div>

                     <div class="form-group">
                        <label>Email:</label>
                        <input type="email" name="email" class="form-control" required value="{{ Auth::user()->email }}">
                     </div>

                     <div class="form-group">
                        <label>Address:</label>
                        <textarea name="address" class="form-control" required></textarea>
                     </div>

                     <div class="form-group">
                        <label>Payment Method:</label>
                        <select name="payment_method" class="form-control" required>
                              <option value="COD">Cash on Delivery</option>
                              <option value="paypal">PayPal</option>
                              <option value="credit_card">Credit Card</option>
                        </select>
                     </div>

                     <button type="submit" class="btn btn-success btn-lg btn-block">
                        Place Order <i class="fa fa-check"></i>
                     </button>
                  </form>
            </div>
         </div>


         @include('user.layouts.footer')
      </div>
   </body>
</html>
