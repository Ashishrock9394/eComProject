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
            
         </div>

         @include('user.layouts.footer')
      </div>

      <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
      <script src="{{ asset('js/popper.min.js') }}"></script>
      <script src="{{ asset('js/bootstrap.js') }}"></script>
      <script src="{{ asset('js/custom.js') }}"></script>

   </body>
</html>
