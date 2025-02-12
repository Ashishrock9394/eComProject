<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Corona Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css')}}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/jvectormap/jquery-jvectormap.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/flag-icon-css/css/flag-icon.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/owl-carousel-2/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/owl-carousel-2/owl.theme.default.min.css')}}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css')}}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png')}}" />
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
      @include('admin.layouts.sidebar')
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_navbar.html -->
        @include('admin.layouts.navbar')
        <!-- partial -->

        <!-- product section -->
            <div class="main-panel">
                  <div class="content-wrapper">
                  <div class="container">
                        <h2 class="mb-4 text-center">Product List</h2>

                        @if (session('success'))
                              <div id="success-message" class="alert alert-success">
                              {{ session('success') }}
                              </div>
                              <script>
                                    // Hide the success message after 3 seconds (3000ms)
                                    setTimeout(function() {
                                          $("#success-message").fadeOut("slow");
                                    }, 3000);
                              </script>
                        @endif

                        @if($products->count() > 0)
                        <table class="table table-bordered">
                              <thead class="thead-dark">
                                    <tr>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Price</th>
                                    <th>Discount Price</th>
                                    <th>Quantity</th>
                                    <th>Action</th>
                                    </tr>
                              </thead>
                              <tbody>
                                    @foreach ($products as $product)
                                    <tr>
                                    <td>
                                          @if($product->image)
                                                <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image"style="width: 100%; height: auto; max-height: 500px;object-fit: cover; border-radius: 10px;">
                                          @else
                                                <span>No Image</span>
                                          @endif
                                    </td>
                                    <td>{{ $product->title }}</td>
                                    <td>{{ \Illuminate\Support\Str::limit($product->description, 30) }}</td>
                                    <td>${{ $product->discount_price }}</td>
                                    <td>${{ $product->price }}</td>
                                    <td>{{ $product->quantity }}</td>
                                    <td>
                                    <a class="btn btn-info my-2" href="{{route('edit.product',$product->id)}}">Edit</a>

                                    <a class="btn btn-danger" href="{{ route('delete.product', $product->id) }}" 
                                    onclick="return confirm('Are you sure you want to delete this product?')">Delete</a>
                                    </td>
                                    </tr>
                                    @endforeach
                              </tbody>
                        </table>
                        @else
                              <p>No products found.</p>
                        @endif
                        </div>      


                  </div>
            </div>


        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js')}}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{ asset('assets/vendors/chart.js/Chart.min.js')}}"></script>
    <script src="{{ asset('assets/vendors/progressbar.js/progressbar.min.js')}}"></script>
    <script src="{{ asset('assets/vendors/jvectormap/jquery-jvectormap.min.js')}}"></script>
    <script src="{{ asset('assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
    <script src="{{ asset('assets/vendors/owl-carousel-2/owl.carousel.min.js')}}"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('assets/js/off-canvas.js')}}"></script>
    <script src="{{ asset('assets/js/hoverable-collapse.js')}}"></script>
    <script src="{{ asset('assets/js/misc.js')}}"></script>
    <script src="{{ asset('assets/js/settings.js')}}"></script>
    <script src="{{ asset('assets/js/todolist.js')}}"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="{{ asset('assets/js/dashboard.js')}}"></script>
    <!-- End custom js for this page -->
  </body>
</html>