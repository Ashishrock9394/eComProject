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
            
            @if(session('cart'))
                <table class="table">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $grandTotal = 0; @endphp
                        @foreach(session('cart') as $id => $details)
                        @php $totalPrice = $details['price'] * $details['quantity']; @endphp
                        <tr>
                            <td><img src="{{ asset('storage/' . $details['image']) }}" width="50"></td>
                            <td>{{ $details['title'] }}</td>
                            <td class="price" data-price="{{ $details['price'] }}">
                                ${{ number_format($details['price'], 2) }}
                            </td>
                            <td>
                                <!-- Quantity update form -->
                                <form action="{{ route('cart.update', $id) }}" method="POST" class="d-inline update-form">
                                    @csrf
                                    <input type="number" name="quantity" value="{{ $details['quantity'] }}" min="1" class="form-control quantity" data-id="{{ $id }}" style="width: 60px; display: inline-block;">
                                    <button type="submit" class="btn btn-sm btn-primary">Update</button>
                                </form>
                            </td>
                            <td class="total">
                                ${{ number_format($totalPrice, 2) }}
                            </td>
                            <td>
                                <!-- Remove button -->
                                <form action="{{ route('cart.remove', $id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger">Remove</button>
                                </form>
                            </td>
                        </tr>
                        @php $grandTotal += $totalPrice; @endphp
                        @endforeach
                    </tbody>
                </table>

                <!-- Grand Total Row -->
                <div class="text-right">
                    <h4><strong>Grand Total: $<span id="grandTotal">{{ number_format($grandTotal, 2) }}</span></strong></h4>
                </div>
                
            @else
                <p>Your Cart is Empty</p>
                <img src="https://png.pngtree.com/png-vector/20241116/ourmid/pngtree-empty-cart-shopping-side-view-png-image_14433434.png" alt="">
            @endif
         </div>

         @include('user.layouts.footer')
      </div>

      <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
      <script src="{{ asset('js/popper.min.js') }}"></script>
      <script src="{{ asset('js/bootstrap.js') }}"></script>
      <script src="{{ asset('js/custom.js') }}"></script>

      <!-- Script to update total price dynamically -->
      <script>
         $(document).ready(function(){
             $(".quantity").on("input", function() {
                 let quantity = $(this).val();
                 let price = $(this).closest("tr").find(".price").data("price");
                 let total = (quantity * price).toFixed(2);

                 // Update the individual row total
                 $(this).closest("tr").find(".total").text("$" + total);

                 // Recalculate the grand total
                 let grandTotal = 0;
                 $(".total").each(function() {
                     grandTotal += parseFloat($(this).text().replace("$", ""));
                 });

                 $("#grandTotal").text(grandTotal.toFixed(2));
             });
         });
      </script>

   </body>
</html>
