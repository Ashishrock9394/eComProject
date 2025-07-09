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
            <h2>Your <span>Orders</span></h2>
            @if($orders->isEmpty())
               <div class="text-center">
                  <p class="font-weight-bold">You have no orders yet.</p>
                  <img src="https://png.pngtree.com/png-vector/20241116/ourmid/pngtree-empty-cart-shopping-side-view-png-image_14433434.png" 
                       alt="No Orders" class="img-fluid" style="max-width: 300px;">
               </div>
               @else
               <div class="table-responsive">   
                  <table class="table table-bordered table-striped text-center">
                     <thead class="thead-dark">
                        <tr>
                           <th>Order ID</th>
                           <th>Product</th>
                           <th>Quantity</th>
                           <th>Total Price</th>
                           <th>Status</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($orders as $order)
                           @foreach($order->orderItems as $order_item)
                              <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order_item->product_title }}</td>
                                    <td>{{ $order_item->quantity }}</td>
                                    <td>${{ number_format($order->total_price, 2) }}</td>
                                    <td>{{ $order->order_status }}</td>
                              </tr>
                           @endforeach
                        @endforeach


                     </tbody>
                  </table>            
               </div>
               @endif

          <!-- footer start -->
            @include('user.layouts.footer')
            <!-- footer end -->
      <!-- jQery -->
      <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
      <!-- popper js -->
      <script src="{{ asset('js/popper.min.js') }}"></script>
      <!-- bootstrap js -->
      <script src="{{ asset('js/bootstrap.js') }}"></script>
      <!-- custom js -->
      <script src="{{ asset('js/custom.js') }}"></script>
   </body>
</html>
