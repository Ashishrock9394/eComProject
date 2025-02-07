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
            <h2>Items in your <span>Cart</span></h2>
            @if($cart->isEmpty())
                <div class="text-center">
                    <p class="font-weight-bold">Your Cart is Empty</p>
                    <img src="https://png.pngtree.com/png-vector/20241116/ourmid/pngtree-empty-cart-shopping-side-view-png-image_14433434.png" 
                        alt="Empty Cart" class="img-fluid" style="max-width: 300px;">
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered table-striped text-center">
                        <thead class="thead-dark">
                            <tr>
                                <th>Image</th>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $grandTotal = 0; @endphp
                            @foreach($cart as $item)
                            @php 
                                $total = $item->quantity * $item->product_price;
                                $grandTotal += $total;
                            @endphp
                            <tr data-id="{{ $item->id }}">
                                <td>
                                    <img src="{{ asset('storage/' . $item->product_image) }}" 
                                        width="100" class="img-thumbnail">
                                </td>
                                <td>{{ $item->product_title }}</td>
                                <td style="text-align: center; vertical-align: middle;">
                                    <input type="number" class="form-control quantity" min="1" 
                                        value="{{ $item->quantity }}" 
                                        data-id="{{ $item->id }}" 
                                        style="width: 60px; text-align: center; margin: 0 auto; display: block;">
                                </td>

                                <td class="price" data-price="{{ $item->product_price }}">
                                    ${{ number_format($item->product_price, 2) }}
                                </td>
                                <td class="total">${{ number_format($total, 2) }}</td>
                                <td>
                                    <button class="btn btn-danger btn-sm remove-item">
                                        <i class="fa fa-trash"></i> Remove
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="thead-light">
                            <tr>
                                <th colspan="4" class="text-right">Grand Total:</th>
                                <th id="grandTotal">${{ number_format($grandTotal, 2) }}</th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="text-right">
                    <a href="{{route('user.order')}}" class="btn btn-success btn-lg">
                        Proceed to Checkout <i class="fa fa-credit-card"></i>
                    </a>
                </div>
            @endif
         </div>

         @include('user.layouts.footer')
      </div>

      <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
      <script src="{{ asset('js/popper.min.js') }}"></script>
      <script src="{{ asset('js/bootstrap.js') }}"></script>
      <script src="{{ asset('js/custom.js') }}"></script>

      <!-- Script to update total price dynamically and remove items -->
      <script>
         $(document).ready(function(){
             // Update quantity and total price
             $(".quantity").on("change", function() {
                 let quantity = $(this).val();
                 let row = $(this).closest("tr");
                 let price = row.find(".price").data("price");
                 let total = (quantity * price).toFixed(2);
                 row.find(".total").text("$" + total);

                 // Recalculate grand total
                 let grandTotal = 0;
                 $(".total").each(function() {
                     grandTotal += parseFloat($(this).text().replace("$", ""));
                 });

                 $("#grandTotal").text("$" + grandTotal.toFixed(2));

                 // AJAX request to update quantity in the database
                 let itemId = $(this).data("id");
                 $.ajax({
                     url: "{{ route('cart.update', '') }}/" + itemId,
                     type: "POST",
                     data: {
                         _token: "{{ csrf_token() }}",
                         quantity: quantity
                     },
                     success: function(response) {
                         console.log("Quantity updated successfully.");
                     }
                 });
             });

             // Remove item from cart
             $(".remove-item").on("click", function() {
                 let row = $(this).closest("tr");
                 let itemId = row.data("id");

                 $.ajax({
                     url: "{{ route('cart.remove', '') }}/" + itemId,
                     type: "POST",
                     data: { _token: "{{ csrf_token() }}" },
                     success: function(response) {
                         row.remove();
                         let grandTotal = 0;
                         $(".total").each(function() {
                             grandTotal += parseFloat($(this).text().replace("$", ""));
                         });

                         $("#grandTotal").text("$" + grandTotal.toFixed(2));
                     }
                 });
             });
         });
      </script>

   </body>
</html>
