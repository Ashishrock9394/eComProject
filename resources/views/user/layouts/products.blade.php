<section id="products" class="product_section layout_padding">
   <div class="container">
      <div class="heading_container heading_center">
         <h2>Our <span>Products</span></h2>
      </div>

      <div class="row">
         @foreach($products as $product)
         <div class="col-sm-6 col-md-4 col-lg-4 mb-4">
            <div class="box">
               <div class="option_container">
                  <div class="options">
                  <a href="{{ route('show.product', $product->id) }}" class="option1">Show Details</a>

                     <form action="{{ route('cart.add', $product->id) }}" method="POST">
                        @csrf
                        <div class="d-flex align-items-center">
                           <button type="submit" class="option2" style="padding: 8px 15px; width:165px; border-radius:30px">Add to Cart</button>
                        </div>
                     </form>

                  </div>
               </div>
               <div class="img-box">
                  <img src="{{ asset('storage/' . $product->image) }}" alt="" class="img-fluid">
               </div>
               <div class="detail-box">
                  <h5>{{ $product->title }}</h5>
                  <h6 class="text-danger"><del>${{ number_format($product->discount_price, 2) }}</del></h6>
                  <h6>${{ number_format($product->price, 2) }}</h6>
               </div>
            </div>
         </div>
         @endforeach
      </div>

      <!-- Pagination Section -->
      <div class="d-flex justify-content-center mt-4">
         {{ $products->links() }}  <!-- Generates pagination links -->
      </div>
   </div>
</section>
