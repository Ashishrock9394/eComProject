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

                              <form action="{{ route('update.product', $product->id) }}" method="POST" enctype="multipart/form-data">
                              @csrf

                              <!-- Product Title -->
                              <div class="form-group">
                                    <label for="title">Product Title</label>
                                    <input type="text" name="title" class="form-control" value="{{ $product->title }}" required>
                              </div>

                              <!-- Description -->
                              <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea name="description" class="form-control" rows="3">{{ $product->description }}</textarea>
                              </div>

                              <!-- Price -->
                              <div class="form-group">
                                    <label for="price">Price ($)</label>
                                    <input type="number" name="price" class="form-control" value="{{ $product->price }}" step="0.01" required>
                              </div>

                              <!-- Discount Price -->
                              <div class="form-group">
                                    <label for="discount_price">Discount Price ($)</label>
                                    <input type="number" name="discount_price" class="form-control" value="{{ $product->discount_price }}" step="0.01">
                              </div>

                              <!-- Quantity -->
                              <div class="form-group">
                                    <label for="quantity">Quantity</label>
                                    <input type="number" name="quantity" class="form-control" value="{{ $product->quantity }}" required>
                              </div>

                              <!-- Category Dropdown -->
                              <div class="form-group">
                              <label for="category_name">Category</label>
                              <select name="category_name" class="form-control" required>
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $category)
                                          <option value="{{ $category->category_name }}">{{ $category->category_name }}</option>
                                    @endforeach
                              </select>
                              </div>

                              <!-- Product Image -->
                              <div class="form-group">
                                    <label for="image">Product Image</label>
                                    <input type="file" name="image" class="form-control-file">
                                    @if($product->image)
                                    <div class="mt-2">
                                          <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" width="200">
                                    </div>
                                    @endif
                              </div>

                              <!-- Submit Button -->
                              <button type="submit" class="btn btn-primary">Update Product</button>
                        </form>


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