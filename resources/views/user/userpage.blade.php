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
         <!-- slider section -->
         @include('user.layouts.slider')
         <!-- end slider section -->
      </div>
      <!-- why section -->
      @include('user.layouts.whysection')
      <!-- end why section -->
      
      <!-- new arrival section -->
      @include('user.layouts.newarrivals')
      <!-- end arrival section -->
      
      <!-- product section -->
      @include('user.layouts.products')
      <!-- end product section -->

      <!-- subscribe section -->
      @include('user.layouts.subscribe')
      <!-- end subscribe section -->
      <!-- client section -->
      @include('user.layouts.client')
      <!-- end client section -->
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

      <!-- smooth scroll  -->
      <script>
   $(document).ready(function(){
      $("a.nav-link").on("click", function(event){
         if (this.hash !== "") {
            event.preventDefault();
            var hash = this.hash;
            $("html, body").animate({
               scrollTop: $(hash).offset().top
            }, 800);
         }
      });
   });
</script>

   </body>
</html>