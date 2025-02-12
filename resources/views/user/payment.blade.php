<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <title>Payment Page</title>
      <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.css') }}" />
      <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet" />
      <link href="{{ asset('css/style.css') }}" rel="stylesheet" />
      <link href="{{ asset('css/responsive.css') }}" rel="stylesheet" />
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <style type="text/css">
            #card-element{
                  height: 50px;
                  padding-top: 16px;
            }
      </style>
   </head>
   <body>
      <div class="hero_area">
         @include('user.layouts.header')

            <div class="heading_container heading_center">
                  <!-- <h2>Items in your <span>Cart</span></h2> -->
                  <div class="container mb-4">
                        <div class="row">
                              <div class="col-md-8 offset-md-2">
                              <div class="card mt-5">
                                    <h2 class="card-header p-3">Pay <span>Now</span></h2>
                                    <div class="card-body">

                                          @session('success')
                                          <div class="alert alert-success" role="alert"> 
                                                {{ $value }}
                                          </div>
                                          @endsession
                              
                                          <form id='checkout-form' method='post' action="{{ route('stripe.post') }}">   
                                          @csrf    

                                          <strong>Enter Card Details</strong>
                                          <input type="input" class="form-control" name="name" placeholder="Enter Name">

                                          <input type='hidden' name='stripeToken' id='stripe-token-id'>   
                                          <input type='hidden' name='amount' id='payment-amount' value="{{ request('amount') }}"> <!-- Hidden input for amount -->                           
                                          <br>
                                          <div id="card-element" class="form-control" ></div>
                                          <button 
                                                id='pay-btn'
                                                class="btn btn-success mt-3"
                                                type="button"
                                                style="margin-top: 20px; width: 100%;padding: 7px;"
                                                onclick="createToken()">PAY ${{ request('amount') }}
                                          </button>
                                          <form>
                                    </div>
                              </div>
                              </div>
                        </div> 
                        </div>
            </div>

            @include('user.layouts.footer')
      </div>
 
   </body>
        
<script src="https://js.stripe.com/v3/"></script>
<script type="text/javascript">
      
  
      var stripe = Stripe("{{ config('services.stripe.key') }}");
      // var stripe = Stripe("{{ env('STRIPE_KEY') }}");
      var elements = stripe.elements();
      var cardElement = elements.create('card');
      cardElement.mount('#card-element');

      /*------------------------------------------
      --------------------------------------------
      Create Token Code
      --------------------------------------------
      --------------------------------------------*/
      function createToken() {
            document.getElementById("pay-btn").disabled = true;
            stripe.createToken(cardElement).then(function(result) {

            if(typeof result.error != 'undefined') {
                  document.getElementById("pay-btn").disabled = false;
                  alert(result.error.message);
            }

            /* creating token success */
            if(typeof result.token != 'undefined') {
                  document.getElementById("stripe-token-id").value = result.token.id;
                  document.getElementById('checkout-form').submit();
            }
            });
      }
</script>
 

</html>
