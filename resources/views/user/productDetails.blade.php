<!DOCTYPE html>
<html>
   <head>
      <!-- Basic -->
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <!-- Mobile Metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <!-- Site Metas -->
      <meta name="keywords" content="" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <link rel="shortcut icon" href="images/favicon.png" type="">
      <title>Famms - Fashion HTML Template</title>
      <!-- bootstrap core css -->
      <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.css') }}" />
      <!-- font awesome style -->
      <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="{{ asset('css/style.css') }}" rel="stylesheet" />
      <!-- responsive style -->
      <link href="{{ asset('css/responsive.css') }}" rel="stylesheet" />
   </head>
   <body>
      <div class="hero_area">
         <!-- header section strats -->
          @include('user.layouts.header')
         <!-- end header section -->
         <div class="heading_container heading_center">
         <h2>Product <span>Details</span></h2>
      </div>

<div class="d-flex justify-content-center container mt-2 p-2">
    <div class="card p-3 bg-white">
        <div class="about-product text-center mt-2">
            <img src="{{ asset('storage/' . $product->image) }}" width="300" alt="Product Image">
            <div>
                <h4>{{ $product->title }}</h4>
            </div>
        </div>
        <div class="stats mt-2">
            <div class="d-flex justify-content-between p-price">
                <span>{{ $product->name }}</span>
            </div>
            @if($product->discount_price)
                <div class="d-flex justify-content-between p-price">                  
                  <span>Price:</span>
                  <span class="text-danger"><del>${{ number_format($product->price, 2) }}</del></span>
                  </div>
                  <div class="d-flex justify-content-between p-price"> 
                  <span>Discount Price:</span>
                  <span>${{ number_format($product->discount_price, 2) }}</span>
                </div>
            @endif

            <div class="d-flex justify-content-between p-price">
                  <span>Category:</span>
                  <small>{{ $product->category }}</small>
            </div>
            <div class="d-flex justify-content-between p-price">
                  <span>Description:</span>
                  <small style="word-wrap: break-word; white-space: normal; overflow-wrap: break-word;">&nbsp;&nbsp;&nbsp;{{ $product->description }}</small>
            </div>

        </div>
        <div class="d-flex justify-content-between total font-weight-bold mt-4">
            <span>Total</span>
            <span>${{ number_format($product->discount_price ?: $product->price, 2) }}</span>
        </div>
    </div>
</div>


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